<?php
if (!isset($_GET['id'])) {
    header("Location: ./index.php");
}

include_once "../../Controllers/CategoryController.php";
include_once "../../Controllers/ItemController.php";
$item = ItemController::find($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="row">
        <div class="col"></div>
        <div class="col-6">


            <div class="card" style="width: 100%;">
                <img src="<?=$item->photo?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$item->title ?></h5>
                    <p class="card-text"><?=$item->description?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price: <?=$item->price?></li>
                    <li class="list-group-item"><a href="../categories/show.php?id=<?=$item->category->id?>"><?=$item->category->name?></a></li>
                </ul>
                <div class="card-body">
                    <a href="./index.php" class="card-link">Show all items</a>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</body>

</html>