<?php require_once __DIR__ . '../../header.php'; ?>


<div>
    <?php if ($errors): ?>
        <?php foreach ($errors as $error): ?>
            <p style="font-size: 20px; color: red"> <?= $error ?></p>
        <?php endforeach; ?>
    <?php endif ?>
</div>

<p></p>


<h1>Направи списък:</h1>
<div class="form">
<form method="post">
    <div class="insert-list">
    <label for="fname">Артикул:</label>&nbsp
    <input type="text" id="article" name="a1" value="<?=$data[0]['a1']?>" minlength="6">&nbsp
    <label for="lname">X</label>&nbsp
    <input type="text" id="quantity" name="q1" value="<?=$data[0]['q1']?>" maxlength="3">&nbsp 
    <span>бр.</span>&nbsp<span class="listError"><?=(isset($data[1]['e1']))?($data[1]['e1']):('')?></span>
    </div><br>
    <div class="insert-list">
    <label for="fname">Артикул:</label>&nbsp
    <input type="text" id="article" name="a2" value="<?=$data[0]['a2']?>">&nbsp
    <label for="lname">X</label>&nbsp
    <input type="text" id="quantity" name="q2" value="<?=$data[0]['q2']?>" maxlength="3">&nbsp
    <span>бр.</span>&nbsp<span class="listError"><?=(isset($data[1]['e2']))?($data[1]['e2']):('')?></span>
    </div><br>
    <div class="insert-list">
    <label for="fname">Артикул:</label>&nbsp
    <input type="text" id="article" name="a3" value="<?=$data[0]['a3']?>">&nbsp
    <label for="lname">X</label>&nbsp
    <input type="text" id="quantity" name="q3" value="<?=$data[0]['q3']?>" maxlength="3">&nbsp
    <span>бр.</span>&nbsp<span class="listError"><?=(isset($data[1]['e3']))?($data[1]['e3']):('')?></span>
    </div><br>
    <div class="insert-list">
    <label for="fname">Артикул:</label>&nbsp
    <input type="text" id="article" name="a4" value="<?=$data[0]['a4']?>">&nbsp
    <label for="lname">X</label>&nbsp
    <input type="text" id="quantity" name="q4" value="<?=$data[0]['q4']?>" maxlength="3">&nbsp
    <span>бр.</span>&nbsp<span class="listError"><?=(isset($data[1]['e4']))?($data[1]['e4']):('')?></span>
    </div><br>
    <div class="insert-list">
    <label for="fname">Артикул:</label>&nbsp
    <input type="text" id="article" name="a5" value="<?=$data[0]['a5']?>">&nbsp
    <label for="lname">X</label>&nbsp
    <input type="text" id="quantity" name="q5" value="<?=$data[0]['q5']?>" maxlength="3">&nbsp
    <span>бр.</span>&nbsp<span class="listError"><?=(isset($data[1]['e5']))?($data[1]['e5']):('')?></span>
    </div><br>
    <div class="insert-list">
    <label for="fname">Артикул:</label>&nbsp
    <input type="text" id="article" name="a6" value="<?=$data[0]['a6']?>">&nbsp
    <label for="lname">X</label>&nbsp
    <input type="text" id="quantity" name="q6" value="<?=$data[0]['q6']?>" maxlength="3">&nbsp
    <span>бр.</span>&nbsp<span class="listError"><?=(isset($data[1]['e6']))?($data[1]['e6']):('')?></span>
    </div><br>
    <div class="insert-list">
    <label for="fname">Артикул:</label>&nbsp
    <input type="text" id="article" name="a7" value="<?=$data[0]['a7']?>">&nbsp
    <label for="lname">X</label>&nbsp
    <input type="text" id="quantity" name="q7" value="<?=$data[0]['q7']?>" maxlength="3">&nbsp
    <span>бр.</span>&nbsp<span class="listError"><?=(isset($data[1]['e7']))?($data[1]['e7']):('')?></span>
    </div><br>
    <div class="insert-list">
    <label for="fname">Артикул:</label>&nbsp
    <input type="text" id="article" name="a8" value="<?=$data[0]['a8']?>">&nbsp
    <label for="lname">X</label>&nbsp
    <input type="text" id="quantity" name="q8" value="<?=$data[0]['q8']?>" maxlength="3">&nbsp
    <span>бр.</span>&nbsp<span class="listError"><?=(isset($data[1]['e8']))?($data[1]['e8']):('')?></span>
    </div><br>
    <div class="insert-list">
    <label for="fname">Коментар:</label>&nbsp
    <input type="text" id="comment" name="comment" value="<?=$data[0]['comment']?>">&nbsp &nbsp &nbsp &nbsp
                                    <button id="button" style="background-color: #59b300" type="submit" name="search" value="1" >ТЪРСИ</button>
                                      &nbsp<span class="listError"><?=(isset($data[1]['e9']))?($data[1]['e9']):('')?></span>
    </div><br>

</form>
</div>


</div>
