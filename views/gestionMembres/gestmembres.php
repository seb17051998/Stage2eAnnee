<div class="jumbotron">
<?php 
/* Restriction des membres non administrateurs */
if($_SESSION['groupe']!=1){
    echo "<h3>Désolé mais vous n'avez pas l'autorisation d'accéder à cette page</h3>";
}
else{
    
    
    ?>
        <a href="index.php?page=menumembres?listmembres" class="boutons">Liste des membres</a>
        <a href="index.php?page=menumembres?gestmembres" class="boutons">Gestion des membres</a>
        <h3>Gérer les utilisateurs </h3>
        <h4>Attention, le mot de passe attribué sera "moisselles-avions" si vous attribuez un mot de passe</h4>
        <br/>
        <table class="table table-striped">
            <tbody>
                
                <form method="post" name="gererMembre" action="index.php?page=menumembres?gestmembres">
                    <tr>
                    <th scope="row"><label>Numéro du membre</label></th><td>
                        <?php
                        
                            $req=$bdd->prepare("select * from groupe g inner join membre m on g.idGroupe=m.Groupe_idGroupe");
                            $req->execute();?>
                        
                        <select name="idMembre" id="idMembre" onChange='form.submit();'>
                        <?php ?>    
                            <option value=""></option>  
                            <?php
                            while($resultat=$req->fetch()){
                            ?>
                            <option value="<?php echo $resultat['idMembre']; ?>"><?php echo $resultat['idMembre'];
                                    echo " ";
                                    echo $resultat['nom'];
                                    echo " ";
                            echo $resultat['prenom'];?></option> <?php } ?>
                            </select>
                    </td>
                    </tr>
                    <?php
                    if($_POST!=null){
                        $req=$bdd->prepare("select * from groupe g inner join membre m on g.idGroupe=m.Groupe_idGroupe where m.idMembre=:idMembre");
                        $req->execute(array(
                            'idMembre' => $_POST['idMembre']
                        ));
                        while($recupMembre=$req->fetch()){?>
                    <tr>
                        <th scope="row"><label>Numéro sélectionnée</label></th><td><input type="text" name="id" value="<?php echo $recupMembre['idMembre'];?>"/></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Nom d'utilisateur</label></th><td><input type="text" name="nomUtilisateur" value="<?php echo $recupMembre['nomUtilisateur']?>"/></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Nom</label></th><td><input type="text" name="nom" value="<?php echo $recupMembre['nom'];?>"/></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Prénom</label></th><td><input type="text" name="prenom" value="<?php echo $recupMembre['prenom'];?>"/></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Email</label></th><td><input type="email" name="email" value="<?php echo $recupMembre['email'];?>"/></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Numéro de téléphone</label></th><td><input type="text" name="numTel" value="<?php echo $recupMembre['numTel'];?>"/></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Adresse</label></th><td><input type='text' name='adresse' value="<?php echo $recupMembre['adresse'];?>"/></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Code postal</label></th><td><input type="text" name="cp" value="<?php echo $recupMembre['cp'];?>"/></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Ville</label></th><td><input type="text" name="ville" value="<?php echo $recupMembre['ville'];?>"/></td>
                    </tr>
                    <tr> 
                        <th scope="row"><label>Changer de groupe</label></th><td><?php echo $recupMembre['libelle'];?></td>
                    </tr>
                    <tr>
                        <?php
                        $recupGroupe=$bdd->prepare("select * from groupe");
                        $recupGroupe->execute();
                        
                        /* Condition afin d'éviter que l'administrateur principal du site s'autobanni */
                        if($_POST['idMembre']==1){
                            
                        }
                        else{
                            ?>
                            <th scope="row"><label>Groupe</label></th><td>
                            <select name="groupe" id="groupe">
                            <?php
                                while($resultatG=$recupGroupe->fetch()){
                                    ?>
                                    <option value="<?php echo $resultatG['idGroupe'];?>"><?php echo $resultatG['libelle'];?></option>
                                    <?php
                                }
                        
                            ?>
                            </select></td>
                           <?php } ?>
                    </tr>
                    <tr>
                        <th scope="row"><label>Date de naissance</label></th><td><input type="text" name="dateNaissance" value="<?php echo $recupMembre['dateNaissance'];?>"/></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Date d'inscription</label></th><td><?php echo $recupMembre['date_inscription'];?></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Administration</label></th><td><input type="submit" name="valider" value="Modifier"/>
                        <?php
                        if($_POST['idMembre']!=1){
                            ?>
                            <input type="submit" name="valider" value="Supprimer"/>
                            <input type="submit" name="valider" value="Attribuer un mot de passe"</td>
                            </tr>
               <?php    }
               
                        /* Empêcher la suppression du compte de l'administrateur principal */
                        else{
                            ?>
                            <input type="submit" name="valider" value="Attribuer un mot de passe"</td>
                                    <?php
                        }
                            
                    }   
                    }
                if(isset($_POST['valider'])){
                    $choix = $_POST['valider'];
                    $id=$_POST['id'];
                    $nomUtilisateur=$_POST['nomUtilisateur'];
                    $nom=$_POST['nom'];
                    $prenom=$_POST['prenom'];
                    $email=$_POST['email'];
                    $numTel= $_POST['numTel'];
                    $adresse=$_POST['adresse'];
                    $cp=$_POST['cp']; 
                    $ville=$_POST['ville']; 
                    $Groupe_idGroupe=$_POST['groupe']; 
                    $dateNaissance=$_POST['dateNaissance'];
                    switch($choix){
                        case "Modifier":
                            ModifierMembre($id, $nomUtilisateur, $nom, $prenom, $email, $numTel, $adresse, $cp, $ville, $Groupe_idGroupe, $dateNaissance, $bdd);
                            ?><META HTTP-EQUIV="Refresh" CONTENT="2; URL=index.php?page=menumembres?gestmembres"><?php
                        break;
                        case "Supprimer":
                            supprimerMembreAdmin($id, $bdd);?>
                            <META HTTP-EQUIV="Refresh" CONTENT="2; URL=index.php?page=menumembres?gestmembres"><?php
                        break;
                        case "Attribuer un mot de passe":
                            $password="moisselles-avion"; //A modifier si vous voulez changer le mot de passe temporaire
                            //Hachage du mot de passe
                            $pass_hashed= password_hash($password, PASSWORD_DEFAULT);
                            attribuerUnMDP($id, $pass_hashed, $bdd);
                            break;
                    }
                }   
?>
                </form>
                </tr>
            </tbody>
        </table>
        
        <?php
                        
        $req=$bdd->prepare("select * from membre m inner join groupe g on m.Groupe_idGroupe=g.idGroupe");
        $req->execute();
        
        ?>

        <br/>
        <h3>Liste des membres</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom d'utilisateur</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Téléphone</th>
                    
                    <!--Dont l'adresse, le code postal et la ville -->
                    <th scope="col">Adresse complète</th> 
                    <th scope="col">Groupe</th>
                    <th scope="col">Date de naissance</th>
                    <th scope="col">Date d'inscription</th>          
                </tr>
            </thead>
            <?php
            while($colonne=$req->fetch()){
                    ?>
            <tbody>
                <th scope="row"><?php echo $colonne['idMembre']; ?></th>
                <td><?php echo $colonne['nomUtilisateur'];?></td>
                <td><?php echo $colonne['nom'];?></td>
                <td><?php echo $colonne['prenom'];?></td>
                <td><?php echo $colonne['email'];?></td>
                <td><?php echo $colonne['numTel'];?></td>
                <td><?php echo $colonne['adresse'];
                    echo " ";
                    echo $colonne['cp'];
                    echo " ";
                    echo $colonne['ville'];?></td>
                <td><?php echo $colonne['libelle'];?></td>
                <td><?php echo $colonne['dateNaissance'];?></td>
                <td><?php echo $colonne['date_inscription'];?></td>
              
            </tbody>
        <?php } ?>
        </table>
    <?php
}
?>
</div>