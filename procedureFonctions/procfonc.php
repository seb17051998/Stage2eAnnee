<?php
    
    function connexionMySQLBDD($hote,$bd,$util,$password){
        $phote=$hote;
        $pbd=$bd;
        $putil=$util;
        $ppassword=$password;
        try{
            $bdd=new PDO('mysql:host='.$phote.';dbname='.$pbd,$putil,$ppassword);
            
        } 
        catch (Exception $ex) {
            echo $ex;
        }
        return $bdd;
    }
    function inscriptionMembre($nomUtilisateur,$motPasse,$nom,$prenom,$email,$numTel,$adresse,$cp,$ville,$date,$bdd){
        //Hachage du mot de passe
        $pass_hashed= password_hash($motPasse, PASSWORD_DEFAULT);
        
        //insertion d'un membre par défaut
        $req=$bdd->prepare('insert into membre (nomUtilisateur,motPasse,nom,prenom,email,numTel,adresse,cp,ville,Groupe_idGroupe,dateNaissance,date_inscription) values (:nomUtilisateur,:motPasse,:nom,:prenom,:email,:numTel,:adresse,:cp,:ville,2,:dateNaissance,NOW())');
        $req->execute(array(
            'nomUtilisateur' => $nomUtilisateur,
            'motPasse' => $pass_hashed,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'numTel' => $numTel,
            'adresse' => $adresse,
            'cp' => $cp,
            'ville' => $ville,
            'dateNaissance' => $date
                
        ));
    }
    
    function AjoutAvionAVCphoto($constructeur,$modele,$unType,$nbplaces,$unUsage,$moteur,$performances,$autonomie,$avionique,$photo,$bdd){
        $req=$bdd->prepare('insert into avion (constructeur,modele,unType,nbplaces,unUsage,moteur,performances,autonomie,avionique,photo)
                values (:constructeur,:modele,:unType,:nbplaces,:unUsage,:moteur,:performances,:autonomie,:avionique,:photo)');
        $req->execute(array(
            'constructeur' => $constructeur,
            'modele' => $modele,
            'unType' => $unType,
            'nbplaces' => $nbplaces,
            'unUsage' => $unUsage,
            'moteur' => $moteur,
            'performances' => $performances,
            'autonomie' => $autonomie,
            'avionique' => $avionique,
            'photo' => $photo
        ));
        if($req==false){
            $err= print_r($bdd->errorInfo());
            die('erreur !');
            return $err;
        }
    }
    
    function AjoutAvionSSphoto($constructeur,$modele,$unType,$nbplaces,$unUsage,$moteur,$performances,$autonomie,$avionique,$bdd){
        
        $req=$bdd->prepare('insert into avion (constructeur,modele,unType,nbplaces,unUsage,moteur,performances,autonomie,avionique)
                values (:constructeur,:modele,:unType,:nbplaces,:unUsage,:moteur,:performances,:autonomie,:avionique)');
        $req->execute(array(
            'constructeur' => $constructeur,
            'modele' => $modele,
            'unType' => $unType,
            'nbplaces' => $nbplaces,
            'unUsage' => $unUsage,
            'moteur' => $moteur,
            'performances' => $performances,
            'autonomie' => $autonomie,
            'avionique' => $avionique,
        ));
    }
    
    function ModifierAvionAVCphoto($idAvion,$constructeur,$modele,$unType,$nbplaces,$unUsage,$moteur,$performances,$autonomie,$avionique,$photo,$bdd){
        $req=$bdd->prepare('update avion set constructeur=:constructeur, modele=:modele, unType=:unType, nbplaces=:nbplaces, unUsage=:unUsage,moteur=:moteur,performances=:performances,autonomie=:autonomie,avionique=:avionique,photo=:photo where idAvion=:idAvion');
        $req->execute(array(
            'idAvion' => $idAvion,
            'constructeur' => $constructeur,
            'modele' => $modele,
            'unType' => $unType,
            'nbplaces' => $nbplaces,
            'unUsage' => $unUsage,
            'moteur' => $moteur,
            'performances' => $performances,
            'autonomie' => $autonomie,
            'avionique' => $avionique,
            'photo' => $photo
        ));
        
    }
    
    function ModifierAvionSSphoto($idAvion,$constructeur,$modele,$unType,$nbplaces,$unUsage,$moteur,$performances,$autonomie,$avionique,$bdd){
        $req=$bdd->prepare('update avion set constructeur=:constructeur, modele=:modele, unType=:unType, nbplaces=:nbplaces, unUsage=:unUsage,moteur=:moteur,performances=:performances,autonomie=:autonomie,avionique=:avionique where idAvion=:idAvion');
        $req->execute(array(
            'idAvion' => $idAvion,
            'constructeur' => $constructeur,
            'modele' => $modele,
            'unType' => $unType,
            'nbplaces' => $nbplaces,
            'unUsage' => $unUsage,
            'moteur' => $moteur,
            'performances' => $performances,
            'autonomie' => $autonomie,
            'avionique' => $avionique
        ));
    }
    
    function SupprimerAvion($idAvion,$bdd){
        $req=$bdd->prepare('delete from avion where idAvion=:idAvion');
        $req->execute(array(
            'idAvion' => $idAvion
        ));
        ?><META HTTP-EQUIV="Refresh" CONTENT="1; URL=index.php?page=gestavion"><?php
    }
    
    function modifierMembreIP($idMembre,$nom,$prenom,$numTel,$adresse,$cp,$ville,$bdd){
        global $bdd;
        $req=$bdd->prepare('update membre set nom=:nom, prenom=:prenom, numTel=:numTel, adresse=:adresse, cp=:cp, ville=:ville where idMembre=:idMembre');
        $req->execute(array(
            'idMembre' => $idMembre,
            'nom' => $nom,
            'prenom' => $prenom,
            'numTel' => $numTel,
            'adresse' => $adresse,
            'cp' => $cp,
            'ville' => $ville
             


            ));

        if($req==false){
            $err= print_r($bdd->errorInfo());
            die('erreur !');
            
            return $err;
        }
    }
    
    function modifierMail($id,$nouveauMail,$bdd){
        $req=$bdd->prepare('update membre set email=:email where idMembre=:idSession');
        $req->execute(array(
            'idSession' => $id,
            'email' => $nouveauMail
        ));
    }
    
    function modifierMDP($id,$nouveauPass,$bdd){
        $req=$bdd->prepare('update membre set motPasse=:motPasse where idMembre=:idSession');
        $pass_hasched=password_hash($nouveauPass,PASSWORD_DEFAULT);
        $req->execute(array(
            'idSession' => $id,
            'motPasse' => $pass_hasched
        ));
    }
    
    function supprimerMembre($id,$bdd){
        $req=$bdd->prepare('delete from membre where idMembre=:idSession');
        $req->execute(array(
            'idSession' => $id
        ));
    }
    
    function ModifierMembre($id,$nomUtilisateur,$nom,$prenom,$email,$numTel,$adresse,$cp,$ville,$Groupe_idGroupe,$dateNaissance,$bdd){
        $req=$bdd->prepare('update membre set nomUtilisateur=:nomUtilisateur, nom=:nom, prenom=:prenom, email=:email, numTel=:numTel, adresse=:adresse, cp=:cp, ville=:ville, Groupe_idGroupe=:Groupe_idGroupe, dateNaissance=:dateNaissance where idMembre=:idMembre');
        $req->execute(array(
            'idMembre' => $id,
            'nomUtilisateur' => $nomUtilisateur,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'numTel' => $numTel,
            'adresse' => $adresse,
            'cp' => $cp,
            'ville' => $ville,
            'Groupe_idGroupe' => $Groupe_idGroupe,
            'dateNaissance' => $dateNaissance
        ));
    }
    
    function supprimerMembreAdmin($id,$bdd){
        $req=$bdd->prepare('delete from membre where idMembre=:id');
        $req->execute(array(
            'id' => $id
        ));
    }

    function attribuerUnMDP($id,$nouveauPass,$bdd){
        $req=$bdd->prepare('update membre set motPasse=:motPasse where idMembre=:id');
        $req->execute(array(
            'id' => $id,
            'motPasse' => $nouveauPass
        ));
    }
    
    function autoinscriptionAdmin($nomUtilisateur,$motPasse,$nom,$prenom,$email,$numTel,$adresse,$cp,$ville,$date,$bdd){
        //Hachage du mot de passe
        $pass_hashed= password_hash($motPasse, PASSWORD_DEFAULT);
        
        //insertion d'un membre par défaut
        $req=$bdd->prepare('insert into membre (nomUtilisateur,motPasse,nom,prenom,email,numTel,adresse,cp,ville,Groupe_idGroupe,dateNaissance,date_inscription) values (:nomUtilisateur,:motPasse,:nom,:prenom,:email,:numTel,:adresse,:cp,:ville,1,:dateNaissance,NOW())');
        $req->execute(array(
            'nomUtilisateur' => $nomUtilisateur,
            'motPasse' => $pass_hashed,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'numTel' => $numTel,
            'adresse' => $adresse,
            'cp' => $cp,
            'ville' => $ville,
            'dateNaissance' => $date
                
        ));
    }
?>

