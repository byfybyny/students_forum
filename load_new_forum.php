<?php
session_start();
require_once "function.php";

global $pdo;

$offset = (int)($_GET['offset'] ?? 0);
$limit  = (int)($_GET['limit']  ?? 5);

$forum = getLast5Forum($offset, $limit);

if (empty($forum)) {
    exit; 
}

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
    hx-get="load_new_forum.php?offset=<?= $offset + $limit ?>&limit=<?= $limit ?>"
    hx-trigger="intersect once"
    hx-target="#altri_forum"
    hx-swap="outerHTML">
</tr>
<?php endif; ?>