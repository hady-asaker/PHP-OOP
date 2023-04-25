<?php
/* --------------------------------------------------------------------------------------------------------
  Solved By Hady Asaker
  --------------------------------------------------------------------------------------------------------
  Problem 4: Create a class that represents a shopping cart.
  1- The shopping cart class should have properties like items, quantities, and prices.
  2- It should also have methods to add and remove items from the cart,
   and to calculate the total cost of the items in the cart.   
  --------------------------------------------------------------------------------------------------------
*/

class Item
{
    private $name;
    private $price;
    private $count;

    public function __construct($name, $price, $count)
    {
        $this->name = $name;
        $this->price = $price;
        $this->count = $count;
    }

    // Method to get itemName
    public function getName()
    {
        return $this->name;
    }

    // Method to get itemPrice
    public function getPrice()
    {
        return $this->price;
    }

    // Method to get itemCount
    public function getCount()
    {
        return $this->count;
    }

    // Method to set itemCount
    public function setCount($count)
    {
        $this->count = $count;
    }

}

class ShoppingCart
{
    private $customerName;
    private $items = [];
    private $totalPrice = 0;

    public function __construct($customerName)
    {
        $this->customerName = $customerName;
    }

    // Method to set Add new item
    public function addItem($name, $price, $count)
    {
        $existingItem = null;
    
        // Check if an item with the same name already exists in the cart or not
        foreach ($this->items as $item) {
            if ($item->getName() == $name) {
                $existingItem = $item;
                break;
            }
            else{}
        }
    
        // If an existing item was found, increase its count
        if ($existingItem !== null) {
            $existingItem->setCount($existingItem->getCount() + $count);
        } else {

            // Otherwise, create a new Item object and add it to the cart
            $item = new Item($name, $price, $count);
            $this->items[] = $item;
        }
    
        // Update the total price
        $this->totalPrice = $this->getTotalPrice();
    }
    
    // Method to Remove Item From The Cart
    public function removeItem($name, $count)
    {
        $itemFound = false;
        foreach ($this->items as $key => $item) {

            if ($item->getName() == $name) {

                $currentCount = $item->getCount();

                if ($count >= $currentCount) {
                    unset($this->items[$key]);
                } 

                else {
                    $item->setCount($currentCount - $count);
                }
                $itemFound = true;
                break;
            }
        }
        // If You Want To Remove doesn't exist item from the cart
        if (!$itemFound) {
            echo "This Item [ " . $name . " ] Not Exist In The Cart" . "<br>";
        }
        $this->totalPrice = $this->getTotalPrice();
    }
    
    // Method To Get The Total price in the cart
    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            $totalPrice += $item->getPrice() * $item->getCount();
        }
        return $totalPrice . "$";
    }
    
}

// Create New Shopping cart For "Customer"

$Customer = new ShoppingCart("Customer");     
$Customer->addItem("Mobile", 1000, 2);              // Add two Mobiles each = 1000$     -> total = 2000$
$Customer->addItem("Mobile Cover", 100, 5);         // Add five Covers each = 100$     -> total = 500$
$Customer->addItem("Shoes", 200, 5);                // Add five Shoes each = 200$     -> total = 1000$
$Customer->addItem("Shoes", 200, 3);                // Add Three Shoes each = 200$     -> total = 600$

echo "<pre>"; print_r($Customer); echo "</pre>";                // Total Price = 4100$

echo "<hr>";

$Customer->removeItem("Mobile", 1);                 // Remove One Mobile for 1000$
$Customer->removeItem("anyThing", 1);               // Remove non-exist item

echo "<pre>"; print_r($Customer); echo "</pre>";                // Total Price = 3100$

?>