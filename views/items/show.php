<?php
if (!isset($_GET['id'])) {
    header("Location: ./index.php");
}

include_once "../../Controllers/CategoryController.php";
include_once "../../Controllers/ItemController.php";
$item = ItemController::find($_GET['id']);

include_once "../components/head.php";
?>

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