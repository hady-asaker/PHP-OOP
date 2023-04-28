<?php
/* --------------------------------------------------------------------------------------
  Solved By Hady Asaker
  ---------------------------------------------------------------------------------------
  Problem 10: Create a class that represents a hotel.
  1- The hotel class should have properties like rooms, guests, and reservations.
  2- It should also have methods to book and cancel rooms, check in and check out guests,
   and display the current occupancy rate. 
  ---------------------------------------------------------------------------------------
*/

class Hotel{

  private $allRooms = 500;
  public $availableRooms = 30;
  public $Guests = [];
  public $reservations = [];

  public function booking($name)
  {
    // Check available rooms
    if ($this->availableRooms > 0 ) {
      // Check if there is no reservation with the same name
      if(!in_array($name, $this->reservations)){
        // Book the room
        $this->reservations[] = $name;
        --$this->availableRooms;
      }
      else{
        echo "There is already a reservation with this name[$name]" . "<br>";
      }
    }
    else {
      echo "No Available Room" . "<br>";
    }
  }

  public function cancelBooking($name)
  {
    // Search for the reservation with the given name
    $searching = array_search($name, $this->reservations);    // returning index
    if($searching !== false){ // Check if the reservation was found
      // Remove the reservation and increase the available rooms
      array_splice($this->reservations, $searching, 1);
      ++$this->availableRooms;
    }
    else{
      echo "There is no reservation with this name[$name]" . "<br>";
    }
  }

  public function checkIn($name)
  {
    // Check if there are any available rooms or the guest has a reservation
    if ($this->availableRooms > 0 || in_array($name, $this->reservations)) {
      // Check if the guest is not already checked in
      if (!in_array($name, $this->Guests)) {
        // If the guest has a reservation, remove it and increase the available rooms
        if (in_array($name, $this->reservations)) {
          array_splice($this->reservations, array_search($name, $this->reservations), 1);
          ++$this->availableRooms;
        }
        // Add Guest and decrease the available rooms
        $this->Guests[] = $name;
        --$this->availableRooms;
      } else {
        echo "You Are already Checked In" . "<br>";
      }
    } else {
      echo "No Available Rooms" . "<br>";
    }
  }

  public function checkOut($name)
  {
    if (in_array($name, $this->Guests)) {
      // Check the guest out and increase the available rooms
      array_splice($this->Guests, array_search($name, $this->Guests), 1);
      ++$this->availableRooms;  
    } else {
      // The guest didn't check in yet
      echo "You didn't Checked in to check out" . "<br>";
    }

  }

  public function currentOccupancyRate()
  {
    return $this->availableRooms;
  }

}

// Creating a new instance
$test = new Hotel();
 
$test->booking("Hady");               // Booking a room for "Hady"
$test->cancelBooking("Hady");         // Cancelling the booking for "Hady"
$test->cancelBooking("Hady");         // Will fail

// Booking a room for "ahmed", "mohamed", "karim"
$test->booking("ahmed");
$test->booking("mohamed");
$test->booking("karim");

// Checking in "mohamed" and "ahmed" they've already booked
$test->checkIn("mohamed");
$test->checkIn("ahmed");

// checking in "saber", "fager"
$test->checkIn("saber");
$test->checkIn("fager");

// checking out "ahmed" and "mohamed"
$test->checkOut("ahmed");
$test->checkOut("mohamed");
$test->checkOut("mohamed");             // Will Fail

echo "<pre>"; print_r($test); echo "</pre>";

?>