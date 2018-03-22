<div class="jumbotron">
    <?php if($_SESSION==null || $_SESSION['groupe']!=1){
        ?>
        <h3>Désolé mais vous n'avez pas l'autorisation d'accéder à cette page</h3>
        <?php
    }
    else{ 
        $req=$bdd->prepare("select * from membre m inner join groupe g on m.Groupe_idGroupe=g.idGroupe");
        $req->execute();
        ?>
        <a href="index.php?page=menumembres?listmembres" class="boutons">Liste des membres</a>
        <a href="index.php?page=menumembres?gestmembres" class="boutons">Gestion des membres</a>
        <br/>
        <h3>Gestion des membres</h3>
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
        
        
            <?php   } ?>
</div>

