<?php require_once __DIR__ . '../../header.php'; ?>

<div style="font-size: 25px; color: red ">МУЛТИ ПРОМЕНЯНЕ!!!!</div>
<div>
    <?php foreach ($errors as $error): ?>
        <p style="font-size: 20px; color: red"> <?= $error ?></p>
    <?php endforeach; ?>
</div>

<p></p>
<div style="font-size: 20px; color: red">CHG клетка: <?= ($data) ? $data[0] : '' ?> </div>
<div> 
    <?php if (key_exists(1,$data)): ?>
    <?php foreach ($data[1] as $tile): ?>
    <p>Записан: <?=$tile->getSap()?>&nbsp<?=$tile->getName()?></p>
    <?php endforeach; ?>
<?php endif; ?>
</div>


<form method="post">
    <table>

        <tr>
            <th>Въведи номер:</th>
            <td><input id="focusCell" type="text" name="article" value=""/></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button style="background-color: #59b300" type="submit" name="edit_article" value="1">Запази</button>
            </td>
        </tr>
    </table>


</form>


</div>
