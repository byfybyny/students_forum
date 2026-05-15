<?php

require_once "function.php";

$commento_id = $_REQUEST['commento_id'] ?? null;
?>
<table>
    <tr>
        <th>contenuto</th>
        <th>crato da</th>
        <th>creato il</th>
    </tr>
    <tr id=commenti>
        <td colspan="3">
            <div
                hx-get="commenti_risposte.php?commento_id=<?=$commento_id?>&nPagina=1"
                hx-target="#commenti"
                hx-trigger="revealed"
                hx-swap="outerHTML">
            </div>
        </td>
    </tr>
</table>