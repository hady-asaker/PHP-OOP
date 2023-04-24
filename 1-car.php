<?php
/* ------------------------------------------------------------------------------------------------
  Solved By Hady Asaker
  -------------------------------------------------------------------------------------------------
  Create a class for a car with properties such as brand, model, and color. 
  -------------------------------------------------------------------------------------------------
                                      [Features] 
  
   1- Acceleration(تسارع): Add a method to the Car class that allows the car to accelerate.               
  This method would change the car's speed over time.
   
   2- Braking(الكبح): Add a method to the Car class that allows the car to brake.                         
  This method would decrease the car's speed over time.
  
   3- Turning(الانعطاف): Add a method to the Car class that allows the car to turn left or right          
  This method would change the direction that the car is facing.
   
  ----------------------------------------------------------------------------------------------------
*/

class car 
{
    public array $details = [];         // Array To Store Car's Details
    public $maxSpeed;
    public $isMoving = 0;               // Status Of Car Moving Or Not
    public $initialSpeed = 0;           // Initial Speed
    public $terminalSpeed ;             // Terminal Speed
    public static $iniSpeed = 0;        // staic initial speed use it when the car has changed her status more than once
    public $directionFacing;            // Direction of car Default Straight
    
    // Constructor to Check the status of car and update the property, give default direction "Straight"
    public function __construct($status, $max)
    {
        $this->isMoving = $status;
        $this->directionFacing = "Straight";
        $this->maxSpeed = $max;
        
        if($status == true){
            echo "You Are Moving Now <br>";
            $this->isMoving = 1;

            if($this->terminalSpeed > $max){
                $this->terminalSpeed = $max;
            }
        }

        elseif($status == false){
            echo "You Are Stooped<br>";
            $this->isMoving = 0;
            $this->terminalSpeed=0;
        }
    }

    // Method for turning the car left, right or straight
    public function Turning($turn){
        if (strtolower($turn) == "left" || strtolower($turn) == "right" || strtolower($turn) == "straight") {
            $this->directionFacing = $turn;
        }
        else
            $this->directionFacing = "Wrong Direction";
    }

    // Magic method to set the details property of the car as an array
    public function __call($name, $arguments)
    {
        if ($name == "Details") {
            $this->details = $arguments;
        }
    }

    // Method for setting the initial speed of the car
    public function setSpeed($testSpeed)
    {
        $this->initialSpeed = self::$iniSpeed = $testSpeed;
        if($testSpeed > $this->maxSpeed){
            $this->initialSpeed = self::$iniSpeed = $this->maxSpeed;
        }
    }

    // Method for accelerating the car
    public function Acceleration(car $a, $addSpeed)
    {
        // If the car is moving, increase the speed by the amount specified
        if($this->isMoving == true){
            $this->initialSpeed = self::$iniSpeed;
            if($this->terminalSpeed + $addSpeed > $this->maxSpeed){
                echo "You Can't Moving Faster Than Max Speed, So Now Your Speed = " . $this->maxSpeed;
                $this->terminalSpeed = self::$iniSpeed = $this->maxSpeed;
            }
            
            else{
                echo "You Are Moving And Your Speed Will Increase From " . self::$iniSpeed . " To " . self::$iniSpeed+$addSpeed;
                
                $this->terminalSpeed = self::$iniSpeed + $addSpeed;
                self::$iniSpeed += $addSpeed;
            }    
        }
        
        // If the car is stopped, set the initial speed to 0 and start moving at the specified speed
        elseif($this->isMoving == false){
            echo "You were stopped, but now you're moving at an increasing speed from 0 to " . $addSpeed;
            $this->initialSpeed = self::$iniSpeed;
            $this->terminalSpeed = self::$iniSpeed + $addSpeed;
            $this->isMoving = true;
            self::$iniSpeed += $addSpeed;
        }
    }

    // Method for braking the car
    public function Braking(car $a){

        $this->initialSpeed = self::$iniSpeed;
        self::$iniSpeed = 0;        

        // If the car is moving, stop it
        if($this->isMoving == true){
            echo "The Speed After Braking Is Decreasing To Zero";

            $this->terminalSpeed = 0;
            $this->isMoving = 0;
            $this->directionFacing = "Straight";

            if(self::$iniSpeed == $this->maxSpeed){
                $this->initialSpeed = $this->maxSpeed;
            }
        }
        //If the car already stopped, print "You Can't Braking"
        elseif($this->isMoving == false){
            $this->terminalSpeed = 0;
            echo "You Can't Braking because you are Actually Stopped";
        }
    }

} 

// Tests

$benz = new car(false, 500);        //car([isMoving or Not], Max Speed)
$benz->Details("Brand: Mercdes", "Model: CLA-200", "Color: White");
echo "<pre>"; print_r($benz); echo "</pre>";

echo '<hr>';

$benz->Braking($benz);              
echo "<pre>"; print_r($benz); echo "</pre>";        // WTF You Actually Stopped!

echo '<hr>';

$benz->Acceleration($benz, 20);                    // Speed will increase from to 0 to 20
$benz->Turning("Left");
echo "<pre>"; print_r($benz); echo "</pre>";

echo '<hr>';

$benz->Acceleration($benz, 100);                    // Speed will increase from to 20 to 120
$benz->Turning("Right");
echo "<pre>"; print_r($benz); echo "</pre>";

echo '<hr>';

$benz->Braking($benz);                              // Speed will decrese from to 120 to 0
echo "<pre>"; print_r($benz); echo "</pre>";

echo '<hr>';

$benz->Braking($benz);                              // WTF You Actually Stopped!
echo "<pre>"; print_r($benz); echo "</pre>";

echo '<br><br><hr><hr><br><br>';

$toyota = new car(true, 250);       //car([isMoving or Not], Max Speed)
// $toyota->Details("Brand: Toyota", "Model: Camry", "Color: Black", "Price: 5000");
$toyota->setSpeed(50);
echo "<pre>"; print_r($toyota); echo "</pre>";      // You Start from speed 50

echo '<hr>';

$toyota->Acceleration($toyota,2000);                // Pass overload speed
echo "<pre>"; print_r($toyota); echo "</pre>";      // Terminal speed = Max Speed = 250

echo '<hr>';

$toyota->Braking($toyota);                          // Speed will decrease from to 250 to 0
echo "<pre>"; print_r($toyota); echo "</pre>";

echo '<hr>';

$toyota->Acceleration($toyota,30);          // speed will increase from 0 to 30
echo "<pre>"; print_r($toyota); echo "</pre>";

echo '<hr>';

$toyota->Acceleration($toyota,80);          // speed will increase from 30 to 110
echo "<pre>"; print_r($toyota); echo "</pre>";

echo '<hr>';

$toyota->Braking($toyota);                  // speed will decrease from 110 to 0
echo "<pre>"; print_r($toyota); echo "</pre>";

echo '<hr>';

$toyota->Braking($toyota);                  // WTF You Actually Stopped!
echo "<pre>"; print_r($toyota); echo "</pre>";

?>