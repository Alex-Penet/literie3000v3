<?php

$dsn = "mysql:host=localhost;dbname=literie3000";
$db = new PDO($dsn, "root", "");
$query = $db->prepare("SELECT * FROM matelas where id = :id");
$query->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
$query->execute();
$matelas = $query->fetch();
header("location:matelas.php?id=".$matelas["id"]);

if (isset($_GET["id"]) == $matelas["id"]) {

} else {
    header("location:errors.php");
}
