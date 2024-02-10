<?php
include_once "../components/init.php";

include_once "../../Controllers/CategoryController.php";
include_once "../../Controllers/ItemController.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    CategoryController::destroy($_POST['id']);
    header("Location: ./index.php");
}
$categories = CategoryController::getAll();

include_once "../components/head.php";

?>

<div class="container">
    <h1>Prekių kategorijos</h1>
    <a class="btn btn-success" href="./create.php">create new category</a>
    <a class="btn btn-primary" href="../items/index.php">Pamatyti prekių sąrašą</a>
    
    <?php foreach ($categories as $key => $category) {
        if ($key % 4 == 0) { ?>
            <div class="row">
            <?php } ?>
            <div class="card col-3">
                <div class="card-body">
                    <a class="card-img-ref" href="../items/index.php?category_id=<?= $category->id ?>">
                        <img id="cardImg" class="card-img-top" src="<?= $category->photo ?>" alt=""></a>
                    <h5 class="card-title mt-2 text-center">
                        <a class="card-title-ref" href="../items/index.php?category_id=<?= $category->id ?>">
                            <?= $category->name ?>
                        </a>
                    </h5>
                    <p class="card-text" style="height: 150px; ">
                        <?= substr($category->description, 0, 150) . "..." ?>
                    </p>
                    <div class="d-inline-block">
                        <a class="btn btn-primary" href="./show.php?id=<?= $category->id ?>">show</a>
                    </div>
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
<?php
include "../components/footer.php";
?>