<div class="jumbotron">
    <?php if($_SESSION['groupe']==1){ ?>
        <h3>Mon compte</h3>
            <br/>
            <a href="index.php?page=moncompte?infpers" class="boutons">Informations personnelles</a>
            <a href="index.php?page=moncompte?emdp" class="boutons">Email et mot de passe</a>
            <a href="index.php?page=moncompte?rdv" class="boutons">Réservation et rendez-vous</a>
            <a href="index.php?page=moncompte?delete" class="boutons">Supprimer mon compte</a>
            <br/> <?php
        echo "<h3>Désolé mais l'administrateur principal ne peux pas être supprimé</h3>";
    }
    else{
?>
<h3>Mon compte</h3>
        <br/>
        <a href="index.php?page=moncompte?infpers" class="boutons">Informations personnelles</a>
        <a href="index.php?page=moncompte?emdp" class="boutons">Email et mot de passe</a>
        <a href="index.php?page=moncompte?rdv" class="boutons">Réservation et rendez-vous</a>
        <a href="index.php?page=moncompte?delete" class="boutons">Supprimer mon compte</a>
        <br/>
<h3> Supprimer mon compte </h3><br/>
    <form method="post" name="deleted" action="index.php?page=moncompte?delete">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th scope="row"><label>Saisir votre mot de passe pour confirmer la suppression de votre compte</label></th><td><input type="password" name="password"</td>
                </tr>
                <tr>
                    <th scope="row"><label></label></th><td><input type="submit" name="valider" value="Supprimer mon compte"</td>
                </tr>
            </tbody>
        </table>
    </form>
<?php
    if(isset($_POST['valider'])){
        $passhash=$bdd->prepare("select motPasse from membre where idMembre=:idSession");
        $passhash->execute(array(
           'idSession' => $_SESSION['idMembre'] 
        ));
        
        $hash=$passhash->fetch();
        
        if(password_verify($_POST['password'],$hash[0])){
            $controle=true;
        }
        else{
            $controle=false;
        }
        
        if($controle==true){
            supprimerMembre($_SESSION['idMembre'], $bdd);
            session_destroy();?>
            <META HTTP-EQUIV="Refresh" CONTENT="1; URL=index.php?page=accueil"> <?php
        }
        else{
            echo "<p1>Mot de passe invalide</p1>";
        }
    }
    }
?>
</div>

