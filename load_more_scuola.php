<?php
session_start();
require_once "function.php";
global $pdo;

$offset    = (int)($_GET['offset']    ?? 0);
$limit     = (int)($_GET['limit']     ?? 5);
$scuola_id = (int)($_GET['scuola_id'] ?? 0);

$forum = getForumByScuola($scuola_id, $offset, $limit);

if (empty($forum)) exit;

foreach ($forum as $row): ?>
<tr>
    <td>
        <a href="forum.php?forum_id=<?= (int)$row['forum_id'] ?>">
            <?= htmlspecialchars($row['titolo']) ?>
        </a>
    </td>
    <td><?= htmlspecialchars($row['username']) ?></td>
    <td><?= htmlspecialchars($row['data_pubblicazione']) ?></td>
</tr>
<?php endforeach;

if (count($forum) === $limit): ?>
<tr id="altri_forum"
    hx-get="/students_forum/load_more_scuola.php?offset=<?= $offset + $limit ?>&limit=<?= $limit ?>&scuola_id=<?= $scuola_id ?>"
    hx-trigger="revealed"
    hx-target="#altri_forum"
    hx-swap="outerHTML">
</tr>
<?php endif; ?>