<?php
include "../../Controllers/CategoryController.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    CategoryController::destroy($_POST['id']);
    header("Location: ./index.php");
}
$categories = CategoryController::getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Hanken Grotesk' rel='stylesheet'>
    <link rel="stylesheet" href="../../css/main.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Prekių kategorijos</h1>
        <a class="btn btn-success" href="./create.php">create new category</a>
        <?php foreach ($categories as $key => $category) {
            if ($key % 4 == 0) { ?>
                <div class="row">
                <?php } ?>
                <div class="card col-3">
                    <div class="card-body">
                        <a class="card-img-ref" href="./show.php?id=<?= $category->id ?>">
                            <img id="cardImg" class="card-img-top" src="<?= $category->photo ?>" alt=""></a>
                        <h5 class="card-title mt-2 text-center">
                            <a class="card-title-ref" href="./show.php?id=<?= $category->id ?>">
                                <?= $category->name ?>
                            </a>
                        </h5>
                        <p class="card-text" style="height: 150px; ">
                            <?= substr($category->description, 0, 150) . "..." ?>
                        </p>
                        <div class="d-inline-block">
                            <form action="./edit.php" method="get">
                                <input type="hidden" name="id" value="<?= $category->id ?>">
                                <button class="btn btn-success" type="submit">edit</button>
                            </form>
                        </div>
                        <div class="d-inline-block">
                            <form action="./index.php" method="post">
                                <input type="hidden" name="id" value="<?= $category->id ?>">
                                <button class="btn btn-danger" type="submit">delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php if (($key + 1) % 4 == 0) { ?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</body>

</html>