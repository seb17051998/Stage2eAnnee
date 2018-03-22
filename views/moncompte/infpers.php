<div class="jumbotron">
    <h3>Mon compte</h3>
        <br/>
        <a href="index.php?page=moncompte?infpers" class="boutons">Informations personnelles</a>
        <a href="index.php?page=moncompte?emdp" class="boutons">Email et mot de passe</a>
        <a href="index.php?page=moncompte?rdv" class="boutons">Réservation et rendez-vous</a>
        <a href="index.php?page=moncompte?delete" class="boutons">Supprimer mon compte</a>
        <br/>
        <h3> Informations personnelles </h3>
        <br/>
        <?php
        /* On récupère les données de la variable de session et on fais une requete qui permet de préremplir les champs */
                    $req=$bdd->prepare("select * from groupe g inner join membre m on g.idGroupe=m.Groupe_idGroupe where idMembre=:idSESSION");
                    $req->execute(array(
                        ':idSESSION' => $_SESSION['idMembre'],
                    ));
                    while($recup=$req->fetch()){
                    ?>
                        </br>
                        
                            <form method="post" name="infident" action="index.php?page=moncompte?infpers">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th scope="row"><label>Votre ID :</label></th><td><?php echo $recup['idMembre']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label>Nom : </label></th><td><input type="text" name="nom" value="<?php echo $recup['nom']; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label>Prénom : </label></th><td><input type="text" name="prenom" value="<?php echo $recup['prenom']; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label>Numéro de téléphone : </label></th><td><input type="text" name="numtel" value="<?php echo $recup['numTel']; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label>Adresse : </label></th><td><input type="text" name="adresse" value="<?php echo $recup['adresse']; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label>Code postal : </label></th><td><input type="text" name="cp" value="<?php echo $recup['cp']; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label>Ville : </label></th><td><input type="text" name="ville" value="<?php echo $recup['ville']; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label>Type de compte : </label></th><td><?php echo $recup['libelle']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label>Date de naissance : </label></th><td><?php echo $recup['dateNaissance']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label>Inscrit depuis le : </label></th><td><?php echo $recup['date_inscription']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label></label></th><td><input type="submit" name="valider" value="Modifier"</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        <?php 
                            if(isset($_POST['valider'])){
                                $unChoix=$_POST['valider'];
                                $nom=$_POST['nom'];
                                $prenom=$_POST['prenom'];
                                $numTel=$_POST['numtel'];
                                $adresse=$_POST['adresse'];
                                $cp=$_POST['cp'];
                                $ville=$_POST['ville'];
                                switch($unChoix){
                                    case "Modifier" :
                                        if(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['numtel']) || empty($_POST['adresse']) || empty($_POST['cp']) || empty($_POST['ville'])){
                                            ?><p>Veuillez remplir tout les champs</p><?php
                                        }
                                        else{
                                            modifierMembreIP($recup['idMembre'], $nom, $prenom, $numTel, $adresse, $cp, $ville, $bdd);
                                            /* On met a jour les modifications dans les variables de sessions */
                                            
                                            $_SESSION['nom']=$nom;
                                            $_SESSION['prenom']=$prenom;
                                            $_SESSION['numTel']=$numTel;
                                            $_SESSION['adresse']=$adresse;
                                            $_SESSION['cp']=$cp;
                                            $_SESSION['ville']=$ville; ?>
                                            <META HTTP-EQUIV="Refresh" CONTENT="2; URL=index.php?page=moncompte?infpers"> <?php
                                            echo "<p>modification réussi</p>";
                                        } 
                                }
                            }
                    }?>
                    
</div>
