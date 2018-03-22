<?php session_start(); ?>
<!DOCTYPE html> <!-- Obligatoire pour faire fonctionner le framework CSS Bootstrap -->
<html>
    <header>
        <?php 
        require_once("/procedureFonctions/procfonc.php");
        $hote="localhost";
        $base="aeroMoisselles";
        $utilisateur="root";
        $pass="siojjr";
        $bdd= connexionMySQLBDD($hote,$base,$utilisateur,$pass);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //auto inscription de l'administrateur
        
        //Vérification si il existe un admin sur le site
        $req=$bdd->prepare("select * from membre where Groupe_idGroupe=1");
        $req->execute();
        $controleAdmin=$req->fetch();
        if($controleAdmin==null){
            autoinscriptionAdmin("admin", "admin", "Aéroclub", "Les ailerons", "info@lesailerons.fr", "0139910560", "Rue du Moutier", 95570, "Moisselles", "1931-01-01", $bdd);
        }
        else{
            
        }
        ?>      
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Template pour l'affichage sur un mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<title>Les Ailerons</title>
        <center>
            <h1>Les Ailerons</h1>
            <h2>Aéroclub d'Enghien-Moisselles</h2>-->
            
        <center><img src="img/principalsite/logosite.jpg"/></center>
            
            
            <!--Charge toutes les classes de bootstrap -->
            <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet "> 
            <!--Chargement du css-->
            <link href="css/style.css" rel="stylesheet">
            
            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        </center>
    <center
    </header>
    <body>
        <nav class="navbar navbar-inverse navbar-link">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" 
                            data-toggle="collapse" data-target="#navbar" 
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Barre de navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <!-- Ajout du bouton accueil qui est redirigé grâce à la vue-->
                        <li><a href="index.php?page=accueil">Accueil</a></li>
                        <li><a href="index.php?page=tarifs">Tarifs</a></li>
                        <?php if($_SESSION==null){
                            echo "";
                        }
                        else{
                            if($_SESSION['groupe']==1){ ?>
                                <!--<li><a href="index.php?page=gestiontarifs">Gestion des tarifications</a></li>-->
                            <?php }
                            else{
                            
                            } 
                        }
                        ?>
                        <?php if($_SESSION==null){
                            echo "";
                        }
                        else{
                            if($_SESSION['groupe']==1){
                                ?>
                                <li><a href="index.php?page=gestvol">Gestion des rendez-vous</a></li>
                                <?php
                            }
                        }
                        ?>
                        <li><a href="index.php?page=avions">Les avions</a></li>
                        <?php if($_SESSION==null){
                            echo "";
                        }
                        else{
                            if($_SESSION['groupe']==1){
                                ?> <li><a href="index.php?page=gestavion">Gestion des avions</a></li> 
                                <?php
                            }
                        }
                        ?>
                        <?php if($_SESSION==null){
                            echo "";
                        }
                        else{
                            if($_SESSION['groupe']==1){
                                ?>
                                <li><a href="index.php?page=menumembres">Gestion des Membres</a></li>
                                <?php
                            }
                        }
                        ?>
                        <?php if($_SESSION==null){
                            echo "";
                        }
                        else{
                            if($_SESSION['groupe']==1 || $_SESSION['groupe']==2){
                                ?>
                                <li><a href="index.php?page=reservation">Réserver un Baptème</a></li>
                                <?php
                            }
                        }
                        ?>
                        <?php if($_SESSION==null){
                            ?>
                                <li><a href="index.php?page=login">Connexion</a></li>
                            <?php    
                        }
                        else{
                            ?>
                                <li><a href="index.php?page=logout">Déconnexion</a></li>
                            <?php
                        }
                        ?>
                        <?php if($_SESSION==null){
                            ?>
                                <li><a href="index.php?page=inscription">Inscription</a></li>
                            <?php
                            }    
                            else{
                                ?>
                                <li><a href="index.php?page=moncompte">Mon compte</a></li>
                                <?php        
                            }
                        ?>    
                    </ul>
                </div>
            </div>
        </nav>
        
        
        
        <?php
        /* Inclusion de page dans l'index.php */
        if(isset($_GET['page'])){
            $page=$_GET['page'];
        }
        else{
            $page="accueil";
        }
        switch($page){
            case "accueil" :
            include("views/Accueil.php");
            break;
            case "gestiontarifs" :
            include("views/gestTarif.php");
            break;
            case "gestvol" :
            include("views/gestionvol.php");
            break;
            case "avions" :
            include("views/avions.php");
            break;
            case "inscription" :
            include("views/inscription.php");
            break;
            case "inscriptionréussi" :
            include("views/inscriptionreussi.php");
            break;
            case "login" :
            include("views/login.php");
            break;
            case "logout" :
            include("views/logout.php");
            break;
            case "gestavion" :
            include("views/gestavion.php");
            break;
            case "menumembres" :
            include("views/menumembres.php");
            break;
            case "reservation" :
            include("views/reservation.php");
            break;
            case "moncompte" :
            include("views/compte.php");
            break;
            case "tarifs":
            include("views/tarifs.php");
            break;
            case "moncompte?infpers":
            include("views/moncompte/infpers.php");
            break;
            case "moncompte?emdp" :
            include("views/moncompte/emdp.php");
            break;
            case "moncompte?rdv" :
            include("views/moncompte/rdv.php");
            break;
            case "moncompte?delete" :
            include("views/moncompte/delete.php");
            break;
            case "menumembres?listmembres" :
            include("views/gestionMembres/listmembres.php");
            break;
            case "menumembres?gestmembres" :
            include("views/gestionMembres/gestmembres.php");
            break;
            
        }
        ?>
        <?php include("pied.php"); ?>
        
        
        
        <!--Chargement de la librairie jQuery -->
        <script src="bootstrap/dist/js/jquery.js"></script> 
        <script src="bootstrap/dist/js/bootstrap.js"></script>
        <script>
            
        </script>
    </body><?php
    /* Vérification des utilisateurs connecté si ils sont bloqué ou ils ont changé de groupe */
    if($_SESSION==null){
        
    }
    else{
        $req=$bdd->prepare("select * from membre where idMembre=:idMembre");
        $req->execute(array(
            'idMembre' => $_SESSION['idMembre']
        ));
        while($resultat=$req->fetch()){
            $_SESSION['idMembre'] = $resultat['idMembre'];
            $_SESSION['nomUtilisateur']= $resultat['nomUtilisateur'];
            $_SESSION['motPasse']=$resultat['motPasse'];
            $_SESSION['nom']=$resultat['nom'];
            $_SESSION['prenom']=$resultat['prenom'];
            $_SESSION['email']=$resultat['email'];
            $_SESSION['numTel']=$resultat['numTel'];
            $_SESSION['adresse']=$resultat['adresse'];
            $_SESSION['cp']=$resultat['cp'];
            $_SESSION['ville']=$resultat['ville'];
            $_SESSION['groupe']=$resultat['Groupe_idGroupe'];
            $_SESSION['dateNaissance']=$resultat['dateNaissance'];
            $_SESSION['date_inscription']=$resultat['date_inscription'];
        }
        /* Si l'utilisateur actuellement connecté se fait bloquer son compte alors sa le déconnecte automatiquement */
        if($_SESSION['groupe']==4){
            
            session_destroy();
        }
    }
    ?>
</html>
