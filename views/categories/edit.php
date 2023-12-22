<?php
include_once "../components/init.php";
include "../../Controllers/CategoryController.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(CategoryController::update($_POST['id'])){
        $_SESSION['success'] = "kategorija atnaujinta";
        header("Location: ./index.php");
        die;
    }
    
}
//print_r($_GET['id']); die;
if (!isset($_GET['id'])) {
    header("Location: ./index.php");  die;
}

$category = CategoryController::find($_GET['id']);//print_r($category);die;


include_once "../components/head.php";
?>

    <div class="container mt-5 ">
        <div class="row bg-secondary bg-gradient bg-opacity-25">
            <div class="col"></div>
            <div class="col-6">
                <form action="./edit.php" method="post">
                    <div class="form-group">
                        <img src="<?= $category->photo ?>" class="img-fluid" alt="">
                        <input type="text" class="form-control" name="photo" placeholder="Enter photo"
                            value="<?= $category->photo ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name"
                            value="<?= $category->name ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" name="description" placeholder="Enter description"
                            value="<?= $category->description ?>">
                    </div>

                    <input type="hidden" name="id" value="<?= $category->id ?>">
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <?php
include "../components/footer.php";
?>