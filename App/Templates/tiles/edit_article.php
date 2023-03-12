<?php require_once __DIR__ .'../../header.php';?>


<div>
    <?php foreach ($errors as $error):?>
    <p style="font-size: 20px; color: red"> <?= $error?></p>
    <?php endforeach;?>
    
</div>

<p></p>
<div style="font-size: 20px; color: red">CHG клетка: <?= ($data)?$data['cell']: ''?> </div>

<div style="font-size: 15px; color: darkblue">В момента:
            <?php if($data['tile']):?>
<?php foreach ($data['tile'] as $article): ?>

    <p>

    <?=  $article->getSap();?>
    <?=  $article->getName();?>
    </p>
    <?php endforeach; ?>
        <?php endif;?>

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
