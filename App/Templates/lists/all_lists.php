<?php require_once __DIR__ . '../../header.php'; ?>
<h2>Списъци за <?=$data[0]?> </h2>
<br>
<hr>
<div>
    <ol>
    <?php foreach ($data[1] as $list): ?>

        <li>
            <a href="list.php?listId=<?=$list->getId()?>">Лист #<?= $list->getId() ?> &nbsp<?= $list->getComment() ?>, от дата:&nbsp<?= $list->getUpdateDate() ?></a>
        </li>
        <p>
           
        </p>
        <hr>

    <?php endforeach; ?>
    </ol>

</div>




</main>





