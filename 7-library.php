<?php
/* -----------------------------------------------------------------------------------
  Solved By Hady Asaker
  ------------------------------------------------------------------------------------
  Problem 7: Create a class that represents a library.
  1- The library class should have properties like books, authors, and borrowers.
  2- It should also have methods to add and remove books, authors, and borrowers,
   and to lend and return books.
  ------------------------------------------------------------------------------------
*/

class Book{

  public $name;
  public $author;
  public $quantity;

  public function __construct($name, $author, $quantity) {
    $this->name = $name;
    $this->author = $author;
    $this->quantity = $quantity;
  }
  
    public function getBookName(){
      return $this->name;
    }
  
    public function getBookAuthor(){
      return $this->author;
    }
    public function getQuantity(){
      return $this->quantity;
    }
    public function setQuantity($quan){
      $this->quantity = $quan;
    }
    
}


class Library {

  public $Books = [];
  public $authors = [];
  public $borrowers = [];

  public static $newBorrower;

  public function addBook($name, $author, $quantity)
  {
    $isExist = null;
    foreach ($this->Books as $book) {
      if ($name == $book->getBookName()) {
        $isExist = $book;
        $isExist->setQuantity($book->getQuantity() + $quantity);
      }
    }
    if ($isExist == null) {
      $newBook = new Book($name, $author, $quantity);
      $this->Books[] = $newBook;  
      $this->authors[] = $author;
    }
  }

  public function removeBook($name, $quantity)
  {
    $isExist = false;
    foreach ($this->Books as $key => $book) {
      if ($name == $book->getBookName() && $quantity >= $book->getQuantity()) {
        unset($this->Books[$key]);
        $isExist = true;
      }
      elseif($name == $book->getBookName() && $quantity < $book->getQuantity()){
        $book->setQuantity($book->getQuantity() - $quantity);
        $isExist = true;
      }
    }
    if (!$isExist) {
      echo "This Book [ $name ] Not Found" . "<br>";
    }
  }

  public function addAuthor($name)
  {
    if (!in_array($name, $this->authors)) {
      $this->authors[] = $name;
      echo "Author [ $name ] has been added" . "<br>";
    }
    else {
      echo "This Author [ $name ] Already Exists" . "<br>";
    }
      
  }
  public function removeAuthor($name)
  {
    $key = array_search($name, $this->authors);

    if ($key != false) {
      unset($this->authors[$key]);
      echo "Author [ " . $name . " ] has been removed." . "<br>";
    }
    else {
      echo "This Author [ $name ] Not Exists" . "<br>";
    }
  }

  public function addBorrower()
  {
    # code...
  }
  public function removeBorrower()
  {
    # code...
  }

  public function lendBook(){

  }
  
}

$test = new Library();

$test->addBook("Book1", "kiki", 5);
$test->addBook("Book2", "mimi", 5);
$test->addBook("Book3", "momo", 5);

$test->removeBook("Book3", 1);

$test->addAuthor("momo");
$test->addAuthor("Hady");

$test->removeAuthor("Hady");
$test->removeAuthor("Hady");

echo "<pre>"; print_r($test); echo "</pre>";


?>
