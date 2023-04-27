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

    // Properties of a blog post
    public $title;
    public $content;
    public $date;

    // Constructor to initialize the properties with given values
    public function __construct($t, $c, $d) {
        $this->title = $t;
        $this->content = $c;
        $this->date = $d;
    }

    // Getter method for post title
    public function getTitle()
    {
        return $this->title;
    }

    // Setter method for post title
    public function setTitle($title)
    {
        $this->title = $title;
    }

    // Setter method for post content
    public function setContent($content)
    {
        $this->content = $content;
    }

}

class prsonalBlog{

    // Properties of the personal blog
    public $author;
    public array $blog = [];

    // Constructor to initialize the author name
    public function __construct($name) {
        $this->author = $name;
    }

    // Method to add a new post to blog[]
    public function addPost($t, $c, $d){
        $newPost = new Post($t, $c, $d);
        $this->blog[] = $newPost;
    }

    // Method to remove a post from the blog[]
    public function removePost($title){ 
        $found = false;
        foreach ($this->blog as $key => $post) {
            if ($post->getTitle() == $title) {        // if the Post found
                unset($this->blog[$key]);
                $found = true;
                break;
            }
        }
        // If post not found in the array
        if(!$found) {
            echo "The Post Of Title \"" . $title . "\" Not Found" . "<br>";
        }
    }

    // Method to edit a blog post in the array
    public function editPost($title,$newTitle, $newContent){
        $found = false;
        foreach ($this->blog as $post) {
            if ($post->getTitle() == $title) {      // if the Post found

                $post->setTitle($newTitle);         // Set New Title
                $post->setContent($newContent);     // Set New Content
                
                $found = true;
                break;
            }else{}
        }
        // If post not found in the array
        if(!$found) {
            echo "The Post Of Title \"" . $title . "\" Not Found" . "<br>";
        }
    }
}

// Creating a new personal blog object
$newPlog = new prsonalBlog("Hady");

$newPlog->addPost("FIRST_POST", "You Are Good", "2023-9-01");
$newPlog->addPost("SECOND_POST", "Take good care of your health", date('2022-12-03'));
$newPlog->addPost("THIRD_POST", "Love yourself, love money, and avoid anything else", "2025-07-21");

echo "<pre>"; print_r($newPlog); echo "</pre>";

echo "<hr>";

// Removing a non-existing post
$newPlog->removePost("Fourth");

// Editing a non-existing post
$newPlog->editPost("test", "test", "test");

// Editing an existing post
$newPlog->editPost("FIRST_POST","first_updated", "You Still Good");

// Removing an existing post
$newPlog->removePost("THIRD_POST");

echo "<pre>"; print_r($newPlog); echo "</pre>";

?>