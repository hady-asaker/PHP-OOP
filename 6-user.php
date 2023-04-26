<?php
/* -------------------------------------------------------------------------
  Solved By Hady Asaker
  --------------------------------------------------------------------------
  Problem 6: 
  Create a class that represents a user.
  - The user class should have properties like username, email, and password.

  Create a class that represents a system.
  - It should have methods to register, login, and logout.
  ---------------------------------------------------------------------------
*/

// Define user class
class user{

  private $userName;
  private $email;
  private $password;

  // Constructor
  public function __construct($userName, $email, $password) {
    $this->userName = $userName;
    $this->email = $email;
    $this->password = sha1($password); // Hash the password for security
  } 

  // Return user's username
  public function getUserName()
  {
    return $this->userName;
  }

  // Return user's hashed password
  public function getPassword()
  {
    return $this->password;
  }
  
  // Return user's email
  public function getEmail()
  {
    return $this->email;
  }

}

// Define the system class to manage accounts
class system{

  public $users = [];             // Array to hold registered users
  public $loggedInUsers = [];     // Array to hold currently logged in users

  // Register a new user
  public function register($userName, $email, $password){

    $isExist = false; // Flag to check if the account already exists


    foreach ($this->users as $user) {

      if ($user->getUserName() == $userName && $user->getEmail() == $email) {
        echo "The Account [ " . $userName . " ] Already Exists" . "<br>";
        $isExist = true;
      }
      else{}
    }

    // If the account doesn't exist, add new user
    if(!$isExist) {
      $newUser = new user($userName, $email, $password);
      $this->users[] = $newUser;
      echo "[ " . $userName . " ] Account Created Successfully" . "<br>";
    }

  }

  // Method to Log in a user
  public function login($userName, $password){

    $isLoggedIn = false;      // Flag to check if the user is already logged in
    $isExist = false;         // Flag to check if the account exists

    // Loop through logged in users to check Account logged in or not
    foreach ($this->loggedInUsers as $user) {
      if ($user->getUserName() == $userName){
        echo "[ " . $userName . " ] You Are Already Logged In" . "<br>";
        $isLoggedIn = true;
      }
      else{}
    }

    // If the user isn't already logged in, loop through registered users to check for the account
    if(!$isLoggedIn){

      foreach ($this->users as $user) {
        if ($user->getUserName() == $userName && $user->getPassword() == sha1($password)) {
          $this->loggedInUsers[] = $user;
          echo "[ " . $userName . " ] Logged In Successfully" . "<br>";
          $isExist = true;
          break; // Break out of the loop once the user is found
        }
        
      }
      // If the account doesn't exist
      if (!$isExist) {
        echo "[ " . $userName . " ] Account Not Registered" . "<br>";
      }
    }
  }

  // Log out a user with the username
  public function logout($userName){

    $isLoggedIn = false;
    foreach ($this->loggedInUsers as $key => $user) {
      if ($user->getUserName() == $userName){
        unset($this->loggedInUsers[$key]); // Remove the user from the logged in array
        $isLoggedIn = true;
      }
    }
     if(!$isLoggedIn){
      echo "[ " . $userName . " ] Account doesn't Logged In Yet" . "<br>";
     }
  }
}


// Create a new instance of the system class
$test = new system();

// Attempt to register three users
$test->register("Ahmed_1", "hah@hah", 1234);
$test->register("Ahmed_1", "hah@hah", 12345); // This registration attempt will fail because the username and email are already taken
$test->register("Ahmed_3", "hah@hah", 123456);

// Attempt to login as Ahmed_3 twice
$test->login("Ahmed_3", 123456);
$test->login("Ahmed_3", 123456); // This login attempt will fail because Ahmed_3 is already logged in

// Attempt to login as Ahmed_5 (who doesn't exist)
$test->login("Ahmed_5", 555); // This login attempt will fail because the account does not exist

// Attempt to logout as Ahmed_5 (who doesn't exist)
$test->logout("Ahmed_5"); // This logout attempt will fail because the account is not logged in

// Print out the current state of the system (users and logged in users)
echo "<pre>"; print_r($test); echo "</pre>";

?>