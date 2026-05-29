<?php
session_start();
require_once "function.php";
global $pdo;

$offset    = (int)($_GET['offset']    ?? 0);
$limit     = (int)($_GET['limit']     ?? 5);
$scuola_id = (int)($_GET['scuola_id'] ?? 0);
$modalita  = isset($_GET['modalita']) && $_GET['modalita'] === 'tutti' ? 'tutti' : 'scuola';

$forum = $modalita === 'tutti'
    ? getLast5Forum($offset, $limit)
    : getForumByScuola($scuola_id, $offset, $limit);

if (empty($forum)) exit;

foreach ($forum as $row): ?>
    <div class="forum-card" onclick="window.location='forum.php?forum_id=<?= (int)$row['forum_id'] ?>'" style="cursor:pointer;">
        <h3><?= htmlspecialchars($row['titolo']) ?></h3>
        <div class="meta-info">
            Creato da <a href="profilo_utente.php?utente_id=<?= (int)$row['utente_id'] ?>">
                <strong><?= htmlspecialchars($row['username']) ?></strong>
            </a>
            il <?= htmlspecialchars($row['data_pubblicazione']) ?>
        </div>
    </div>
<?php endforeach;

if (count($forum) === $limit): ?>
    <div id="altri_forum"
         hx-get="load_more_scuola.php?offset=<?= $offset + $limit ?>&limit=<?= $limit ?>&scuola_id=<?= $scuola_id ?>&modalita=<?= $modalita ?>"
         hx-trigger="revealed"
         hx-target="#altri_forum"
         hx-swap="outerHTML">
         <div class="card">Caricamento altri forum...</div>
    </div>
<?php endif; ?>