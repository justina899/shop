<?php
include_once "../components/init.php";
include "../../Controllers/CategoryController.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (CategoryController::store()) {
        $_SESSION['success'] = "nauja kategorija sukurta";
        header("Location: ./index.php");
        die;
    } 
}
include_once "../components/head.php";

?>

<div class="container mt-5 ">
    <div class="row bg-secondary bg-gradient bg-opacity-25">
        <div class="col"></div>
        <div class="col-6">
            <form action="./create.php" method="POST">
                <div class="form-group mt-5">
                    <label for="name">Category name:</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?=(isset($_POST['name'])) ? $_POST['name'] : "" ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter Description" value="<?=(isset($_POST['description'])) ? $_POST['description'] : "" ?>">
                </div>
                <div class="form-group">
                    <label for="photo">Photo:</label>
                    <input type="text" class="form-control" name="photo" placeholder="Enter Photo" value="<?=(isset($_POST['photo'])) ? $_POST['photo'] : "" ?>">
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-5">Submit</button>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>

<?php
include "../components/footer.php";
?>