<?php


if (!empty($_POST)) {

    $name = trim(strip_tags($_POST["name"]));
    $dimension = trim(strip_tags($_POST["dimension"]));
    $prix = trim(strip_tags($_POST["prix"]));
    $prix_promo = trim(strip_tags($_POST["prix_promo"]));


    var_dump($dimension);



    $errors = [];

    if (empty($name)) {
        $errors["name"] = "le nom du matelat est obligatoire";
    }


    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES["image"]["tmp_name"];
        $fileName = $_FILES["image"]["name"];
        $fileType = $_FILES["image"]["type"];

        $fileNameArray = explode(".", $fileName);
        $fileExtension = end($fileNameArray);

        $newFileName = md5($fileName . time()) . "." . $fileExtension;

        $fileDestPath = "./img/matelats/{$newFileName}";
        $allowedTypes = array("image/jpeg", "image/png", "image/webp");

        if (in_array($fileType, $allowedTypes)) {
            move_uploaded_file($fileTmpPath, $fileDestPath);
        } else {
            $errors["image"] = "le type de fichier est incorrect (.jpg, .png, .webp requis)";
        }
    }



    if ($prix < 0) {
        $errors["prix"] = "le prix ne peut être inférieur à 0";
    }

    if ($prix_promo < 0) {
        $errors["prix_Promo"] = "le prix Promo ne peut être inférieur à 0";
    }



    if (empty($errors)) {

        $dsn = "mysql:host=localhost;dbname=literie3000";
        $db = new PDO($dsn, "root", "");

        $query = $db->prepare("INSERT INTO matelas (marque,  image, dimension, prix, prix_promo) VALUES (:name,:image, :dimension, :prix, :prix_promo)");

        $query->bindparam(":name", $name);
        // $query->bindparam(":description", $description);
        $query->bindparam(":image", $newFileName);
        $query->bindparam(":dimension", $dimension);
        $query->bindparam(":prix", $prix, PDO::PARAM_INT);
        $query->bindparam(":prix_promo", $prix_promo, PDO::PARAM_INT);


        if ($query->execute()) {
            header("location:index.php");
        }
    }
}

include("templates/header.php");

$dsn = "mysql:host=localhost;dbname=literie3000";
$db = new PDO($dsn, "root", "");

$query = $db->prepare("SELECT * FROM matelas WHERE id = :id");

$query->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
?>

<body>
    <form action="" method="post" enctype="multipart/form-data" class="form">
        <div class=" cont">
            <div class="form-group">
                <label for="inputname">Nom du matelas :</label>
                <input type="text" id="inputname" name="name" value="<?= isset($name) ? $name : "" ?>">

                <?php
                if (isset($errors["name"])) {
                ?>
                    <span class="info-error">
                        <?= $errors["name"] ?>
                    </span>
                <?php
                }
                ?>
            </div>
        </div>

        <div class=" cont">
            <div class="form-group">
                <label for="inputpicture">Photo du matelas :</label>
                <input type="file" id="inputpicture" name="image">

                <?php
                if (isset($errors["image"])) {
                ?>
                    <span class="info-error">
                        <?= $errors["image"] ?>
                    </span>
                <?php
                }
                ?>
            </div>

        </div>

        <!-- <div class=" cont">
            <div class="form-group">
                <label for="textareaDescription">Description :</label>
                <textarea name="description" id="textareaDescription" cols="30" rows="10">
                    <?= isset($description) ? $description : "" ?>
                </textarea>
            </div>

        </div> -->



        <div class=" cont">
            <div class="form-group">
                <label for="selectDimension">Dimensions du matelas :</label>
                <select name="dimension" id="selectDimension">
                    <option <?= isset($dimension) && $dimension === "90 X 190" ? "selected" : "" ?> value="90 X 190">90 X 190</option>
                    <option <?= isset($dimension) && $dimension === "140 X 190" ? "selected" : "" ?> value="140 X 190">140 X 190</option>
                    <option <?= isset($dimension) && $dimension === "160 X 200" ? "selected" : "" ?> value="160 X 200">160 X 200</option>
                    <option <?= isset($dimension) && $dimension === "180 X 200" ? "selected" : "" ?> value="180 X 200">180 X 200</option>
                    <option <?= isset($dimension) && $dimension === "200 X 200" ? "selected" : "" ?> value="200 X 200">200 X 200</option>

                </select>
            </div>

        </div>




        <div class="cont">
            <div class="form-group">
                <label for="inputPrix">Prix</label>
                <input type="number" name="prix" id="inputPrix" value="<?= isset($prix) ? $prix : 0 ?>" min="0">
            </div>

            <?php
            if (isset($errors["prix"])) {
            ?>
                <span class="prix-error">
                    <?= $errors["prix"] ?>
                </span>
            <?php
            }
            ?>
        </div>


        <div class="cont">
            <div class="form-group">
                <label for="inputPrix_Promo">Prix Promo</label>
                <input type="number" name="prix_promo" id="inputPrix_Promo" value="<?= isset($prix_promo) ? $prix_promo : 0 ?>" min="0">
            </div>
        </div>

        <div class=" cont">
            <div class="form-group">
                <input type="submit" value="Ajouter le matelas " class="btn-marmiton">
            </div>
        </div>

    </form>
</body>

</html>