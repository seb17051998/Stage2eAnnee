<div class="jumbotron">
    <h3>Différents modèles d'avions arrivent et partent de l'aéroport</h3>
    
    <?php
        $selection=$bdd->prepare("select * from avion");
        $selection->execute();
        ?>
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
</div>