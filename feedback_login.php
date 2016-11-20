<?php
  session_start();
  include 'con.php';
  if(isset($_POST) && sizeof($_POST)){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = $con->query("select * from admin where username='$username'");
    if($row = $result->fetch_assoc()){
      $pass = $row['password'];
      if($password === $pass){
        $_SESSION['name'] = "admin";
        header("location: feedback_create_form.php");
      }else{
        echo "<script>alert(\"Invalid details\");</script>";
      }
    }else {
      echo "<script>alert(\"Invalid details\");</script>";
    }
  }
  $result = $con->query("select * from form;");
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
  <title>Login</title>
  <script>
    $(document).ready(function(){

    });
  </script>
  <style>
    .myClass{
      opacity: 0.5;
    }
    .heading{
      margin-bottom: 50px;
      text-align: center;
    }
    .container a{
      font-size: 20px;
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
    span:hover{
      cursor: hand;
      cursor: pointer;
      color: red;
    }
    span{
      margin-right: 10px;
    }
    .forms{
      margin-top: 10px;
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

  <div class="container">
      <form action="" method="POST">
        <div class="row" style="margin-top: 80px;">
          <div class="col-md-4"></div>
          <div class="col-md-4" style="-webkit-box-shadow: 0px 0px 21px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 21px 0px rgba(0,0,0,0.75);
box-shadow: 0px 0px 21px 0px rgba(0,0,0,0.75); padding: 50px; background-color: white; border-radius: 5px;">
<center><h2>Log in</h2></center><br>
            <input type="text" placeholder="Username/Email" class="form-control" name="username" required/><br>
            <input type="password" placeholder="password" class="form-control" name="password" required/><br>
            <input type="submit" value="Log in" class="btn btn-primary btn-block" />
          </div>
          <div class="col-md-4"></div>
        </div>
      </form>
  </div>
</body>
</html>
