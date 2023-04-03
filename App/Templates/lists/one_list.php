<?php require_once __DIR__ . '../../header.php'; ?>
<h2>Лист # <?= $data[0]->getId(); ?>&nbsp, <span><?= $data[0]->getComment() ?></span>
    <small>от <?= $data[0]->getUpdateDate() ?></small>
        <br><img  alt="<?= $data[0]->getId() ?>" src="barcode.php?text=<?= $data[0]->getId() ?>&size=10&print=true" />

</h2> 
<hr>
<div class="one-list-output">
    <?php foreach ($data as $tiles): ?>
        <?php foreach ($tiles->getTiles() as $tile): ?>
            <p>
                <span>
                    <a href="index.php?sap=<?= $tile->getSap() ?>"><?= $tile->getSap() ?></a> &nbsp<?= $tile->getName() ?>,
                    
                </span><br>
                EAN:&nbsp<?= $tile->getEan() ?>,<br>
                Наличност:&nbsp<?= $tile->getQuantity() ?> бр., към <?= $tile->getUpdateDate() ?>
                <?php if ($tile->getShowPic()): ?>
                        <img class="one-list-img" src="https://praktiker.bg<?= $tile->getPicPath() ?>" width="60" height="60">
                    <?php endif; ?>
                ,<br>
                Клетки:&nbsp 
                <?php foreach ($tile->getCells() as $cell): ?>
                    <button title="Последно записване в клетката: <?= $cell->getUpdateDate() ?>" onclick="document.location = 'edit_article.php?cell=<?= $cell->getCell() ?>'" type="button"><?= $cell->getCell() ?></button>

                                <!--<a title="Последно записване в клетката: <?= $cell->getUpdateDate() ?>" href="edit_article.php?cell=<?= $cell->getCell() ?>">#(<?= $cell->getCell() ?>)</a>-->

                <?php endforeach; ?>
            </p>
            <p>
                За товарене: <?= $tile->getLoads() ?> бр.
            </p>
            <hr>
        <?php endforeach; ?>
    <?php endforeach; ?>


</div>




</main>





