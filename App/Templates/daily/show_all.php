<?php /* * @var App\Data\DailyDTO $data */ ?>

<?php require_once __DIR__ . '../../header.php'; ?>
<main>
    <h1> Дневни Търсения</h1>
    <button class="make-list" onclick="document.location = 'daily.php'" type="button">All devices</button>
    <div class="daily-output-info">
        <ul>
            <?php if ($data['tile']): ?>
                <?php foreach ($data['tile'] as $daily): ?>
                    <li><?= substr($daily->getCreateDate(), -8, -3) ?>&nbsp <a href="index.php?sap=<?= $daily->getSap() ?>"><?= $daily->getSap() ?></a>&nbsp <?= $daily->getName() ?>
                    </li><hr><br>


                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

    </div>

</main>





