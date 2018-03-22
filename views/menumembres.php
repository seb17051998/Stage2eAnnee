<div class="jumbotron">
<?php if($_SESSION['groupe']!=1){
    echo "<h3>Désolé mais vous n'avez pas l'autorisation d'accéder à cette page</h3>";
}
else{
    if(isset($_GET['page'])){
            $souspage=$_GET['page'];
        }
        else{
            $souspage="listmembres";
        }
        
        
        
    ?>
    
        <h3>Mon compte</h3>
        <br/>
        <a href="index.php?page=menumembres?listmembres" class="boutons">Liste des membres</a>
        <a href="index.php?page=menumembres?gestmembres" class="boutons">Gestion des membres</a>


    <?php
}
?>
</div>