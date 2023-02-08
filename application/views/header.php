<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REgister Page</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
</head>
<body>
<div class="col-lg-5 col-lg-offset-2">
    <a href="<?php echo base_url('user/profile'); ?>">Accueil</a>
    <br>
    <a href="<?php echo base_url('user/newObject'); ?>">Nouvel article.</a>
    <br>
    <a href="<?php echo base_url(); ?>index.php/auth/logout">Logout</a>
    <br>
    <a href="<?php echo base_url('user/demande_list'); ?>">Liste des demandes</a>
    <br>
    <?php if($_SESSION['estAdmin']) { ?>
        <a href="<?php echo base_url('admin/categorie'); ?>">Gestion des categories</a>
        <br>
        <a href="<?php echo base_url('admin/statistique'); ?>">Statistique</a>
    <?php } ?>
    <br>
    <a href="<?php echo base_url('user/chercher'); ?>">Recherche</a>
    <br>
    <a href="<?php echo base_url('user/historique'); ?>">Historique</a>
    
</div>