<?php
ob_start();
if (!isset($_SESSION['name']) && empty($_SESSION['name'])) {
echo "Please log in to access these rights! <script> window.location='http://www.fossclubgoa.com/chowgulefossclub/feedbackproject/feedback_login.php'; </script>";
}
include 'con.php';
if(isset($_POST) && sizeof($_POST)){

}
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
  <script async src="//jsfiddle.net/8ypxW/3/embed/"></script>
  <title>Feedback Report</title>
  <script>

  $(document).ready(function(){
    $(function() {
      $("#btnSave").click(function() {
        $("#report").addClass("whiteClass");
        html2canvas($("#report"), {
          onrendered: function(canvas) {
            var img = canvas.toDataURL("image/jpeg");
            window.open(img);
          }
        });
        $("#report").removeClass("whiteClass");
      });
    });
  });
  </script>
  <style>

  label{
    font-size: 20px;
  }

  .whiteClass{
    color: white;
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
  .eachRow{
    margin: 20px 20px 5px 20px;
    border-bottom: 2px solid #d75240;
  }
  </style>
</head>
<body>
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
            <li ><a href="feedback_viewAllForms.php">Edit Form</a></li>
            <li class="active"><a href="feedback_report.php">Generate Reports</a></li>
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
  <div class="row" style="margin-bottom: 30px;">
    <form action="" method="GET">
      <div class="col-md-3"></div>

      <div class="col-md-6">
        <select name="form_name">
          <?php
          $result = $con->query("select * from form;");
          while($row = $result->fetch_assoc()){
            echo "<option>".$row['form_name']."</option>";
          }
          ?>
        </select>
        <select name="report_type">
          <option>Full form report</option>
          <option>Question report</option>
        </select>
        <input type="submit" value="Generate Report" class="btn btn-primary"/>
      </div>
      <div class="col-md-3">

      </div>
    </form>
  </div>

  <div id="report">

    <?php
    if(isset($_GET) && sizeof($_GET)){
      $display =0;
      $formName = $_GET['form_name'];
      $report_type= $_GET['report_type'];
      $result = $con->query("select * from form where form_name='$formName'");
      $row = $result->fetch_assoc();
      $fid = $row["f_id"];
      $result9 = $con->query("select * from generalAnswers where question_id in (select q_id from questions where form_id=$fid);");
      if($row9 = $result9->fetch_assoc()){
        $result = $con->query("select * from form where f_id=$fid");
        $row = $result->fetch_assoc();
        echo "<div class=\"row heading\">
        <div class=\"row\">
        <div class=\"col-md-12\">
        <h1>".$row['form_name']." Report<h1>
        </div>
        </div>
        </div>";
        if($report_type === "Full form report"){
          $result = $con->query("select DISTINCT(q_id) from questions where form_id=$fid and type != 'Informative Question'");
          while($row = $result->fetch_assoc()){
            $good=0;
            $sat=0;
            $exe=0;
            $id = $row['q_id'];
            $result1 = $con->query("select * from generalAnswers where question_id=$id");
            while($row1 = $result1->fetch_assoc()){
              if($row1['score'] === '3'){
                $exe = $exe +1;
              }else if($row1['score'] === '2'){
                $good = $good +1;
              }else{
                $sat = $sat +1;
              }
            }
            $total = $good + $sat + $exe;
            $pExe = ($exe* 100)/$total;
            $pGood = ($good* 100)/$total;
            $psat = ($sat* 100)/$total;
            $result3 = $con->query("select * from questions where q_id=$id");
            $row3 = $result3->fetch_assoc();
            $question = $row3['question'];
            //echo "For question: $question we have Excellent- $exe Good- $good Satisfactory: $sat in a total of: $total<br>";
            if($display===0){
              echo "<div class=\"row eachRow\">
              <div class=\"col-md-6\" style=\"border-right: 2px solid #d75240;\">
              <div class=\"row\">
              <div class=\"col-md-4\">
              <h3>$question</h3>
              </div>
              <div class=\"col-md-6\">
              $exe/$total voted Excellent<div class=\"progress\">
              <div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"$exe\"
              aria-valuemin=\"0\" aria-valuemax=\"$total\" style=\"width:$pExe%\">
              <span class=\"sr-only\">70% Complete</span>
              </div>
              </div>
              $good/$total voted Good<div class=\"progress\">
              <div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"$good\"
              aria-valuemin=\"0\" aria-valuemax=\"$total\" style=\"width:$pGood%\">
              <span class=\"sr-only\">70% Complete</span>
              </div>
              </div>
              $sat/$total voted Satisfactory<div class=\"progress\">
              <div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"$sat\"
              aria-valuemin=\"0\" aria-valuemax=\"$total\" style=\"width:$psat%\">
              <span class=\"sr-only\">70% Complete</span>
              </div>
              </div>
              </div>
              </div>
              </div>";
              $display = 1;
            }else{
              echo "<div class=\"col-md-6\">
              <div class=\"row\">
              <div class=\"col-md-4\">
              <h3>$question</h3>
              </div>
              <div class=\"col-md-6\">
              $exe/$total voted Excellent<div class=\"progress\">
              <div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"$exe\"
              aria-valuemin=\"0\" aria-valuemax=\"$total\" style=\"width:$pExe%\">
              <span class=\"sr-only\">70% Complete</span>
              </div>
              </div>
              $good/$total voted Good<div class=\"progress\">
              <div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"$good\"
              aria-valuemin=\"0\" aria-valuemax=\"$total\" style=\"width:$pGood%\">
              <span class=\"sr-only\">70% Complete</span>
              </div>
              </div>
              $sat/$total voted Satisfactory<div class=\"progress\">
              <div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"$sat\"
              aria-valuemin=\"0\" aria-valuemax=\"$total\" style=\"width:$psat%\">
              <span class=\"sr-only\">70% Complete</span>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>";
              $display = 0;
            }

          }

          echo "</div>";
          echo "<div class='row'>
          <div class=col-md-12 style='margin-top: 30px;'>
          <center><a href=\"//FreeHTMLtoPDF.com/?convert\" class=\"btn btn-primary\">Download PDF</a></center>
          </div>
          </div>";
        }else{

          $res = $con->query("select * from questions where form_id=$fid and type='Informative Question'");
          $count = 0;
          while($row22 = $res->fetch_assoc()){
            $question = $row22['question'];
            $qid = $row22['q_id'];
            $res2 = $con->query("select * from informativeAnswers where question_id=$qid;");
            if($count===0){
              echo "<div class='row eachRow' >
              <div class='col-md-6' style=\"border-right: 2px solid #d75240;\">
              <h2>$question</h2>";
            }else{
              echo "<div class='col-md-6'>
              <h2>$question</h2>";
            }
            while($row33 = $res2->fetch_assoc()){
              $answer = $row33['feedback'];
              $uid = $row33['user_id'];
              $res3 = $con->query("select * from user where u_id=$uid");
              $row44 = $res3->fetch_assoc();
              $fname = $row44['fname'];
              $lname = $row44['lname'];
              if($answer != ""){
                echo "<h4><b>$fname $lname:</b> $answer</h4>";
              }
            }
            if($count === 0){
              echo "</div>";
              $count=1;
            }else{
              echo "</div></div>";
              $count=0;
            }
          }


          $res = $con->query("select * from questions where form_id=$fid and type='General Question'");
          while($row22 = $res->fetch_assoc()){
            $question = $row22['question'];
            $qid = $row22['q_id'];
            $resCount = $con->query("select count(user_id) as count from questions, generalAnswers where questions.q_id = generalAnswers.question_id and feedback != '' and q_id=$qid;");
            $row = $resCount->fetch_assoc();
            if($row['count']>0){
              $res2 = $con->query("select * from generalAnswers where question_id=$qid;");
              if($count===0){
                echo "<div class='row eachRow' >
                <div class='col-md-6' style=\"border-right: 2px solid #d75240;\">
                <h2>$question</h2>";
              }else{
                echo "<div class='col-md-6'>
                <h2>$question</h2>";
              }
              while($row33 = $res2->fetch_assoc()){
                $answer = $row33['feedback'];
                $uid = $row33['user_id'];
                $res3 = $con->query("select * from user where u_id=$uid");
                $row44 = $res3->fetch_assoc();
                $fname = $row44['fname'];
                $lname = $row44['lname'];
                if($answer != ""){
                  echo "<h4><b>$fname $lname:</b> $answer</h4>";
                }
              }
              if($count === 0){
                echo "</div>";
                $count=1;
              }else{
                echo "</div></div>";
                $count=0;
              }
            }
          }


          if($count===1){
            echo "</div>";
          }
          echo "<div class='row'>
          <div class=col-md-12 style='margin-top: 30px;'>
          <center><a href=\"//FreeHTMLtoPDF.com/?convert\" class=\"btn btn-primary\">Download PDF</a></center>
          </div>
          </div>";

        }
        #---------------------------
      }else{
        echo "<div class='row' style=\"margin: 20px 5px 20px 5px;color: red;\">
        <div class=\"col-md-4\"></div>
        <div class=\"col-md-4\"><i><h4>\"No result found for the  $formName form \" </h4><i></div>
        <div class=\"col-md-4\"></div>
        </div>";
      }
    }

    ?>

  </body>

  </html>
