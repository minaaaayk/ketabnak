<?php
/**
 * Created by PhpStorm.
 * User: Minaa
 * Date: 11/18/2019
 * Time: 2:36 PM
 */

include ("db.php");
class Book
{

    // Properties
    private $id;
    private $BookName;
    private $AuthorName;

    // Constructor
    public function __construct($_id, $_BookName, $_AuthorName){
        $this->id = $_id;
        $this->AuthorName = $_AuthorName;
        $this->BookName = $_BookName;
    }
    // Methods
    function set_BookName($name) {
        $this->BookName = $name;
    }
    function set_AuthorName($name) {
         $this->AuthorName = $name;
    }
    function set_id($id2) {
        $this->id = $id2;
    }
    function get_BookName() {
        return $this->BookName;
    }
    function get_AuthorName() {
        return $this->AuthorName;
    }
    function get_id() {
        return $this->id;
    }

}

$bookArray  = array();

$returnData = array('statusCode'=> "", 'content' => "");

$action = $_POST['action'];
if($action == 1){ // insert object to DB
    $bname=$_POST['bookname'];
    $aname=$_POST['auhorname'];
    $sql = "INSERT INTO `book` (`book-name`, `author-name`) VALUES ('$bname', '$aname');";
     if (mysqli_query($conn, $sql)) {
         $returnData['statusCode'] = 200;
     }
     else {
         $returnData['statusCode'] = 201;
     }
}
if($action == 2){
    $id=$_POST['id'];
    $sql = "DELETE FROM `book` WHERE `id`=$id";
    if (mysqli_query($conn, $sql)) {
        $returnData['statusCode'] = 200;
    }
    else {
        $returnData['statusCode'] = 201;
    }
}

$qry = "select * from `book`";
$result = $conn->query($qry);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $newBook = new Book($row['id'], $row['book-name'], $row['author-name']);
        $bookArray[] = $newBook;
    }
}
$content = "";
foreach ($bookArray as $book){
    $content .= "<div class=\"book\">";

        $content .= "<div class=\"detail\">";
            $content .= "<div class=\"detail\">";
                $content .= "<div class=\"name\">";
                    $content .= $book->get_BookName();
                $content .= "</div>";
                $content .= "<div class=\"author\">";
                    $content .= $book->get_AuthorName();
                $content .= "</div>";
            $content .= "</div>";
        $content .= "</div>";

        $content .= "<a class=\"remove\"  href=\"\" onclick=\"removeBook(event,this," . $book->get_id(). ")\">";
            $content .= "<i class=\"far fa-times-circle\" style=\"font-size:40px;color:#fcfcfc\"></i>";
        $content .= "</a>";
    $content .= "</div>";
}
$returnData['content'] = $content;
echo json_encode($returnData);

