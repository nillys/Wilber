<head>

    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="../Ressource_code/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="WB_main_css.css">
    <link rel="stylesheet" type="text/css" href="WB_main_theme.css">
    <link rel="stylesheet" type="text/css" href="Ressource_icone/open-iconic-master/open-iconic-master/font/css/open-iconic-bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


</head>
<?php

include "Form.php";

    $article_check = new form_manager();
    $article_check->checking_integrity("nom","nom");
    $article_check->checking_integrity("age","age",0,[1,1,2]);
    $article_check->result();


?>


<form action="" method="post">
    <div class="form-group">
        <label>nom : </label>
        <input name="nom" value="<?php if(!empty($_POST['nom'])){echo $_POST['nom'];}?>">
    </div>
    <div class="form-group">
        <label>age : </label>
        <input name="age" value="<?php if(!empty($_POST['age'])){echo $_POST['age'];}?>">
    </div>
    <button type="submit">Valider</button>

</form>