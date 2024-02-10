<?php
include_once "../../Controllers/CategoryController.php";
include_once "../../Controllers/ItemController.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    ItemController::destroy($_POST['id']);
    header("Location: ./index.php");
}
if (isset($_GET['category_id'])) {
    $items = ItemController::findByCategory($_GET['category_id']);
    $categories = CategoryController::find($_GET['category_id']);
} else {
    $items = ItemController::getAll();
    $categories = CategoryController::getAll();
}

if($_SERVER['REQUEST_METHOD'] == "GET"){
    
    if(isset($_GET['filter'])){
        $items = ItemController::filter();
    }  
    if(isset($_GET['search'])){
        $items = ItemController::search();
    }  

    if(count($_GET) == 0){
        $items = ItemController::getAll();
    }
}

$params = ItemController::getfilterParams();


include_once "../components/head.php";
?>

<h1><?= $categories->name ?? "Visos prekės"  ?></h1>
<a class="btn btn-success" href="./create.php">Sukurti prekę</a>

<form action="" method="get" class="row mt-5 mb-2">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="row">
            <div class="col-2">
                <select class="form-select" name="filter">
                    <option value="">all</option>

                    <?php foreach ($params as $key => $param) { ?>
                        <option <?= (isset($_GET['filter'])) ? ($_GET['filter'] == $param) ? "selected" : "" : "" ?>
                            value="<?= $param ?>">
                            <?= $param ?>
                        </option>
                    <?php } ?>

                </select>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-6">
                        <input type="text" name="from" class="form-control">
                    </div>
                    <div class="col-6">
                        <input type="text" name="to" class="form-control">
                    </div>
                </div>

            </div>
            <div class="col-2">
                <select class="form-select" name="sort">
                    <option selected value="0">Rūšiuoti:</option>
                    <option <?= (isset($_GET['sort'])) ? ($_GET['sort'] == 1) ? "selected" : "" : "" ?> value="1">price 0-9
                    </option>
                    <option <?= (isset($_GET['sort'])) ? ($_GET['sort'] == 2) ? "selected" : "" : "" ?> value="2">price 9-0
                    </option>
                </select>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-outline-primary">Filter</button>
            </div>
        </div>
    </div>

    <div class="col-2"></div>

</form>

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