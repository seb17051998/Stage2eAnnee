<div class="jumbotron">
<h3>Mon compte</h3>
        <br/>
        <a href="index.php?page=moncompte?infpers" class="boutons">Informations personnelles</a>
        <a href="index.php?page=moncompte?emdp" class="boutons">Email et mot de passe</a>
        <a href="index.php?page=moncompte?rdv" class="boutons">Réservation et rendez-vous</a>
        <a href="index.php?page=moncompte?delete" class="boutons">Supprimer mon compte</a>
        <br/>
<h3> Email et mot de passe </h3>
<br/>
                        <form method="post" name="email" action="index.php?page=moncompte?emdp">
                            <table class="table table-striped">
                                <thead>
                                    <th scope="col" colspan="2" align="center"><h4 style="color:red; text-align: center;">Modifier mon adresse mail</h4></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"><label>Adresse email actuelle : </label></th><td><input type="text" name="ancienMail"/></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label>Nouvelle email :</label></th><td><input type="text" name="nouveauMail"/></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label>Changer mon adresse mail</label></th><td><input type="submit" name="valider" value="Modifier mon mail"/></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <form method="post" name="mdp" action="index.php?page=moncompte?emdp">
                            <table class="table table-striped">
                                <thead>
                                    <th scope="col" colspan="2" align="center"><h4 style="color:red; text-align: center;">Modifier mon mot de passe</h4></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"><label>Mot de passe actuelle : </label></th><td><input type="text" name="ancienMDP"/></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label>Nouvelle mot de passe : </label></th><td><input type="text" name="nouveauMDP"/></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label>Confirmer votre mot de passe : </label></th><td><input type="text" name="memeMDP"/></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label>Changer mon mot de passe</label></th><td><input type="submit" name="valider" value="Modifier mon mot de passe"/></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                            <?php
                                if(isset($_POST['valider'])){
                                    /* Prérequête */
                                    $req=$bdd->prepare("select * from membre where idMembre=:idSession");
                                    $req->execute(array(
                                        'idSession' => $_SESSION['idMembre']
                                    ));
                                    $resultat=$req->fetch();
                                    /* Menu pour fonctions  */
                                    $choix= $_POST['valider'];
                                    switch($choix){
                                        case "Modifier mon mail" :
                                        /* Modification de l'email */

                                        //attribution de variables
                                        $emailActuelle = $_POST['ancienMail'];
                                        $nouveauMail= $_POST['nouveauMail'];
                                        //On compare l'email du $_POST avec la base de donnée pour voir si c'est bien cette adresse
                                        if($emailActuelle == $resultat['email']){
                                            //On effectue la modification
                                            modifierMail($_SESSION['idMembre'], $nouveauMail, $bdd);
                                            echo "<p2>Modification réussi</p2>";
                                        }
                                        else{
                                            echo "<p1>L'email actuelle que vous avez entrée n'est pas valide </p1>";
                                            
                                        }
                                        break;
                                        case "Modifier mon mot de passe" :
                                            /* Modification du mot de passe */
                                            
                                            //Préparation des variables
                                            $motPasseActuel=$_POST['ancienMDP'];
                                            $nouveauPass=$_POST['nouveauMDP'];
                                            $confPass=$_POST['memeMDP'];
                                            
                                            //On vérifie si le nouveau mot de passe est identique a la confirmation du mot de passe
                                            if($nouveauPass!=$confPass){
                                                echo "<p1>Le champ Nouveau mot de passe n'est pas identique à celui du champs Confirmer votre mot de passe</p1>";
                                            }
                                            else{
                                                /* Pour le mot de passe actuel */
                                                //On fait une prérequete pour avoir le mot de passe hasché
                                                $prerequete=$bdd->prepare("select motPasse from membre where idMembre=:idSession");
                                                $prerequete->execute(array(
                                                    'idSession' => $_SESSION['idMembre']
                                                ));
                                                //Récupération du mot de passe hasché
                                                $hashPass=$prerequete->fetch();
                                                
                                                //Comparaison entre le mot de passe hasché et le mot de passe normal
                                                if(password_verify($motPasseActuel, $hashPass[0])){
                                                    $controle=true;
                                                }
                                                else{
                                                    $controle=false;
                                                }
                                                
                                                //Résultat de la vérification du mot de passe actuelle
                                                if($controle==true){
                                                    //On modifie le mot de passe
                                                    modifierMDP($_SESSION['idMembre'], $nouveauPass, $bdd);
                                                    echo "<p2>Votre mot de passe à été modifié</p2>";
                                                  
                                                }
                                                else{
                                                    echo "<p1>Votre mot de passe est invalide</p1>";
                                                    
                                                }
                                            }
                                        break;
                                
                                    }
                                }
                            ?>
</div>


