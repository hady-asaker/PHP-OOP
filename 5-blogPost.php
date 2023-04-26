<?php
/* ------------------------------------------------------------------------------------
  Solved By Hady Asaker
  -------------------------------------------------------------------------------------
  Problem 5: Create a class that represents a blog post.
  1- The blog post class should have properties like title, content, author, and date.
  2- It should also have methods to add, edit, and delete blog posts.
  -------------------------------------------------------------------------------------
*/

class Post{

    public $title;
    public $content;
    public $date;

    public function __construct($t, $c, $d) {
        $this->title = $t;
        $this->content = $c;
        $this->date = $d;
    }

    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

}

class prsonalBlog{

    public $author;
    public array $blog = [];

    public function __construct($name) {
        $this->author = $name;
    }

    public function addPost($t, $c, $d){
        $newPost = new Post($t, $c, $d);
        $this->blog[] = $newPost;
    }

    public function removePost($title){
        $found = false;
        foreach ($this->blog as $key => $post) {
            if ($post->getTitle() == $title) {
                unset($this->blog[$key]);
                $found = true;
                break;
            }
        }
        if(!$found) {
            echo "The Post Of Title \"" . $title . "\" Not Found" . "<br>";
        }
    }

    public function editPost($title,$newTitle, $newContent){
        $found = false;
        foreach ($this->blog as $post) {
            if ($post->getTitle() == $title) {

                $post->setTitle($newTitle ?? $title);
                $post->setContent($newContent);
                
                $found = true;
                break;
            }
        }
        if(!$found) {
            echo "The Post Of Title \"" . $title . "\" Not Found" . "<br>";
        }
    }
}

$newPlog = new prsonalBlog("Hady");

$newPlog->addPost("FIRST_POST", "You Are Good", "2023-9-01");
$newPlog->addPost("SECOND_POST", "Take good care of your health", date('2022-12-03'));
$newPlog->addPost("THIRD_POST", "Love yourself, love money, and avoid anything else", "2025-07-21");

echo "<pre>"; print_r($newPlog); echo "</pre>";

echo "<hr>";

$newPlog->removePost("Fourth");
$newPlog->editPost("test", "test", "test");
$newPlog->editPost("FIRST_POST","first_updated", "You Still Good");
$newPlog->removePost("THIRD_POST");

echo "<pre>"; print_r($newPlog); echo "</pre>";

?>