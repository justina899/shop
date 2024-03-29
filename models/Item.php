<?php


class Item {
public $id;
public $title;
public $price;
public $description;
public $photo;
public $category_id;
public $category;

public function __construct($id = 0, $title = "", $price = 0, $description = "", $photo = "", $category_id = 0){
    $this->id = $id;
    $this->title = $title;
    $this->price = $price;
    $this->description = $description;
    $this->photo = $photo;
    $this->category_id = $category_id;
    $this->category = ($category_id != 0) ? CategoryController::find($category_id) : new Category();
}

public static function all()
    {
        $items = [];
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $result = $db->query("SELECT * from items");
        while ($row = $result->fetch_assoc()) {
            $items[] = new Item($row['id'], $row['title'], $row['price'], $row['description'], $row['photo'], $row['category_id']);
        }
        $db->close();
        return $items;
    }

    public static function findByCategory($id)
    {
        $items = [];
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $sql = "SELECT * from items where category_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $items[] = new Item($row['id'], $row['title'], $row['price'], $row['description'], $row['photo'], $row['category_id']);
        }
        $db->close();
        return $items;
    }

    public static function find($id)
    {
        $book = new Item();
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $sql = "SELECT * from items where id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $item = new Item($row['id'], $row['title'], $row['price'], $row['description'], $row['photo'], $row['category_id']);
        }
        $db->close();
        return $item;
    }
    public function save()
    {
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $sql = "INSERT INTO `items`(`title`, `price`, `description`, `photo`, `category_id`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sissi", $this->title, $this->price, $this->description, $this->photo, $this->category_id);
        $stmt->execute();
        $db->close();
    }

    public function update()
    {
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $sql = "UPDATE `items` SET `title`= ?,`price`= ? ,`description`= ?,`photo`= ?,`category_id`= ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sissi", $this->title, $this->price, $this->description, $this->photo, $this->category_id);
        $stmt->execute();
        $db->close();
    }

    public static function destroy($id)
    {
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $sql = "DELETE FROM `items` WHERE `id` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $db->close();
    }

    public static function getFilterParams()
    {
        $params = [];
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $query = "SELECT DISTINCT `category_id` FROM `items`";
        $result = $db->query($query);

        while($row = $result->fetch_assoc()){
            $params[] = $row['category_id'];
        }
        $db->close();
        return $params;
    }

    public static function filter()
    {
        $items = [];
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $query = "SELECT * FROM `items`";
        $first = true;
        if($_GET['filter'] != ""){
            $first = false;
            $query .= "WHERE `category_id` = " . "'". $_GET['filter'] . "'" . " ";
        }

        if($_GET['from'] != ""){
            $query .= (($first)? "WHERE" : "AND") ." `price` >= " . $_GET['from'] . " ";
            $first = false;
            
        }

        if($_GET['to'] != ""){
            $query .= (($first)? "WHERE" : "AND") ." `price` <= " . $_GET['to'] . " ";
            $first = false;
            
        }

        switch($_GET['sort']){
            case '1':
                $query .= "ORDER by `price`";
                break;
            case '2':
                $query .= "ORDER by `price` DESC";
                break;
        }
        // echo $query;
        // die;
        $result = $db->query($query);
        while($row = $result->fetch_assoc()){
            $items[] = new Item($row['id'], $row['title'], $row['price'], $row['description'], $row['photo'], $row['category_id']);
        }
        
        $db->close(); 
        return $items;
    }

    public static function search(){
        $items = [];
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $query = "SELECT * FROM `items` where `title` like \"%" . $_GET['search'] . "%\""; 
        $result = $db->query($query);
    
        while($row = $result->fetch_assoc()){
            $items[] = new Item($row['id'], $row['title'], $row['price'], $row['description'], $row['photo'], $row['category_id']);
        }
        $db->close();
        return $items;
    }


}
?>