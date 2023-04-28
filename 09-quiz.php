<?php
/* ---------------------------------------------------------------------------------
  Solved By Hady Asaker
  ----------------------------------------------------------------------------------
  Problem 9: Create a class that represents a quiz.
  1- The quiz class should have properties like questions, answers, and scores.
  2- It should also have methods to add and remove questions, check the answers,
    and calculate the final score.
  ----------------------------------------------------------------------------------
*/

class quiz{

  public $questions = [];
  public $answers = [];
  public $scores = [];
  public $finalScore = 0;

  public static $answerdQuestions = [];
  
  public function addQuestion($question, $answer, $score)
  {
    if (!array_search($question, $this->questions)) {
      $this->questions[] = $question;
      $this->answers[] = $answer;
      $this->scores[] = $score;  
    }
    else{
      echo "This Question Already Exists" . "<br>";
    }
  }
  public function removeQuestion($questionIndex)
  { 
    if (array_key_exists($questionIndex, $this->questions)) {
      // array_splice($this->questions, $questionIndex, 1);   // Warning! The Index Updated after removing a question
      // array_splice($this->answers, $questionIndex, 1);
      // array_splice($this->scores, $questionIndex, 1);
      // echo "Question [$questionIndex] is removed successfully And Question [".$questionIndex+1 ."] takes its place" . "<br>";

      unset($this->questions[$questionIndex]);          // If u don't need to update the Index after removing
      unset($this->answers[$questionIndex]);
      unset($this->scores[$questionIndex]);
      echo "Question [$questionIndex] is removed successfully" . "<br>";
    }
    else {
      echo "This Question Not Found" . "<br>";
    }
  }
  public function checkAnswers($questionIndex, $answer)
  {
    if (array_key_exists($questionIndex, $this->questions)) {
      if (!array_key_exists($questionIndex, self::$answerdQuestions)) {
        self::$answerdQuestions[$questionIndex] = $answer;
        if ($this->answers[$questionIndex] === $answer) {
          echo "Correct Answer" . "<br>";
          $this->finalScore += $this->scores[$questionIndex];
        } else {
          echo "Wrong Answer! Correct Answer => " . $this->answers[$questionIndex] . "<br>";
        }
      } 
      else {
        echo "You already answered this question" . "<br>";
      }
    } 
    else {
      echo "Question Not Found" . "<br>";
    }   
  }
}

$geo = new quiz;

$geo->addQuestion("Capital Of Egypt ?", "Cairo", 5);
$geo->addQuestion("5 + 8 = ?", "13", 1);                        // This Question Already Exists
$geo->addQuestion("what is the cat ?", "animal", 3);  
$geo->addQuestion("what is your name ?", "john", 5); 
$geo->addQuestion("what is your name ?", "john", 5); 

// $geo->removeQuestion(2);
// $geo->removeQuestion(2);

$geo->checkAnswers(1, "13");                                // Correct Answer    finalScore += 1
$geo->checkAnswers(1, "13");                                // You already answered this question
$geo->checkAnswers(2, "animal");                            // Correct Answer    finalScore += 3
$geo->checkAnswers(3, "as");                                // Wrong Answer! Correct Answer => john
$geo->checkAnswers(3, "john");                              // You already answered this question

echo "<pre>"; print_r($geo); echo "</pre>";                 // final score = 4
echo "<pre>"; print_r(quiz::$answerdQuestions); echo "</pre>";
?>