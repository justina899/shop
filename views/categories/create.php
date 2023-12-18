<?php
include "../../Controllers/CategoryController.php";

//jei atejai su post, atnaujinam irasa, ir redirectinam i index.php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    CategoryController::store();
    header("Location: ./index.php");
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
                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" name="description" placeholder="Enter Description">
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo:</label>
                        <input type="text" class="form-control" name="photo" placeholder="Enter Photo">
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 mb-5">Submit</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

</body>

</html>