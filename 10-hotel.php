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

  private $allRooms = 50;
  public $availableRooms = 2;
  public $Guests = [];
  public $reservations = [];

  public function booking($name)
  {
    if ($this->availableRooms > 0 ) {
      if(!in_array($name, $this->reservations)){
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
    $searching = array_search($name, $this->reservations);    // returning index
    if($searching){
      echo $searching;  // 2
      array_splice($this->reservations, $searching, 1);
      ++$this->availableRooms;
    }
    else{
      echo "There is no reservation with this name[$name]" . "<br>";
    }
  }

  public function checkIn($name)
  {
    if ($this->availableRooms > 0 || in_array($name, $this->reservations)) {
      if (!in_array($name, $this->Guests)) {
        if (in_array($name, $this->reservations)) {
          array_splice($this->reservations, array_search($name, $this->reservations), 1);
          ++$this->availableRooms;
        }
        $this->Guests[] = $name;
        --$this->availableRooms;
      } else {
        echo "You Are already Checked In";
      }
    } else {
      echo "No Available Room" . "<br>";
    }
  }

  public function checkOut($name)
  {
    if (in_array($name, $this->Guests)) {
      array_splice($this->Guests, array_search($name, $this->Guests), 1);
      ++$this->availableRooms;  
    } else {
      echo "You didn't Checked in to check out";
    }

  }

  public function currentOccupancyRate()
  {
    return $this->availableRooms;
  }

}


$test = new Hotel;

// $test->booking("Hady");
// $test->cancelBooking("Hady");
// $test->booking("Hady");
// $test->cancelBooking("Hady");

// $test->booking("ahmed");
// $test->booking("kar");
$test->checkIn("kar");
$test->checkIn("ahmed");
// $test->checkIn("koko");
$test->checkOut("ahmed");
$test->checkOut("kar");
$test->checkOut("kara");

// $test->booking("far");
// $test->booking("bar");
// $test->cancelBooking("far");
// // $test->booking("ffffffffff");
// $test->cancelBooking("kar");
// $test->cancelBooking("ahmed");
// $test->cancelBooking("far");

echo "<pre>"; print_r($test); echo "</pre>";

?>