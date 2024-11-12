<?php 
    include "_bd.php"; 
    $reqInfo = $bd->prepare("SELECT pets.id_pet, categories.icon, pets.name AS name_pet, pets.walks, pets.meals, pets.comment, categories.max_walks, categories.name FROM categories RIGHT JOIN pets ON categories.id_cat = pets.id_cat;");
    $reqInfo->execute();
    session_start();
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Walking Pets</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "_header.php"; ?>
    <div id="animaux_affichage">
        
        <?php 
            while ( $animal_info=$reqInfo->fetch() ) {
                echo "<a id='animal' href='modif_pet.php?page=" . $animal_info["id_pet"] . "'>";
                    if (!empty($animal_info["icon"])) {
                    echo "<figure><img src='icons/" . $animal_info["icon"] . "' alt='Animal Icon'></figure>";
                    } else {echo "<figure><img src='icons/unknown.png' alt='Animal Icon'></figure>";}

                    if (isset($_SESSION['pets'][$animal_info['id_pet']])) { $visited_pet="class='recent_modif'";}else { $visited_pet="";} 

                    echo "<div id='animal_description' $visited_pet";
                        echo "<p>", $animal_info["name_pet"], "</p>";
                        
                        if (($animal_info["walks"] > $animal_info["max_walks"]) and (!empty($animal_info["max_walks"]))) {
                            echo "<p>walks: <s>", $animal_info["walks"]," </s> ", $animal_info["max_walks"], "</p>";
                        } else { echo "<p>walks: ", $animal_info["walks"], "</p>";}

                        echo "<p>meals: ", $animal_info["meals"], "</p>";
                        if (!empty($animal_info["comment"])) {
                            echo "<p title='" . $animal_info["comment"] . "'> - remarque -</p>";}
                    echo "</div>";
                echo "</a>";
            }?>
    </div>
</body>
</html>