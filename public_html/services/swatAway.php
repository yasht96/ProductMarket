<?php
    require_once('../database_credentials.php');
    require_once("../php/utilities.php");
session_start();
if(!isset($_SESSION['username'])){
  header("Location: /php/login.php");
  exit;
}

    $page_name = "Swat Away";
    $visited = false;
    $pages = $_SESSION['bHistory'];
    foreach($pages as $key => $value){
      if($value == $page_name){
        $visited = true;
      }
    }
    if(!$visited){
      array_push($pages, $page_name);
      $_SESSION['bHistory'] = $pages;
    }
    if(isset($_POST['review_text']) && isset($_POST['rating'])) {
      $username = $_SESSION['username'];
      $review_text = $_POST['review_text'];
      $rating = $_POST['rating'];
      addReview($servername, $serverUsername, $serverPassword, $dbname, $username, $review_text, $rating, $page_name);
      }

      incrementNumUsers($servername, $serverUsername, $serverPassword, $dbname, $page_name);
    // require_once("../php/previous_visited_cookies.php");
    // handle_last_five_pages_visited($page_name);
    // handle_most_visited_pages($page_name);
    echo<<<ENDL
    <body>
                <h1><b>Swat Away</b></h1>
                <p>We've teamed up with the leading cognitive scientists in language recognition to
                come up with our SwatAway voice mimicking app.  When needed, imitate the voice recordings of team
                of SWAT officers to scare away the shooter.  Ability to project the voices to a radius of
                10 ft so it seems like it is coming from an unknown corner.  Your shooter will flee!</p>
                <img src='../img/swat.jpg' alt='BP1' height='300' width='300'>
                  </body>
ENDL;
getReviews($servername, $serverUsername, $serverPassword, $dbname, $page_name);

?>
