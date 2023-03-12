<?php require_once __DIR__ .'../../header.php';?>

<div style="font-size: 25px; color: red ">МУЛТИ ПРОМЕНЯНЕ!!!!</div>
<div style="font-size: 22px; color: green ">
    <?php if ($data['tile']): ?>
        <?php foreach ($data['tile'] as $article)
             ?>
        <p>Артикул <?= $article->getSapNum() ?> <?= $article->getArticleName() ?> записан в # <?= $article->getCellFromInput() ?></p> 
        <p></p> 

<?php endif; ?>

</div>
<?php if ($errors): ?>

    <?php foreach ($errors as $error): ?>
        <p style="font-size: 20px; color: red"> <?= $error ?></p>
    <?php endforeach; ?>
<?php endif; ?>
<form method="post" >
    <table>

        <tr>
            <th>Сканирай клетка:</th>
            <td><input id="focusCell" type="text" name="cell" value="" maxlength="4"/></td>
        </tr>


        <tr>
            <td></td>
            <td>
                <button style="background-color: #59b300" type="submit" name="edit_cell" value="1">Напред</button>
            </td>
        </tr>
    </table>


</form>
</main>
</body>

