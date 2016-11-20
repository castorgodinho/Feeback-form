<?php
ob_start();
if (!isset($_SESSION['name']) && empty($_SESSION['name'])) {
echo "Please log in to access these rights! <script> window.location='http://www.fossclubgoa.com/chowgulefossclub/feedbackproject/feedback_login.php'; </script>";
}
include 'con.php';
if(isset($_POST) && sizeof($_POST)){
  $updateValue = $_POST['updateQues'];
  $id = $_POST['qid'];
  $con->query("update questions set question='$updateValue' where q_id=$id;");
}
$f_id = $_GET['id'];
$result = $con->query("select * from questions where form_id=$f_id;");
?>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/create_form.css" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link rel="stylesheet" href="css/default.css"/>
  <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
  <title>Edit Form</title>
  <script>
  $(document).ready(function(){
    $("#prompt").hide();
    $(".edit").click(function(){
      $(".cover").addClass("myClass");
      $("#prompt").slideDown(200);
      $("#updateValue").attr("value", $(this).attr("data-value"));
      $("#qid").attr("value", $(this).attr("data-id"));
      $(".cancel").click(function(){
        $(".cover").removeClass("myClass");
        $("#prompt").hide();
      });
    });
    $(".remove").click(function(){
      var id = $(this).attr("data-value");
      if(window.confirm("Are you sure?")){
        $.ajax({
          method: "POST",
          url: "feedback_delete_question.php",
          data: {id: $(this).attr("data-value")},
          success: function(data){
            alert(data);
            location.reload();
          }
        });
      }
    });
  });
  </script>
  <style>
  .myClass{
    opacity: 0.4;
  }
  #prompt{
    opacity: 1;
    position: absolute;
    background-color: white;
    top: 20px;
    right: 40%;
    padding: 10px;
    border-radius: 5px;
    -webkit-box-shadow: 0px 0px 26px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 26px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 26px 0px rgba(0,0,0,0.75);
  }
  label{
    font-size: 20px;
  }
  span{
    color: red;
  }
  span:hover{
    cursor: hand;
    cursor: pointer;
  }
  .create_form{
    margin: 20px;
  }
  .heading{
    margin-bottom: 50px;
    text-align: center;
    text-shadow: 2px 2px #d75240;
    border-bottom: 2px solid #d75240;
    padding-bottom: 20px;
  }
  </style>
</head>
<body>
  <div class="cover">
    <?php
      session_start();
      if(isset($_SESSION['name'])){
    ?>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="feedback_create_form.php">Create Form <span class="sr-only">(current)</span></a></li>
            <li class="active"><a href="feedback_viewAllForms.php">Edit Form</a></li>
            <li><a href="feedback_report.php">Generate Reports</a></li>
            <li><a href="feedback_view_forms.php">Check Feedback</a></li>
            <li><a href="feedback_fill_form.php">View Forms</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="feedback_logout.php">Log out</a></li>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <?php
  }else{
    ?>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="feedback_fill_form.php">View Forms</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="feedback_login.php">Log in</a></li>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <?php
  }
    ?>
    <div class="container">
      <div class="content">
        <div class="row heading">
          <div class="col-md-3">
            <img src="img/build.png" class="img-responsive" />
          </div>
          <div class="col-md-9">
            <h1>Control Panel - Editing Form </h1>
              <h3 style="text-shadow: none;">"Analog is more beautiful than digital, really, but we go for comfort."</h3>
          </div>
        </div>
        <table class="table">
          <tr>
            <th>Question</th>
            <th></th>
          </tr>


          <?php
            while($row = $result->fetch_assoc()){
              echo "<tr>
                <td>".$row['question']."</td>
                <td><span class=\"glyphicon glyphicon-remove remove\" data-value=\"".$row['q_id']."\"> </span></td>
                <td><span class=\"glyphicon glyphicon-pencil edit\" data-id=\"".$row['q_id']."\" data-value=\"".$row['question']."\"></span></td>
              </tr>";
            }
          ?>

        </table>

      </div>
    </div>
  </div>


</body>
<div id="prompt">
  <form action="" method="POST">
    <h3>Edit</h3>
     <input type="text" value="" id="updateValue" name="updateQues" />
     <input type="hidden" id="qid" name="qid" value="" />
     <button class="btn btn-primary update">Update</button> <span style="position: absolute; top: 5px; left: 5px;" class="glyphicon glyphicon-remove cancel"></span>
  </form>
</div>
</html>
