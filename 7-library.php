<?php
/* --------------------------------------------------------------------------------------------
  Solved By Hady Asaker
  ---------------------------------------------------------------------------------------------
  Problem 7: Create a class that represents a library.
  1- The library class should have properties like books, authors, and borrowers.
  2- It should also have methods to add and remove books, authors, borrowers, and return books.
  ---------------------------------------------------------------------------------------------
*/

class Book{

  public $name;
  public $author;
  public $quantity;

  // constructor to pass values to the properties
  public function __construct($name, $author, $quantity) {
    $this->name = $name;
    $this->author = $author;
    $this->quantity = $quantity;
  }
    // method to get name of book
    public function getBookName(){
      return $this->name;
    }
    // method to get quantity of book
    public function getQuantity(){
      return $this->quantity;
    }
    // method to set name of book
    public function setQuantity($quan){
      $this->quantity = $quan;
    }
    
}

class Library {

  public $Books = []; // All Books
  public $authors = []; // All Authors
  public $borrowers = []; // borrowers information

  public function addBook($name, $author, $quantity)
  {
    $isExist = null;
    foreach ($this->Books as $book) {
      if ($name == $book->getBookName()) {
        // If the book already exists, increase the quantity of the book by the input quantity
        $isExist = $book;
        $isExist->setQuantity($book->getQuantity() + $quantity);
      }
    }
    if ($isExist == null) {
      // If the book does not exist, create a new Book object and add it to the Books array
      $newBook = new Book($name, $author, $quantity);
      $this->Books[] = $newBook;
      if (!in_array($author, $this->authors)) {
        $this->authors[] = $author; // Add the author name to the authors array if it does not exist
      }
    }
  }

  public function removeBook($name, $quantity)
  {
    $isExist = false;
    foreach ($this->Books as $key => $book) {
      if ($name == $book->getBookName() && $quantity >= $book->getQuantity()) {
        // If the book exists and the quantity to remove is greater than or equal to the quantity of the book, remove the book from the Books array
        unset($this->Books[$key]);
        $isExist = true;
      }
      elseif($name == $book->getBookName() && $quantity < $book->getQuantity()){
        // If the book exists and the quantity to remove is less than the quantity of the book, decrease the quantity of the book by the input quantity
        $book->setQuantity($book->getQuantity() - $quantity);
        $isExist = true;
      }
    }
    if (!$isExist) {
      // If the book does not exist, output an error message
      echo "This Book [ $name ] Not Found" . "<br>";
    }
  }

  public function addAuthor($name)
  {
    if (!in_array($name, $this->authors)) {
      // If the author does not exist in the authors array, add the author to the array and output a success message
      $this->authors[] = $name;
      echo "Author [ $name ] has been added" . "<br>";
    }
    else {
      // If the author already exists in the authors array, output an error message
      echo "This Author [ $name ] Already Exists" . "<br>";
    }
  }
  
  public function removeAuthor($name)
  {
    // find the index of the author to remove
    $key = array_search($name, $this->authors);

    // if author exists, remove from the array
    if ($key != false) {
      unset($this->authors[$key]);
      echo "Author [ " . $name . " ] has been removed." . "<br>";
    }
    // if author doesn't exist, display error message
    else {
      echo "This Author [ $name ] Not Exists" . "<br>";
    }
  }

  public function addBorrower($borrowerName, $bookName)
  {
      $bookExists = false;
      $borrowerIndex = null;
  
      // check if the book exists in the library
      foreach ($this->Books as $book) {
          if ($bookName == $book->getBookName()) {
              $bookExists = true;
              break;
          }
      }
  
      // if book doesn't exist
      if (!$bookExists) {
          echo "This book [$bookName] is not found, you can't borrow." . "<br>";
          return;
      }
  
      // check if the borrower already exists in the borrowers array
      foreach ($this->borrowers as $index => $borrower) {
          if ($borrowerName == $borrower['borrowerName']) {
              $borrowerIndex = $index;
              break;
          }
      }
  
      if ($borrowerIndex !== null) {
          // borrower already exists, add new book to their array if it doesn't already exist
          if (!in_array($bookName, $this->borrowers[$borrowerIndex]['bookNames'])) {
              array_push($this->borrowers[$borrowerIndex]['bookNames'], $bookName);
          } else {
              // if borrower already has the book, display error message
              echo "This borrower [$borrowerName] has already borrowed [$bookName]." . "<br>";
          }
      } else {
          // new borrower, add to borrowers array with one book
          array_push($this->borrowers, [
              'borrowerName' => $borrowerName,
              'bookNames' => [$bookName]
          ]);
      }
  }

  public function returnBook($borrowerName, $bookName)
  {
      $borrowerExists = false; 
      $bookExists = false; 
  
      // loop through borrowers
      foreach ($this->borrowers as $key => $borrower) {
          // if borrower exists
          if ($borrower['borrowerName'] == $borrowerName) {
              $borrowerExists = true;
              $books = $borrower['bookNames']; // get the books borrowed by borrower
              // loop through the books borrowed by borrower
              foreach ($books as $key2 => $book) {
                  // if book is found
                  if ($book == $bookName) {
                      $bookExists = true;
                      unset($books[$key2]); // remove the book from the borrower's list of borrowed books
                      // if the borrower has no more borrowed books, remove him from the list of borrowers
                      if (empty($books)) {
                          unset($this->borrowers[$key]);
                      } else {
                          $this->borrowers[$key]['bookNames'] = $books;
                      }
                      break;
                  }
              }
              break;
          }
      }
  
      // check if borrower and book exist
      if ($borrowerExists && $bookExists) {
          echo "Book [$bookName] has been returned by [$borrowerName].<br>";
      }
      // check if borrower exists but book does not
      elseif ($borrowerExists && !$bookExists) {
          echo "Book [$bookName] has not been borrowed by [$borrowerName].<br>";
      }
      // check if borrower does not exist
      else {
          echo "Borrower [$borrowerName] not found.<br>";
      }
  }
} 
  $test = new Library();
  
  $test->addBook("Book1", "kiki", 5); // add 5 book1
  $test->addBook("Book2", "kiwy", 5); // add 5 book2
  $test->addBook("Book3", "mimi", 5); // add 5 book3
  $test->addBook("Book4", "mimi", 3); // add 3 book4
  
  $test->removeBook("Book3", 1); // remove one [book3] from five
  
  // add authors
  $test->addAuthor("momo"); 
  $test->addAuthor("Hady");
  
  // remove authors
  $test->removeAuthor("Hady");
  $test->removeAuthor("Hady"); // remove author Not Found!
  
  // add borrowers
  $test->addBorrower("Hady", "Book3");
  $test->addBorrower("Hady", "Book3");   // You have already Borrowed it
  $test->addBorrower("sameh", "Book1");
  $test->addBorrower("sameh", "Book2");
  $test->addBorrower("sameh", "Book3");
  
  // Return Books
  $test->returnBook("sameh", "Book1"); // return book
  $test->returnBook("sameh", "Book3"); // return book
  // $test->returnBook("Hady", "Book3"); // return book and remove from borrowers
  
  echo "<pre>"; print_r($test); echo "</pre>"; // display the Library object
  
?>
