<div class="jumbotron">
    <?php if($_SESSION==null || $_SESSION['groupe']!=1){
        ?>
        <h3>Désolé mais vous n'avez pas l'autorisation d'accéder à cette page</h3>
        <?php
    }
    else{?>
    <h3>Gestion des avions dans notre aérodrome</h3>
    
    <!-- Ajout d'un nouvel Avion -->
    <table class="table table-striped">    
        <form method="post" name="ajouterAvion" action="index.php?page=gestavion" enctype="multipart/form-data">
            <thead>         
                <tr>
                    <th scope="col" colspan="2" align="center"><h4 style="color:red; text-align: center;">Ajouter un nouvel avion</th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><label>Constructeur :*</label></th><td><input type="text" name="constructeur"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Modèle :*</label></th><td><input type="text" name="modele"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Type :</label></th><td><input type="text" name="unType"/></td>
                </tr>
                <tr>
                    <th scope="row"><label for="nbplaces">Nombre de places :</label></th><td><select name="nbplaces" id="nbplaces">
                        <option value="2">2 places</option>
                        <option value="3">3 places</option>
                        <option value="4">4 places</option>
                        <option value="5">5 places</option>
                        <option value="6">6 places</option>
                        </select></td><br/>
                </tr>
                <tr>
                    <th scope="row"><label>Utilisation :*</label></th><td><input type="text" name="unUsage"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Moteur :*</label></th><td><input type="textarea" name="moteur"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Performance :*</label></th><td><input type="text" name="performance"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Autonomie :*</label></th><td><input type="text" name="autonomie"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Avionique :*</label></th><td><textarea name="Avionique" id="Avionique" rows="5" cols="30"></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label>Image (JPG-GIF-PNG) Max 5Mo :</label></th><td><input type="file" name="photo" />
                    <input type="hidden" name="MAX_FILE_SIZE" value="5120" /></td>
                </tr>
                <tr>
                    <th scope="row"></th><td><input type="submit" name="valider" value="Ajouter"/></td>
                </tr>
            </tbody>
        </form>
        
       
    </table>
            <br/>    
        <br/>
    <?php
       
        
    ?>
    <!-- Modification et suppression des avions  -->
    <table class='table table-striped'>
        <form method="post" name="modifierAvion" action="index.php?page=gestavion" enctype="multipart/form-data">
            <thead>
                <tr>
                    <th scope="col" colspan="2" align="center"><h4 style="color:red; text-align: center;">Modifier/Supprimer un avion</h4><br/><h5 style="color:green; text-align: center;">Pour la suppression, le numéro suffit</h5></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><label>Numéro :</label></th><td><input type="text" name="idAvion" /></td>
                </tr>
                <tr>
                    <th scope="row"><label>Constructeur :</label></th><td><input type="text" name="constructeur"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Modèle :</label></th><td><input type="text" name="modele"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Type :</label></th><td><input type="text" name="unType"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Nombre de places :</label></th><td>
                        <select name="nbplaces" id="nbplaces">
                        <option value="2">2 places</option>
                        <option value="3">3 places</option>
                        <option value="4">4 places</option>
                        <option value="5">5 places</option>
                        <option value="6">6 places</option>
                        </select></td>
                </tr>
                <tr>
                    <th scope="row"><label>Utilisation :</label></th><td><input type="text" name="unUsage"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Moteur :</label></th><td><input type="text" name="moteur"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Performance :</label></th><td><input type="text" name="performance"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Autonomie :</label></th><td><input type="text" name="autonomie"/></td>
                </tr>
                <tr>
                    <th scope="row"><label>Avionique :</label></th><td><textarea name="Avionique" id="Avionique" rows="5" cols="30"></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label>Image (JPG-GIF-PNG) Max 5Mo :</label></th><td><input type="file" name="photo" />
                    <input type="hidden" name="MAX_FILE_SIZE" value="5120" /></td>
                </tr>
                <tr>
                    <th scope="row"><label></label></th>
                    <td>
                        <input type="submit" name="valider" value="Modifier"/>
                        <input type="submit" name="valider" value="Supprimer"/>
                    </td>
                </tr>
            </tbody>
        </form>
    </table>

    <?php 
        if(isset($_POST['valider'])){
            $choix = $_POST['valider'];
            switch($choix){
                case "Ajouter":
                    if(empty($_POST['constructeur']) || empty($_POST['modele']) || empty($_POST['unType']) || empty($_POST['unUsage']) || empty($_POST['moteur'])
                        || empty($_POST['performance']) || empty($_POST['Avionique'])){
                        echo "<p1>Veuillez remplir tout les champs suivi d'un *</p1>";
                     
                    }
                    else{
                        $constructeur=$_POST['constructeur'];
                        $modele=$_POST['modele'];
                        $unType=$_POST['unType'];
                        $nbplaces=$_POST['nbplaces'];
                        $unUsage=$_POST['unUsage'];
                        $moteur=$_POST['moteur'];
                        $performances=$_POST['performance'];
                        $autonomie=$_POST['autonomie'];
                        $avionique=$_POST['Avionique'];
                        if(isset($_FILES['photo'])){
                            $chemin= "img/avions/";
                            $fichier= basename($_FILES['photo']['name']);
                            if(move_uploaded_file($_FILES['photo']['tmp_name'], $chemin . $fichier)){
                                echo $fichier;

                                AjoutAvionAVCphoto($constructeur, $modele, $unType, $nbplaces, $unUsage, $moteur, $performances, $autonomie, $avionique, $fichier, $bdd);


                            }
                            else{        
                                AjoutAvionSSphoto($constructeur, $modele, $unType, $nbplaces, $unUsage, $moteur, $performances, $autonomie, $avionique, $bdd);
                            }

                        }
                    }
                     ?>   
                    <META HTTP-EQUIV="Refresh" CONTENT="1; URL=index.php?page=gestavion"><?php
                    break;
                case "Modifier" :
                    $idAvion=$_POST['idAvion'];
                    $constructeur=$_POST['constructeur'];
                    $modele=$_POST['modele'];
                    $unType=$_POST['unType'];
                    $nbplaces=$_POST['nbplaces'];
                    $unUsage=$_POST['unUsage'];
                    $moteur=$_POST['moteur'];
                    $performances=$_POST['performance'];
                    $autonomie=$_POST['autonomie'];
                    $avionique=$_POST['Avionique'];
                    if(isset($_FILES['photo'])){
                        $chemin= "img/avions/";
                        $fichier= basename($_FILES['photo']['name']);
                        if(move_uploaded_file($_FILES['photo']['tmp_name'], $chemin . $fichier)){
                            echo $fichier;
                            ModifierAvionAVCphoto($idAvion, $constructeur, $modele, $unType, $nbplaces, $unUsage, $moteur, $performances, $autonomie, $avionique, $fichier, $bdd);
                            


                        }
                        else{        
                            ModifierAvionSSphoto($idAvion, $constructeur, $modele, $unType, $nbplaces, $unUsage, $moteur, $performances, $autonomie, $avionique, $bdd);
                        }

                    }
                    ?><META HTTP-EQUIV="Refresh" CONTENT="1; URL=index.php?page=gestavion"><?php
                    break;
                case "Supprimer" :
                    $idAvion=$_POST['idAvion'];
                    SupprimerAvion($idAvion, $bdd);
                    break;
            }
        }
    ?>
    <?php
        $selection=$bdd->prepare("select * from avion");
        $selection->execute();
        ?>
        <center><h3>Liste des avions</h3></center>
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Constructeur</th>
                        <th scope="col">Modèle</th>
                        <th scope="col">Type</th>
                        <th scope="col">Nombre de places</th>
                        <th scope="col">Utilisation</th>
                        <th scope="col">Moteur</th>
                        <th scope="col">Performances</th>
                        <th scope="col">Autonomie</th>
                        <th scope="col">Avionique</th>
                        <th scope="col">Image</th>

                    </tr>
                </thead>
        <?php
        while($colonne=$selection->fetch()){
            ?>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $colonne['idAvion']; ?></th>
                    <td><?php echo $colonne['constructeur']; ?></td>
                    <td><?php echo $colonne['modele']; ?></td>
                    <td><?php echo $colonne['unType']; ?></td>
                    <td><?php echo $colonne['nbplaces']; ?></td>
                    <td><?php echo $colonne['unUsage']; ?></td>
                    <td><?php echo $colonne['moteur']; ?></td>
                    <td><?php echo $colonne['performances']; ?></td>
                    <td><?php echo $colonne['autonomie']; ?></td>
                    <td><?php echo $colonne['avionique']; ?></td>
                    <td><img style="width:150px; height:150px;" src="img\avions\<?php echo $colonne['photo'];?>""</td>
                    
                </tr>
                    
            
            
 <?php  }
 ?>             </tbody>
                </table>
    <?php } ?>
</div>
