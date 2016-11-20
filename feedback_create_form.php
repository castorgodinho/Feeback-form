  <?php
  session_start();
  ob_start();
  if (!isset($_SESSION['name']) && empty($_SESSION['name'])) {
    echo "Please log in to access these rights! <script> window.location='http://www.fossclubgoa.com/chowgulefossclub/feedbackproject/feedback_login.php'; </script>";
  }
include 'con.php';
if(isset($_POST) && sizeof($_POST)){
  $name = $_POST['form_name'];
  $result = $con->query("insert into form values(null, '$name', current_date)");
  $result = $con->query("select * from form where form_name='$name'");
  $row = $result->fetch_assoc();
  $id = $row['f_id'];
  $question = $_POST['questions'];
  $type = $_POST['type'];
  foreach( $question as $key => $questionValue ) {
    $con->query("insert into questions values(null, '$questionValue', '".$type[$key]."', $id)");
  }
  echo "<script>alert(\"Form created\");</script>";
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
  <title>Create Form</title>
  <script>
  $(document).ready(function(){
    $(document).on('click', '.remove', function(){
      $(this).parent().parent().remove();
    });
    $(".add_question").click(function(){
      $('.question-set').append('<div class="row question">\
      <div class="col-md-2">\
      <select class="" name="type[]">\
      <option>General Question</option>\
      <option>Informative Question</option>\
      </select>\
      </div>\
      <div class="col-md-8">\
      <input type="text" class="form-control"  name="questions[]" placeholder="Sessions" required/>\
      </div>\
      <div class="col-md-2">\
        <span class="glyphicon glyphicon-remove remove"></span>\
      </div>\
      </div>');
    });


  });
  </script>
  <style>
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
  <?php
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
          <li class="active"><a href="feedback_create_form.php">Create Form <span class="sr-only">(current)</span></a></li>
          <li><a href="feedback_viewAllForms.php">Edit Form</a></li>
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
          <h1>Create New Online Form</h1>
          <h3 style="text-shadow: none;">"Analog is more beautiful than digital, really, but we go for comfort."</h3>
        </div>
      </div>
      <div class="print">

      </div>
      <button style="margin-bottom: 20px;" class="btn btn-primary add_question">Add Question</button>
      <form action="" method="POST">
        <div class="row">
          <div class="col-md-6">
              <label class="control-label">Form Name: </label> <input type="text" class="form-control" name="form_name" placeholder="Enter form name" required/>
          </div>
          <div class="col-md-3">

          </div>
        </div>
        <div class="question-set">

          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="Achievement of objectives" placeholder="Enter the question here" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="Structure / Organisation of the Programme " placeholder="Enter the question here" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="Course Content" placeholder="Enter the question here" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="Classroom exercises" placeholder="Enter the question here" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="Lecture" placeholder="Enter the question here" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="Audio-Visuals" placeholder="Enter the question here" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="Classroom Facilities" placeholder="Enter the question here" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="Cleanliness in class/institute" placeholder="Enter the question here" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="Food & refreshments" placeholder="Enter the question here" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="Attention of the Course Director " placeholder="Enter the question here" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="Informative Question">Informative Question</option>
                <option value="General Question">General Question</option>

              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="Sessions which interested you the most and why?" placeholder="Enter the question here" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="Informative Question">Informative Question</option>
                <option value="General Question">General Question</option>

              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="Will the course help you to improve your job" placeholder="Enter the question here" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="" placeholder="Sessions" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="" placeholder="Sessions" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="" placeholder="Sessions" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>
          <div class="row question">
            <div class="col-md-2">
              <select class="" name="type[]">
                <option value="General Question">General Question</option>
                <option value="Informative Question">Informative Question</option>
              </select>
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="questions[]" value="" placeholder="Sessions" required/>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon-remove remove"></span>
            </div>
          </div>



        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <button class="btn btn-primary btn-block create_form">Create form</button>
          </div>
          <div class="col-md-4"></div>
        </div>
      </form>
    </div>

  </div>
</body>
</html>
