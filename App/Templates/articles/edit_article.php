<?php /**@var \App\Data\ArticleDimensionsDTO $data */  ?>
<?php require_once __DIR__ . '../../header.php'; ?>
   <?php if($data && $data->getEan() !== null): ?>
<div style="color: green">
    Записан: Артикул с EAN :  
    <?=$data->getEan(); ?>
    и размери: 
    (Ш=<?=$data->getWidth()?>, Д=<?=$data->getLength()?>, В=<?= $data->getHeight()?>, Т=<?= $data->getWeight()?>)
</div>
<?php endif; ?>
<?php foreach ($errors as $error): ?>
            <p style="color: red"><?= $error ?></p>
        <?php endforeach; ?>
<form method="post" Onload='document.getElementById("tileNumber").focus()' >
    <!--<button onclick="document.location = 'easy_list.php'" type="button">Направи списък</button>-->
    <table>

        <tr >
            <th  style="color:blue">Ширина</th>
            
        <td >
            <input style="width: 45px;" id="search_input" 
                  type="text" name="width" value=""/></td>
        </tr>
        <tr >
            <th  style="color:blue">Дължина</th>
           
        <td >
            <input style="width: 45px;" id="search_input" 
                   type="text" name="length" " /></td>
        </tr>
        <tr >
            <th  style="color:blue">Височина</th>
            
        <td >
            <input style="width: 45px;" id="search_input" 
                   type="text" name="height" value="" /></td>
        </tr>
        <tr >
            <th  style="color:blue">Тегло</th>
            
        <td >
            <input style="width: 45px;" id="search_input" 
                   type="text" name="weight" value="" /></td>
        </tr>
        <tr >
            <th  style="color:blue">Сканирай код</th>
            
        <td >
            <input style="width: 125px;"id="search_input" 
                   type="text" name="ean" value="" /></td>
        </tr>
        <tr>
            <td>
                <button id="button" style="background-color: #59b300" type="submit" name="edit" value="1" >Въведи</button>
            </td>
        </tr>

    </table>
</form>
           
    <div>
        

    </div>
</div>

</main>





