<?php
include "../../models/Category.php";
class CategoryController{

public static function getAll() {
    $categories = Category::all();
    //print_r($categories);die;
    return $categories;
}

public static function find($id){
    $category = Category::find($id);
    return $category;
}

public static function store() {
    $category = new Category();
    $category->name = $_POST['name'];
    $category->description = $_POST['description'];
    $category->photo = $_POST['photo'];
    $category->save();
}
public static function update($id) {
    $category = Category::find($id);
    $category->name = $_POST['name'];
    $category->description = $_POST['description'];
    $category->photo = $_POST['photo'];
    $category->update();
}

public static function destroy($id) {
    Category::destroy($id);
}


}
?>