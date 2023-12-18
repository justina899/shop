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
            
            <div class="card-body">
            <img src="<?= $item->photo ?>" class="card-img-top" alt="...">
                <h5 class="card-title">
                    <?= $item->title ?>
                </h5>
                <p class="card-text">
                    <?= $item->description ?>
                </p>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price:
                        <?= $item->price ?>
                    </li>
                    <li class="list-group-item"><a href="../categories/show.php?id=<?= $item->category->id ?>">
                            <?= $item->category->name ?>
                        </a>
                    </li>
                </ul>

                <a href="./index.php" class="card-link">Show all items</a>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>
<?php
include "../components/footer.php";
?>