<div class="jumbotron">
    <?php if($_SESSION==null){
        echo '<h3>Désolé, vous devez créer un compte pour pouvoir réserver un vol</h3><br/>';
        echo '<h3><a href="index.php?page=inscription">Cliquez ici pour vous inscrire</a>';
    }
    else{
        ?>
        <h3>Réserver un vol</h3>
        
        <br/>
            <h3>Page en construction</h3>
        <?php
        
    }
?>
</div>