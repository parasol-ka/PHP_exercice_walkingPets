<?php 
    include "_bd.php";
    $page = $_GET['page'];
    echo $page;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $walks = $_POST['walks'];
            $meals = $_POST['meals'];
            $comment = $_POST['comment'];}

    $sql_update = $bd->prepare("UPDATE pets SET pets.walks=:walks, pets.meals=:meals, pets.comment=:comment WHERE id_pet=:id;");
    $sql_update->bindvalue(":walks", $walks);
    $sql_update->bindvalue(":meals", $meals);
    $sql_update->bindvalue(":comment", $comment);
    $sql_update->bindvalue(":id", $page);
    $sql_update->execute();
    header("Location:index.php");
?>
