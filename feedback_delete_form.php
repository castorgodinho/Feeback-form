<?php
ob_start();
if (!isset($_SESSION['name']) && empty($_SESSION['name'])) {
echo "Please log in to access these rights! <script> window.location='http://www.fossclubgoa.com/chowgulefossclub/feedbackproject/feedback_login.php'; </script>";
}
  if(isset($_POST) && sizeof($_POST)){
    include 'con.php';
    $id = $_POST['id'];
    $result = $con->query("delete from questions where form_id=$id");
    $result = $con->query("delete from form where f_id=$id");
  }
?>
