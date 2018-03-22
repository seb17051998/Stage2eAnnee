<div class="jumbotron">
<?php if($_SESSION==null){
    echo "<h3>Désolé mais vous n'avez pas l'autorisation d'accéder à cette page</h3>";
}
else{
    if(isset($_GET['page'])){
            $souspage=$_GET['page'];
        }
        else{
            $souspage="infpers";
        }
        
        
        
    ?>
    
        <h3>Mon compte</h3>
        <br/>
        <a href="index.php?page=moncompte?infpers" class="boutons">Informations personnelles</a>
        <a href="index.php?page=moncompte?emdp" class="boutons">Email et mot de passe</a>
        <a href="index.php?page=moncompte?rdv" class="boutons">Réservation et rendez-vous</a>
        <a href="index.php?page=moncompte?delete" class="boutons">Supprimer mon compte</a>

    <?php
}
?>
</div>