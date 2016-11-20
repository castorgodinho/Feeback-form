<?php
ob_start();
if (!isset($_SESSION['name']) && empty($_SESSION['name'])) {
echo "Please log in to access these rights! <script> window.location='http://www.fossclubgoa.com/chowgulefossclub/feedbackproject/feedback_login.php'; </script>";
}
  include "con.php";
  if(isset($_POST) && sizeof($_POST)){
    $id = $_POST['id'];
    $result = $con->query("select count(*) from questions where q_id=$id;");
    if($row = $result->fetch_assoc()){
      echo "Error. Question cannot be deleted since it has already been answered";
    }else{
      $result = $con->query("delete from questions where q_id=$id;");
      echo "Question Deleted";
    }
  }
?>
