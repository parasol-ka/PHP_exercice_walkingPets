<?php 
    $reqNoms = $bd->prepare("SELECT name FROM categories");
    $reqNoms->execute();
?>
<header>
    <h1>Walking Pets</h1>
    <p>- <?php 
        while ( $animal_nom=$reqNoms->fetch() ) {
        echo $animal_nom["name"], " - ";}
        ?><br>
    L'équipe de <b>Walking Pets</b> s'occupe de vos animaux de compagnie.<br>
    Au menu : plusieurs promenades et repas par jour.</p>
</header>