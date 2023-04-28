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
  public $availableRooms;
  public $Guests = [];
  public $reservations = [];

  public function book()
  {
    # code...
  }

  public function cancelBooking()
  {
    # code...
  }

  public function checkIn()
  {
    # code...
  }

  public function checkOut()
  {
    # code...
  }

  public function currentOccupancyRate()
  {
    # code...
  }

}


$test = new Hotel;



echo "<pre>"; print_r($test); echo "</pre>";

?>