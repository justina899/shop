<?php

class Category{
    public $id;
    public $name;
    public $description;
    public $photo;
    public $itemsInCategory;
    public function __construct($id = 0, $name = "", $description = "", $photo = "", $itemsInCategory = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->photo = $photo;
        $this->itemsInCategory = $itemsInCategory;
    }

    public static function all()
    {
        $categories = [];
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $result = $db->query("SELECT * from categories");
        while ($row = $result->fetch_assoc()) {
            $categories[] = new Category($row['id'], $row['name'], $row['description'], $row['photo']);
        }
        //print_r($categories);die;
        $db->close();
        return $categories;
    }

    public static function find($id)
    {
        $category = new Category();
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        // $sql = "SELECT * from authors where id = ?";
        $sql = "SELECT c.id, c.name, c.description, c.photo, count(c.id) as 'itemsInCategory'
        FROM `categories` c
        left join items i 
        on c.id = i.category_id
        WHERE c.id = ?
        group by c.id;";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $category = new Category($row['id'], $row['name'], $row['description'], $row['photo'], $row['itemsInCategory']);
        }
        //print_r($category);die;
        $db->close();

        return $category;
    }

    public function save()
    {
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $sql = "INSERT INTO `categories`(`name`, `description`, `photo`) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sss", $this->name, $this->description, $this->photo);
        $stmt->execute();
        $db->close();
    }

    public function update()
    {
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $sql = "UPDATE `categories` SET `name`= ?,`description`= ?, `photo` = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssi", $this->name, $this->description, $this->photo, $this->id);
        $stmt->execute();
        $db->close();
    }


    public static function destroy($id)
    {
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $sql = "DELETE FROM `categories` WHERE `id` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $db->close();
    }

}
?>