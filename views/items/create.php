<?php
include_once "../../Controllers/ItemController.php";
include_once "../../Controllers/CategoryController.php";

$authors = CategoryController::getAll();
//jei atejai su post, atnaujinam irasa, ir redirectinam i index.php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    ItemController::store();
    header("Location: ./index.php");
}

include_once "../components/head.php";
?>

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

    <?php
include "../components/footer.php";
?>