<?php
include_once "../../Controllers/ItemController.php";
include_once "../../Controllers/CategoryController.php";

$authors = CategoryController::getAll();
//jei atejai su post, atnaujinam irasa, ir redirectinam i index.php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    ItemController::store();
    header("Location: ./index.php");
}

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
                <form action="./create.php" method="POST">
                    <div class="form-group">
                        <label for="name">Title:</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" name="price" placeholder="Enter price">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" name="description" placeholder="Enter description">
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo:</label>
                        <input type="text" class="form-control" name="photo" placeholder="Enter photo">
                    </div>


                    <div class="form-group">
                        <label for="category">Category:</label>
                        <div id="emailHelp" class="form-text">Create item category <a href="../categories/create.php">here</a> if it does not exists </div>
  
                        <select class="form-select " id="category" name="category_id" aria-label="Default select example">
                            <?php
                            foreach ($categories as $category) { ?>
                                <option value="<?= $category->id ?>"><?= $category->name . " " . $category->description . " " . $category->photo ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

</body>

</html>