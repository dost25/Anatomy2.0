<?php
/**
 * Copyright 2015 Adam Brunnmeier, Dominik Studer, Alexandra Wörner, Frederik Zwilling, Ali Demiralp, Dev Sharma, Luca Liehner, Marco Dung, Georgios Toubekis
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @file courses.php
 * Webpage for viewing an overview of all existing courses.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Collaborative Viewing of 3D Models </title>
  
  <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/bootstrap-theme.css" media="screen">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <?php include("menu.php"); ?>

  <?php
    //Decide if this site is inside a separate widget
    if(isset($_GET["widget"]) && $_GET["widget"] == "true") {

    }
    else {
      echo '
          <header id="head" class="secondary">
              <div class="container">
                  <div class="row">
                      <div class="col-sm-8">
                          <h1>Courses</h1>
                      </div>
                  </div>
              </div>
          </header>
      ';
    }
  ?>

  <!-- Button to create a new course -->
  <?php if (isset($_SESSION['user_id'])) { ?>
  <div class="container-fluid">
    <div class="row">
      <p><a class="btn btn-primary btn-lg" style="width:100%" href="addcourse.php" role="button">Create New Course</a></p>
    </div>
  </div>
  <?php } ?>

  <!-- Build course table -->
    <div id="table-container">
    <?php
      include '../php/db_connect.php';
      include '../php/tools.php';

      $query  = $db->query("SELECT * FROM courses");
      $result = $query->fetchAll();

      $html = createTable($result,"course");
      echo $html;
    ?>
    </div>
  <!-- /container -->

  <?php include("footer.php");?>

  <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
  <script src="../js/custom.js"></script>
  <?php
    //Decide if this site is inside a separate widget
    if(isset($_GET["widget"]) && $_GET["widget"] == "true")
    {
      print("<script type='text/javascript' src='../js/courses-widget.js'> </script>");
      print("<script type='text/javascript' src='../js/overview-widget.js'> </script>");
      print("<script type='text/javascript' src='../js/init-subsite.js'></script>");
    }
  ?>
</body>
</html>
