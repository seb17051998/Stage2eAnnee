<div class="jumbotron">
    <h3>Accueil</h3>
    <br/>
    <?php 
        if($_SESSION==null){
            
            echo "<h3>Bonjour, si vous souhaitez réserver votre baptème, vous pouvez maintenant vous inscrire en ligne</h3>";
        }
        else{
            ?>
                <h3>Bonjour <?php echo $_SESSION['nom'];?> <?php echo $_SESSION['prenom']; ?>
                </h3>
            <?php
        }
    ?>
    </br>
    <h4 style="color: red; font-style: bold;">L'aéroclub le plus proche de Paris</h4>
    <br/><br/>
    <img src="img/principalsite/ecusson.jpg" style="position:relative; float: left">
    <p style="font-size:18px;">Vous en rêviez depuis longtemps, peut-être depuis toujours, en franchissant le seuil de l'aéro-club de Moisselles,
    vous venez de faire un pas décisif vers la réalisation de ce rêve.
    Demain à Moisselles, vous découvrirez les émotions de la vie en trois dimensions,
    le bonheur de vivre passionnément le plus vieux fantasme de l'homme : Voler.
    Demain, à Moisselles vous ne serez plus spectateur, mais acteur,
    vous ne serez plus un simple terrien, mais vous partagerez le privilège d'une poignée d'hommes
    et de femmes : vous serez PILOTE.</p></img>
    <br/><br/>
    <h4 style="color:red; font-style:bold;">Un environnement idéal !</h4>
    <br/><br/>
    <p style="font-size:18px;">
        L'aérodrome d'Enghien-Moisselles est plus un champ d'aviation qu'un aérodrome. Sa situation géographique proche de Paris, son histoire, l'ambiance chaleureuse et familiale qui s'en dégage, font de cet aérodrome un site exceptionnel.
        Voici quelques bonnes raisons d'apprendre à piloter à Moisselles:
        C'est un lieu historique, créé en 1931, l'esprit de cette époque y est resté.
        Seuls les avions basés à Moisselles ont le droit d'y atterrir et d'en décoller. Pas d'attente interminable au point d'arrêt.
        la flotte est cohérente et variée.
        les prix sont compétitifs.
        Proche de Paris, il est à 30 mn de la place de l'étoile et à 20 km de la Porte de la chapelle.
        Un pilote instructeur permanent, est disponible pour vos rendez-vous tous les week-end et la semaine</p>
<br/><br/>
    <h4 style="color:red; font-style:bold;">Infos météos</h4><br/><br/>
    <script charset='UTF-8' src='http://www.meteofrance.com/mf3-rpc-portlet/rest/vignettepartenaire/954090/type/VILLE_FRANCE/size/PAYSAGE_VIGNETTE' type='text/javascript'></script>
<br/><br/><br/>
<img src="img/av1.jpg"/><img src="img/av2.jpg"/><img src="img/av3.jpg"/>
<img src="img/av4.jpg"/><img src="img/av5.jpg"/><img src="img/av6.jpg"/>
<img src="img/av7.jpg"/><img src="img/av8.jpg"/><img src="img/av9.jpg"/>







</div>