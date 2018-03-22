
<div class="jumbotron">    
    <table class="table table-striped">
        <tbody>

                <form method="post" name="inscription" action="index.php?page=inscription" >
            <tr>
                <th scope="row"><label>Nom d'utilisateur</label></th> 
                <td><input type="text" name="username" /></td>
            </tr>
            <tr>
                <th scope="row"><label>Mot de passe</label></th> 
                <td><input type="password" name="password"/></td>
            </tr>
            <tr>
                <th scope="row"><label>Nom</label></th>
                <td><input type="text" name="nom"/></td>
            </tr>
            <tr>
                <th scope="row"><label>Prénom</label></th>
                <td><input type="text" name="prenom"/></td>
            </tr>
            <tr>
                <td scope="row"><label>Email</label></th>
                <td><input type="email" name="email"/></td>
            </tr>
            <tr>
                <th scope="row"><label>Numéro de téléphone</label></th> 
                <td><input type="text" name="numtel"/></td>

            </tr>
            <tr>
                <th scope="row"><label>Adresse</label></th>
                <td><input type="text" name="adresse"/></td>

            </tr>
            <tr>
                <th scope="row"><label>Code postal</label></th>
                <td><input type="text" name="cp"/></td>
            </tr>
            <tr>
                <th scope="row"><label>Ville</label></th> 
                <td><input type="text" name="ville"/></td>

            </tr>
            <tr>
                <th scope="row"><label>Date de naissance</label></th>
                <td><input type="date" name="dateNaissance"/></td>
            </tr>
            <tr>
                <th scope="row">Valider l'inscription</th>
                <td><input type="submit" name="valider" onclick="verifNomUtilisateur()"/></td>
            </tr>
        </tbody>
                </form>
        </thead>        
    </table>

<?php



/*Inscription sur le site mot de passe cryptée en haschage*/
    if(isset($_POST['valider'])){
        $nomUtilisateur= $_POST["username"];
        $motPasse= $_POST["password"];
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $email=$_POST['email'];
        $tel=$_POST['numtel'];
        $adresse=$_POST['adresse'];
        $cp=$_POST['cp'];
        $ville=$_POST['ville'];
        $dateNaissance=$_POST['dateNaissance'];
        if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["nom"]) || empty($_POST["prenom"]) || 
                empty($_POST["email"]) || empty($_POST["numtel"]) || empty($_POST["adresse"]) || empty($_POST["cp"]) || empty($_POST["ville"])){
            echo "<p1>Veuillez remplir tout les champs</p1>";           
        }
        else{
            /* Contrôle de pseudonyme afin d'éviter les doublons */
            $req=$bdd->prepare("select nomUtilisateur from membre where nomUtilisateur=:nomUtilisateur");
            $req->execute(array(
               'nomUtilisateur' => $_POST['username']
            ));
            $controleUser=$req->fetch();
            if($controleUser==null){
            inscriptionMembre($nomUtilisateur, $motPasse, $nom, $prenom, $email, $tel, $adresse, $cp, $ville, $dateNaissance,$bdd);
        ?>  <META HTTP-EQUIV="Refresh" CONTENT="1; URL=index.php?page=inscriptionréussi">
        <?php
            }
            else{
                echo "<p1>Ce nom d'utilisateur est déja pris</p1>";
            }
        }
            
    
                        
        
        
    }
?>

</div>

