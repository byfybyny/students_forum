<?php
require_once "function.php";

$offset = (int)($_GET['offset'] ?? 0);
$limit  = (int)($_GET['limit']  ?? 5);

$forum = getLast5Forum($offset, $limit);

if (empty($forum)) {
    exit; 
}

// Stampa le nuove card
foreach ($forum as $row): ?>
    <a href="forum.php?forum_id=<?= (int)$row['forum_id'] ?>" class="forum-card">
        <h3><?= htmlspecialchars($row['titolo']) ?></h3>
        <div class="meta-info">
            Creato da <?= htmlspecialchars($row['username']) ?> il <?= htmlspecialchars($row['data_pubblicazione']) ?>
        </div>
    </a>
<?php endforeach;

// Stampa il trigger per il caricamento successivo, se ci sono ancora dati
if (count($forum) === $limit): ?>
    <div id="altri_forum"
         hx-get="load_new_forum.php?offset=<?= $offset + $limit ?>&limit=<?= $limit ?>"
         hx-trigger="intersect once"
         hx-target="#altri_forum"
         hx-swap="outerHTML">
    </div>
<?php endif; ?>