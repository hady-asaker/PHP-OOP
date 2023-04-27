<?php
/* -----------------------------------------------------------------------------------------------
  Solved By Hady Asaker
  ------------------------------------------------------------------------------------------------
  Problem 8: Create a class that represents a calendar.
  1- The calendar class should have properties like date, month, and year.
  2- It should also have methods to display the current date, move forward or backward in time,
   and check if a given date is a holiday.
  ------------------------------------------------------------------------------------------------
*/
date_default_timezone_set("Africa/Cairo");

class calendar{

  public $date;
  public $year;
  public $month;
  public $day;

  public static $officialHolidays = [
  "2023/01/01" => "يوم رأس السنة",
  "2023/01/07" => "عيد الميلاد القبطي",
  "2023/01/25" => "ثورة 25 يناير"  , 
  "2023/04/17" => "عيد شم النسيم"    , 
  "2023/04/21" => "عيد الفطر المبارك" ,
  "2023/04/25" => "عيد تحرير سيناء",
  "2023/05/01" => "عيد العمال", 
  "2023/06/27" => "أجازة يوم وقفة عرفات",
  "2023/06/28" => "عيد الأضحى المبارك", 
  "2023/06/30" => "ثورة 30 يونيو", 
  "2023/07/19" => "رأس السنة الهجرية", 
  "2023/07/23" => "عيد الثورة", 
  "2023/09/27" => "عيد المولد النبوى الشريف", 
  "2023/10/06" => "عيد القوات المسلحة"
  ];

  public function __construct($date) {

    $this->date = $date;

    list($this->year, $this->month, $this->day) = explode("/", $date);
    echo "Day: "   . $this->day   . "<br>";
    echo "Month: " . $this->month . "<br>";
    echo "Year: "  . $this->year  . "<br>";
    // echo $this->checkDate($date);
  }

  public function goForward($years=0, $months=0, $days=0)
  {
    $newDate = new DateTime($this->date);
    $newDate->modify("+{$years} years +{$months} months +{$days} days");

    $dateString = $newDate->format('Y/m/d');
    echo "New date: [ " . $dateString . " ] : " . $this->checkDate($dateString) . "<br>";

    $this->date = $dateString;
  
    }
    
  public function goBackward($years=0, $months=0, $days=0)
  {
    $newDate = new DateTime($this->date);
    $newDate->modify("-{$years} years -{$months} months -{$days} days");

    $dateString = $newDate->format('Y/m/d');
    echo "New date: [ " . $dateString . " ] : " . $this->checkDate($dateString) . "<br>";
    
    $this->date = $dateString;
  }

  public function checkDate($date)
  {
    foreach (self::$officialHolidays as $key => $value) {
      $isHoliday = false;
      if ($date == $key) {
        return $value;
        $isHoliday = true;
        break;
      }
    }
    if (!$isHoliday) {
      return "Not Holiday";
    }
  }

}

$test = new calendar("2023/07/19");

$test->goForward(0, 0, 4);
$test->goForward(0, 2, 4);
$test->goBackward(0, 3, 0);
$test->goBackward(0, 2, 10);

echo $test->checkDate("2023/04/25");

echo "<pre>"; print_r($test); echo "</pre>";

echo "<hr>";

$test2 = new calendar((date('Y/m/d')));
$test2->goForward(0, 2, 1);
echo "<pre>"; print_r($test2); echo "</pre>";


?>