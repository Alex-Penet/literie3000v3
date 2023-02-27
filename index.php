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
    <div class="liens">
        <a href="formulaire.php">Ajouter un matelas</a>
        <a href="modifier.php">Modifier un matelas</a>
        <a href="supprimer.php">Supprimer un matelas</a>
    </div>

</div>

<?php
foreach ($matelas as $matela) {
?>
    <div class="catalogue">
        <div class="img cont-img">
            <img src="img/matelats/<?= $matela["image"] ?>" alt="">
        </div>

        <div class="name cont">
            <?= $matela["marque"] ?>
        </div>

        <div class="dimensions cont">
            <p><?= $matela["dimension"] ?></p>
        </div>

        <div class="prix cont-prix">
            <p class="nopromo"><?= $matela["prix"] ?>€</p>
            <p class="promo"><?= $matela["prix_promo"] ?>€</p>

        </div>

    </div>

<?php
}
?>
<div class="text">
    <h1>Vous y découvrirez toutes nos dimensions :</h1>
    <p>90 X 190, 140 X 190, 160 X 200, 180 X 200, 200 X 200</p>
    <h1>et toutes nos marques de matelats :</h1>
    <p>Epeda, Dreamway, Bultex, Dorsolinen MemoryLine</p>
</div>



</div>
</body>

</html>