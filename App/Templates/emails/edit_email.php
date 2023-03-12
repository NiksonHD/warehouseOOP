<?php /* * @var \App\Data\FiscalDTO $data */ ?>
<?php require_once __DIR__ . '../../header_bons.php'; ?>
<?php if (isset($data['bons']) && $data['bons']->getBonNumber() != null): ?>
    <div style="color: green">
        Записанa: Поръчка № 
        <?= $data['bons']->getBonNumber() ?>
    </div>
<?php endif; ?>
<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post"  >
    <table>
        

        <tr >
            <th  style="color:blue">Въведи email</th>

            <td >
                <input style="width: 125px;"id="bon_number" 
                       type="email" name="address" value="" /></td>
        </tr>

        <tr>
            <td>
                <input id="button" style="background-color: #59b300" type="submit" name="edit" value="Въведи" />
            </td>
        </tr>

    </table>
</form>

<div>


</div>
</div>

</main>





