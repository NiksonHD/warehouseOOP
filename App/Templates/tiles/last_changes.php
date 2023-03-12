<?php /* * @var App\Data\DailyDTO $data */ ?>

<?php require_once __DIR__ . '../../header.php'; ?>
<main>
    <h1> Последни Промени</h1>
    <div>
        <form method="post">
            <label for="input_date">Избери дата:</label>
            <td><input id="focusCell" type="date" name="input_date" value=""/></td>
            <button style="background-color: #59b300" type="submit" name="save" value="1">ТЪРСИ</button>
        </form>

    </div>
    <div class="last-changes-info">
        <ol>
            <?php if ($data): ?>
                <?php foreach ($data as $changes): ?>
                    <?php foreach ($changes as $change): ?>

            <li> <div class="parent" > <a class="parent" title="" href="index.php?sap=<?= $change->getSap() ?>"><?= $change->getSap() ?></a>&nbsp 
                            &nbsp <?= $change->getCell() ?> &nbsp <?= $change->getUpdateDate() ?>&nbsp  
                            <img class="child" src="https://praktiker.bg<?= $change->getPath() ?>" alt="alt" width="50" height="50">
                </div> </li><hr><br>

                    <?php endforeach; ?>

                <?php endforeach; ?>
            <?php endif; ?>
        </ol>

    </div>

</main>





