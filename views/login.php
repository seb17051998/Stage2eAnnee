<div class="jumbotron">
    <h3>Se connecter</h3>
    <table class="table table-striped">
        <tbody>
            <form method="post" name="login" action="index.php?page=login"
                <tr>
                    <th scope="row"><label>Nom d'utilisateur: </label></th>
                    <td><input type="text" name="username"/><br/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Mot de passe: </label></th>
                    <td><input type="password" name="password"/><br/></td>
                </tr>
                <!--<tr>
                    <th scope="row"></th><td><input type="checkbox" name="savelogin" id="savelogin"/>
                    <label for="savelogin">Connexion automatique</label></td>
                </tr>-->
                <tr>
                    <th scope="row"></th><td><input type="submit" name="valider" value="Connexion"/></td>
                </tr>
            </form>
        </tbody>      
    </table>
<?php
    
    if(isset($_POST['valider'])){
        $user=$_POST['username'];
        $password=$_POST['password'];
        if(empty($_POST["username"]) || empty($_POST["password"])){
            echo "<p1>Veuillez remplir tout les champs</p1>";
        }
        else{
  
            $prerequete=$bdd->prepare('select motPasse from membre where nomUtilisateur=:user');
            $prerequete->execute(array(
               'user' => $user 
            ));
            $motPassehash=$prerequete->fetch();
            if(password_verify($password, $motPassehash[0])){
                $controle=true;
            }
            else{
                $controle=false;
            }
                    
            //si le pseudo est dans la base alors se connecter si il existe pas alors il y a un message d'erreur
            /*Hachage du mot de passe
            $pass_hashed=  password_hash($_POST["password"],PASSWORD_DEFAULT);
            echo $pass_hashed;*/
            //Vérification des identifiants
            $requete=$bdd->prepare('select * from membre where nomUtilisateur=:username');
            $requete->execute(array(
                'username' => $user,
            ));
        
            $resultat=$requete->fetch();
            
            
            
            if ($controle == false){
                echo "<p1>Votre nom d'utilisateur et/ou votre mot de passe est incorrect</p1>";
            }
            else{
                if ($resultat['Groupe_idGroupe']==4){
                    echo "<p1>Votre compte à été bloqué</p1>";
                    session_destroy();
                }
                else{
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
                echo $_SESSION['nomUtilisateur'];
                
                
                echo "<p2>Connexion réussi, vous allez être redirigé vers l'accueil</p2>";
                ?> <META HTTP-EQUIV="Refresh" CONTENT="2; URL=index.php?page=accueil"> <?php
                }
            }
        }
    }
?> <div>
