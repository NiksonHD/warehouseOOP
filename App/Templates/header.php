<!DOCTYPE html>  
<html class="html">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title> Търсене Артикули</title>

        <link rel="stylesheet" type="text/css" href="App/Templates/styles/style.css">
    </head>
    
    <header>
    <div id="navbar">
        
            
            
            
            <a href="menu_page.php">H</a>
            <a href="index.php">ТЪРСЕНЕ</a>
            <!--<a href="edit_article_dimensions.php">Въвеждане размери</a>-->
            <!--<a href="export_data.php">Export</a>-->
            <a href="show_lists.php">СПИСЪЦИ</a>
            <a href="daily.php">DAILY</a>
            <?php if (key_exists('user', $data) && ($data['user'])): ?>
            <a href="logout.php">LOGOUT >> <?=$data['user']->getUsername()?></a>
            <?php endif; ?>
        
    </div>
    </header>
    <body id="bodyStyle" Onload='document.getElementById("focusCell").focus()'>
        <main>
            <br>