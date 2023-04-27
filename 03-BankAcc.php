<?php
/* --------------------------------------------------------------------------------------------------------
  Solved By Hady Asaker
  --------------------------------------------------------------------------------------------------------
  Problem 3: Create a class that represents a bank account.

  1- The bank account class should have properties like account number, account holder name, and balance.
  2- It should also have methods to deposit and withdraw money, and to check the account balance.

                            Used Singleton pattern
  --------------------------------------------------------------------------------------------------------
*/

class BankAccount
{
    public $name;
    public $number;
    public $currentBalance;

    public function __construct($name, $number, $currentBalance)
    {
        $this->name = $name;
        $this->number = $number;
        $this->currentBalance = $currentBalance;

        // Create a new instance of AllAccounts and add this account to it
        $allAccounts = AllAccounts::getInstance();  // returns the only instance[object] Of Class AllAccounts. 
        $allAccounts->addAccount($this);  
    } 

    public function deposit($amount)
    {
        $this->currentBalance += $amount;
    }

    public function withdraw($amount)
    {
        $this->currentBalance -= $amount;
    }

    public function checkBalance()
    {
        return $this->currentBalance;
    }

}

class AllAccounts
{
    private static $instance = null;   // null -> meaning that there is no existing instance of the Class
    public $accounts = [];

    private function __construct() {}   //make the constructor private so that this class cannot be instantiated 

    // returns a single instance of the class 
    public static function getInstance() 
    {
        if (self::$instance == null) {      
            self::$instance = new AllAccounts();    // Create instance only first time
        }
        return self::$instance;         // Return The Same instance throw the app running
    }

    public function addAccount(BankAccount $account)
    {
        $this->accounts[] = $account;
    }
}

// Usage
$acc1 = new BankAccount("Bob", 1523, 1500);
$acc2 = new BankAccount("John", 4567, 2500);
$acc3 = new BankAccount("Alice", 7890, 5000);
$acc4 = new BankAccount("aaaaaaaaaaaaaaaaaaaaaa", 7890, 5000);

echo "<pre>"; print_r($acc4); echo "</pre>";

echo "<hr>";

// Get the list of accounts from AllAccounts
$allAccounts = AllAccounts::getInstance()->accounts;

echo "<pre>"; print_r($allAccounts); echo "</pre>";

echo "<hr>";

$acc1->deposit(2000);
$acc2->deposit(5000);
$acc3->withdraw(2000);
$acc4->withdraw(2000);

echo "<pre>"; print_r($allAccounts); echo "</pre>";

/* This ensures that there is only one instance of AllAccounts throughout the program,
 and that all objects that need to interact with it will interact with the same instance.*/
 ?>