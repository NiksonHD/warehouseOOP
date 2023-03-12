<?php /* * @var \App\Data\EmailDTO $data */ ?>
<?php require_once __DIR__ . '../../header_bons.php'; ?>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post"  >
    <ul>
        <?php foreach ($data['emails'] as $email): ?>


        <li >

                <input 
                    type="radio" name="id" value="<?=$email->getId() ?>" /><?=$email->getAddress()?> - <?= $email->getActive() === true ? 'активен' : 'неактивен'  ?>
        </li>
        <?php endforeach; ?>

       
                <button id="button" style="background-color: green" type="submit" name="activate" value="1" >Напред</button>

    </ul>
</form>

<div>


</div>
</div>

</main>





