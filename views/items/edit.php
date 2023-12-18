<?php
include_once "../../Controllers/ItemController.php";
include_once "../../Controllers/CategoryController.php";

$categories = CategoryController::getAll();

//jei atejai su post, atnaujinam irasa, ir redirectinam i index.php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    ItemController::update($_POST['id']);
    header("Location: ./index.php");
}

if (!isset($_GET['id'])) {
    header("Location: ./index.php");
}

$item = ItemController::find($_GET['id']);
// print_r($book);die;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body class="bg-light">
    <div class="container mt-5 ">
        <div class="row bg-secondary bg-gradient bg-opacity-25">
            <div class="col"></div>
            <div class="col-6">
            <form action="./edit.php" method="POST">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title" value="<?=$item->title?>">
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" name="price" placeholder="Enter price" value="<?=$item->price?>">
                    </div>

                    <div class="form-group">
                        <label for="item">item:</label>
                        <div id="emailHelp" class="form-text">Create an item <a href="../itemss/create.php">here</a> if it does not exist </div>
  
                        <select class="form-select " id="item" name="category_id" aria-label="Default select example">
                            <?php
                            foreach ($categoriess as $category) { ?>
                                <option <?= ($item->category_id == $category->id) ? "selected" : "" ?> value="<?= $category->id ?>"><?= $category->name . " " . $category->description  . " " . $category->photo ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?=$item->id?>">

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

</body>

</html>