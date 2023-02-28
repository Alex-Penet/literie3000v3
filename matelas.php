<?php
    $dsn = "mysql:host=localhost;dbname=literie3000";
    $db = new PDO($dsn, "root", "");
    $query = $db->prepare("SELECT * FROM matelas where id = :id");
    $query->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
    $query->execute();
    $matelas = $query->fetch();


if (isset($_GET["id"]) == $matelas["id"]) {
    $dsn = "mysql:host=localhost;dbname=literie3000";
    $db = new PDO($dsn, "root", "");
    $query = $db->prepare("SELECT * FROM matelas where id = :id");
    $query->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
    $query->execute();
    $matelas = $query->fetch();
    include("templates/header.php")
?>
    <div class="matelas">
        <div class="matelas_img">
            <img src="img/matelats/<?= $matelas["image"] ?>" alt="">
        </div>
        <div class="matelas_informations">
            <div class="matelas_informations-marque">
                <div class="cont">
                    <h1><?= $matelas["marque"] ?></h1>
                </div>

            </div>
            <div class="matelas_informations-dimension">
                <div class="cont">
                    <h2>Dimension : </h2>
                    <h2> <?= $matelas["dimension"] ?> cm</h2>
                </div>

            </div>
            <div class="matelas_informations-prix">
                <div class="cont">
                    <h2>Prix : </h2>
                    <h2><?= $matelas["prix"] ?>€</h2>
                </div>
                <div class="cont">
                    <h2>Prix en Promo : </h2>
                    <h2><?= $matelas["prix_promo"] ?>€</h2>
                </div>

            </div>

        </div>
    </div>

    <div class="modifier">
        <form action="" method="post" enctype="multipart/form-data">

        </form>
    </div>
<?php

}else{
    header("location:errors.php");
} 
?>



</div>
</body>

</html>