<?php require_once __DIR__ . '../../header.php'; ?>
<button onclick="document.location = 'list.php'" type="button">Направи списък</button>

<form method="post"  >
    <table>
<!--        <tr>
        <span id="hidden" style="color: red"></span>
        <th>Списък</th>
        <input type="hidden" name="lists" value=""/>
        <td><input style="height: 20px; width: 20px" type="checkbox" name="lists" value="1" title="Маркирай тук ако искаш да запазиш търсенето, като лист"/></td>
        </tr>-->
        <tr>
            <th  style="color:#4583c2;">ТЪРСЕНЕ ПЛОЧКИ</th>
            <?php foreach ($errors as $error): ?>
            <p style="color: red"><?= $error ?></p>
        <?php endforeach; ?>
        <td >



            <input id="focusCell" title=" Примери за списъци:
                   494001.3.494002.12;
                   494001.494002.494003" type="text" name="tileNumber" value=""/></td>

        </tr>

        <tr>
            <th>Коментар:</th>
            <td>
                <div>
                    <input title="Добавянето на име към коментара помага на склада!" type="text" name="comment" value=""/><br>
                </div>
            </td>
            <td>
                <button id="button" style="background-color: #59b300" type="submit" name="search" value="1" >ТЪРСИ</button>
            </td>
        </tr>
    </table>
</form>

<?php if ($data['tile']): ?>
    <div class="output-info">
        <?php foreach ($data['tile'] as $tile): ?>
            <p> Артикул: <span><a target='_blank' href='http://praktiker.bg/p/<?= $tile->getSap() ?>'><?= $tile->getSap() ?></a></span>
                <span><?= $tile->getName() ?></span>,<br>

                EAN: <?= $tile->getEan() ?>, <br>
                наличност: <?= $tile->getQuantity() ?> бр. към: <?= $tile->getUpdateDate() ?>,<br>
                клетки: <?php foreach ($tile->getCells() as $cell): ?>  
                    <button title="Последно записване в клетката: <?= $cell->getUpdateDate() ?>" onclick="document.location = 'edit_article.php?cell=<?= $cell->getCell() ?>'" type="button"><?= $cell->getCell() ?></button>
                <?php endforeach; ?>
            </p>
            <button onclick="document.location = 'edit.php?article=<?= $tile->getSap() ?>'" type="button">ЗАПИШИ В</button>

                    <!--<a href="edit.php?article=<?= $tile->getSap() ?>">ЗАПИШИ В</a>-->
        <br>
        <?php if ($tile->getShowPic()): ?>
        <img src="https://praktiker.bg<?= $tile->getPicPath() ?>" width="140" height="140">
        <?php endif; ?>

        <hr><br>

    <?php endforeach; ?>
    </div>
<?php endif; ?>



</div>

</main>





