<?php
if (!isset($_GET['id'])) {
    header("Location: ./index.php");
}

include "../../Controllers/CategoryController.php";
include_once "../../Controllers/ItemController.php";

$items = ItemController::findByCategory($_GET['id']);
$category = CategoryController::find($_GET['id']);

include_once "../components/head.php";
?>

<div class="row">
    <div class="col"></div>
    <div class="col-6">


        <div class="card" style="width: 100%;">
            <div class="card-body">
                <img class="categoryPic card-img-top" src="<?= $category->photo ?>" alt="...">
                <h5 class="card-title"><?= $category->name ?></h5>
                <p class="card-text"><?= $category->description ?></p>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Items in category: <?= $category->itemsInCategory ?></li>
                    <?php foreach ($items as $item) { ?>
                        <li class="list-group-item">
                            <?= $item->title ?>
                        </li>

                    <?php } ?>
                </ul>

                <a href="#" class="card-link">Categories link</a>
                <a href="./index.php" class="card-link">Show all categories</a>

            </div>
        </div>
    </div>
    <div class="col"></div>
</div>
<?php
include "../components/footer.php";
?>