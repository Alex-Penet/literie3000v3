<?php
$dsn = "mysql:host=localhost;dbname=literie3000";
$db = new PDO($dsn, "root", "");


$query = $db->query("SELECT * FROM matelas");
$matelas = $query->fetchAll(PDO::FETCH_ASSOC);

// var_dump($matelas);

include("templates/header.php")
?>
<div class="titre">
    <h1>Catalogue</h1>
    <a href="formulaire.php">Ajouter un matelas</a>
</div>

<?php
foreach ($matelas as $matela) {
?>
    <div class="catalogue">
        <div class="img cont">
            <img src="img/matelats/<?= $matela["image"] ?>" alt="">
        </div>

        <div class="name cont">
            <?= $matela["marque"] ?>
        </div>

        <div class="dimensions cont">
            <p><?= $matela["dimension"]?></p>
        </div>

        <div class="prix cont">
            <p class="nopromo"><?= $matela["prix"]?></p>
            <p><?= $matela["prix_promo"]?></p>

        </div>

    </div>

<?php
}
?>


</div>
</body>

</html>