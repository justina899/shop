<?php
include_once "../../Controllers/CategoryController.php";
include_once "../../Controllers/ItemController.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    ItemController::destroy($_POST['id']);
    header("Location: ./index.php");
}
if (isset($_GET['category_id'])) {
    $items = ItemController::findByCategory($_GET['category_id']);
} else {
    $items = ItemController::getAll();
}
$categories = CategoryController::getAll();

include_once "../components/head.php";
?>

        <h1>Čia yra prekes</h1>
        <a class="btn btn-success" href="./create.php">sukurti</a>
        <a class="btn btn-primary" href="../categories">Grįžti į kategorijas</a>

        <?php foreach ($items as $key => $item) {
            if ($key % 4 == 0) { ?>
                <div class="row">
                <?php } ?>
                <div class="card col-3">
                    <div class="card-body">
                        <a class="card-img-ref" href="./show.php?id=<?= $item->id ?>">
                            <img id="cardImg" class="card-img-top" src="<?= $item->photo ?>" alt=""></a>
                        <h5 class="card-title mt-2 text-center">
                            <a class="card-title-ref" href="./show.php?id=<?= $item->id ?>">
                                <?= $item->title ?>
                            </a>
                        </h5>
                        <p class="card-text" style="height: 80px; ">
                            <?= $item->description ?>
                        </p>
                        <p class="">
                            <?= $item->price ?>
                        </p>
                        <div class="d-inline-block">
                            <a class="btn btn-primary" href="./show.php?id=<?= $item->id ?>">show</a>
                        </div>
                        <div class="d-inline-block">
                            <form action="./edit.php" method="get">
                                <input type="hidden" name="id" value="<?= $item->id ?>">
                                <button class="btn btn-success" type="submit">edit</button>
                            </form>
                        </div>
                        <div class="d-inline-block">
                            <form action="./index.php" method="post">
                                <input type="hidden" name="id" value="<?= $item->id ?>">
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
    <?php
include "../components/footer.php";
?>