<?php require_once __DIR__ . '../../header.php'; ?>


<h2>Настройки на IP </h2>
<br>
<hr>
<div>
    <ol>
        <?php /** @var App\Data\IpDTO $data */ ?>
        <?php foreach ($data as $ip): ?>

            <div>

                <p>
                    IP: <?= $ip->getIp() ?> 
                </p>
                <form method="post">
                    <input hidden="" type="text" name="settings" value="1" />
                <p>
                    <label for="pic">картинки</label>
                    <input type="checkbox" name="pic" value="1" <?= $ip->getPic()?'checked':''?>/>
                </p>
                <p>
                    <label for="edit">Редактиране</label>
                    <input type="checkbox" name="edit" value="1" <?= $ip->getEdit()?'checked':''?>/><br><br>
                    <button id="button" style="background-color: #59b300" type="submit" name="change" value="1" >Запази</button>

                </p>
                </form>
            </div>

            <hr>

        <?php endforeach; ?>
    </ol>

</div>




</main>





