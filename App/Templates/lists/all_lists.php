<?php require_once __DIR__ . '../../header.php'; ?>
<div class="list-form">
    <form method="post">
        <label for="list_id">Номер на лист</label>
        <input type="text" name="list_id" value=""/>
        <br>
        <label for="date">По дата</label>
        <input type="date" name="date" value=""/>
        <button id="button" style="background-color: #59b300" type="submit" name="search" value="1" >ТЪРСИ</button>
    </form>

</div>
<h2>Списъци за <?= $data[0] ?> </h2>
<br>
<hr>
<div>
    <ol>
        <?php foreach ($data[1] as $list): ?>

            <li>
                <a href="list.php?listId=<?= $list->getId() ?>">Лист #<?= $list->getId() ?> &nbsp<?= $list->getComment() ?>, от дата:&nbsp<?= $list->getUpdateDate() ?></a>
            </li>
            <p>

            </p>
            <hr>

        <?php endforeach; ?>
    </ol>

</div>




</main>





