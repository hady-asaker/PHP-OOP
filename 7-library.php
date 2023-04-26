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
    }
  }
  public function removeBook()
  {
    # code...
  }
  public function addAuthor()
  {
    # code...
  }
  public function removeAuthor()
  {
    # code...
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

echo "<pre>"; print_r($test); echo "</pre>";


?>
