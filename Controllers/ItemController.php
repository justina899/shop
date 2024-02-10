<?php
include_once "../../models/Item.php";
class ItemController
{

    public static function getAll()
    {
        $items = Item::all();
        return $items;
    }

    public static function find($id)
    {
        $item = Item::find($id);
        return $item;
    }

    public static function findByCategory($id) {
        $items = Item::findByCategory($id);
        return $items;
    }
    public static function store()
    {
        $item = new Item();
        $item->title = $_POST['title'];
        $item->price = $_POST['price'];
        $item->description = $_POST['description'];
        $item->photo = $_POST['photo'];
        $item->category_id = $_POST['category_id'];
        $item->save();
    }
    public static function update($id)
    {
        $item = Item::find($id);
        $item->title = $_POST['title'];
        $item->price = $_POST['price'];
        $item->description = $_POST['description'];
        $item->photo = $_POST['photo'];
        $item->category_id = $_POST['category_id'];
        $item->update();
    }

    public static function destroy($id)
    {
        Item::destroy($id);
    }

    public static function getfilterParams()
    {
        return Item::getFilterParams();
    }

    public static function filter()
    {
        return Item::filter();
    }

    public static function search()
    {
        return Item::search();
    }


}

?>