<?php
    include "_bd.php";
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        echo "L'ID de l'animal est : " . htmlspecialchars($page);
    } else {
        echo "pas bon ID";}
    $reqPet = $bd->prepare("SELECT * FROM pets WHERE id_pet=:val");
    $reqPet->bindvalue(':val',$page);
    $reqPet->execute();
    $count = $reqPet->rowCount();
    if ($count>0) {
        $pet_info = $reqPet->fetch();
    }else {header("Location: index.php");}
    
    session_start();
    $_SESSION['pets'][$page] = true;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Walking Pets Update</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "_header.php"; ?>
    <section id="update_form_box">
        <img src="/icons/leash.png" alt="leash" id="form_img">
        <h2><?php echo $pet_info["name"]?></h2>
        <form action="<?php echo "update.php?page=".$page; ?>" method="post" id="update_form">
            <div class="form_element">
                <label for="walks">walks :</label>
                <input type="number" min="0" value="<?php if (isset($pet_info['walks'])) {echo $pet_info['walks'];}else { echo "0";} ?>" id="walks" name="walks" required>
            </div>
            <div class="form_element">
                <label for="meals">meals :</label>
                <input type="number" min="0" value="<?php if (isset($pet_info['meals'])) {echo $pet_info['meals'];}else { echo "0";} ?>" id="meals" name="meals" required>
            </div>
            <div class="form_element">
                <label for="comment">comment :</label>
                <textarea cols="50" rows="4" id="comment" name="comment"><?php echo $pet_info['comment'] ?></textarea>
            </div>
            <button type="submit">Enregistrer</button>
        </form>
    </section>    
</body>
</html>