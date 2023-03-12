<?php require_once __DIR__ . '../../header.php'; ?>


<h2>Настройки за достъп </h2>
<br>
<hr>
<div class="cpanel">
    <ol>
        <?php /** @var App\Data\IpDTO $data */ ?>
        <?php foreach ($data['ips'] as $ip): ?>

            <li>
                <button onclick="document.location = 'edit_access_ip.php?ip=<?= $ip->getId() ?>'" type="button"><?= $ip->getIp() ?></button>
                 Картинки: <span><?= $ip->getPic() ? 'Включено' : 'Изключено' ?></span>,
                Редактор: <span><?= $ip->getEdit() ? 'Включено' : 'Изключено' ?></span>
                
            </li>
            <p>

            </p>
            <hr>

        <?php endforeach; ?>
    </ol>

</div>




</main>





