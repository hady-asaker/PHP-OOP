<?php
/* --------------------------------------------------------------------------------------------------------
  Solved By Hady Asaker
  --------------------------------------------------------------------------------------------------------
  Problem 2: Create a class for a calculator with methods such as add, subtract, multiply, divide, and .... 
  --------------------------------------------------------------------------------------------------------
*/

class calculator{

    public function __call($name, $arguments)
    {
        switch ($name) {
            case 'Add':

                echo "sum of numbers [ " . implode(" + ", $arguments) . " ] = " . array_sum($arguments) . "<br>";
                break;   

            case 'Subtract':

                $result = $arguments[0];
                for ($i = 1; $i < count($arguments); $i++) {
                    $result -= $arguments[$i];
                }
                echo "Subtraction of numbers [ " . implode(" - ", $arguments) . " ] = " . $result . "<br>";
                break;    

            case 'Multiply':        

                    $i = 0;
                    $result = 1;
                    foreach ($arguments as $num) {
                        $result *= $num;
                    }
                    echo "Multiplication of numbers [ " . implode(" * ", $arguments) . " ] = " . $result . "<br>";     // array_product();
                    break;
            
            case('Divide'):
                
                $result = $arguments[0];
                for ($i = 1; $i < count($arguments); $i++) {
                    $result /= $arguments[$i];
                }
                echo "Subtraction of numbers [ " . implode(" / ", $arguments) . " ] = " . $result . "<br>";
                break;

            case 'Average':
                
                echo "Average of numbers [ " . implode(", ", $arguments) . " ] = " . array_sum($arguments)/count($arguments) . "<br>";
                break;

            case 'Factorial':

                if (count($arguments) == 1) {
                    
                    $fact = 1;
                    $n = $arguments[0];
                    for ($i = 1; $i <= $n; $i++) {
                        $fact *= $i;
                    }

                    echo "Factorial of [ " . $n . " ] = " . $fact . "<br>";

                }
                else {
                    echo "Enter Only One Number";
                    break;
                }
                break;
    
            default:
                echo "Undefined Method";
                break;
        }
    }
}
$obj = new calculator();

$obj->Add(50, 70, 30);
$obj->Subtract(50, 30);
$obj->Multiply(50, 10);
$obj->Divide(50, 5);
$obj->Average(50, 10);
$obj->Factorial(5);


?>