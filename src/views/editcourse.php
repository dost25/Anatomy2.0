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
 * @file editcourse.php
 * Webpage for editing a single course.
 */
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv='X-UA-Compatible' content='IE=edge' charset='utf8'/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Your Course</title>

    <link type='text/css' rel='stylesheet' href='http://www.x3dom.org/download/x3dom.css'> </link>
    <link rel='stylesheet' type='text/css' href='../css/model_viewer.css'></link>
    <link rel='stylesheet' type='text/css' href='../css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='../css/style.css'>
    <link rel="stylesheet" href="../css/editcourse.css">
  </head>

  <body>
    <?php 
      //Decide if this site is inside a separate widget
      if(isset($_GET["widget"]) && $_GET["widget"] == "true")
      {
          print("<script type='text/javascript' src='../js/model-viewer-widget.js'> </script>");
          print("<script type='text/javascript' src='../js/init-subsite.js'></script>");
      }
      include("menu.php"); 
      include "../php/db_connect.php";
      include '../php/tools.php';

      if (isset($_SESSION['user_id'])) {
        $query  = $db->query("SELECT * FROM courses WHERE id = $_GET[id]");
        $entry = $query->fetchObject();
        $arg = $_GET["id"];
      }

      // If the user is not logged in or he is not the creator, redirect him to the login page
      if(!isset($entry->creator) || $entry->creator != $_SESSION['user_id']) { 
        header("Location: login.php");
        exit();
      }
    ?>
    
    <header id='head' class='secondary'>
    <div class='container'>
      <div class='row'>
          <h1>Edit Your Course</h1>
      </div>
    </div>
    </header>

    <div id='courses'>
      <section class='container'>
        <br><br>
      <div class='container'>
        <div class='row'>
          <div class='col-md-4'>
            <br><br>
            <form role="form" action="../php/edit_script_course.php<?php if(isset($_GET['widget']) && $_GET['widget'] == true) {echo '?widget=true';} ?>" method="post" enctype="multipart/form-data" id="UploadForm">              
              <div class="form-group">
                <input type="hidden" name="targetId" value="<?php echo $arg; ?>">
                <label for="targetName">Your Course Name</label>
                <input type="text" class="form-control" rows="1" name="name" id="targetName" value="<?php echo htmlentities($entry->name); ?>" required>
              </div>
            
              <div class='featured-box'>
                <div class="form-group">
                  <label for="targetText">Link to the Preview Image of your Course</label>
                  <textarea class="form-control" rows="1" name="previewImgLink" id="targetImgLink"><?php echo $entry->img_url; ?></textarea>
                </div>
                <br>
                <div class="form-group">
                  <label for="targetText">Link to your course space in ROLE</label>
                  <input type="text" class="form-control" rows="1" name="roleLink" id="targetRole" value="<?php echo $entry->role_url; ?>">
                </div> </br>

                <div class="form-group">
                  <label for="targetText">Description of your Course</label>
                  <textarea class="form-control" rows="3" name="text" id="targetText"><?php echo htmlentities($entry->description) ?></textarea>
                </div>
              </div>
              <button type="submit" class="btn btn-default" id="SubmitButton" value="Upload">Submit</button>
            </form>
            <br>
          </div> 

          <div class='col-md-8'>
            <div><h3>Models</h3></div>
            <!-- Buttons to create add and upload models -->
            <button class='btn btn-success' type='button' id="openbox" onclick="startBlackout()">Add</button>
            <a href="upload.php" target="blank"><button class='btn btn-success' type='button'>Upload</button></a>
          
            <br><br>
        
      <div id="model_table">
      <?php 
        $query = $db->query("SELECT * 
                             FROM course_models
                             INNER JOIN models ON course_models.model_id = models.id
                             WHERE course_models.course_id = $arg");
        $result = $query->fetchAll();

        $html = createTable($result,"modeldeletion");
        echo $html;
      ?>
      </div>
           
          </div>
        </div>
      </div>  
      </section>
    </div>
    <!-- container -->

      
    </div>

    <!-- Darken background when model select window appears -->
    <div id="blackout" onclick="endBlackout()"></div>

    <!-- Show models in a pop-up -->
    <div id="modelbox">
      <div id="closebox" onclick="endBlackout()">close</div>
      <button class='btn btn-success' type='button' id="addmodels" onclick="addModels()">Add models to course</button>
      <?php include("search.php"); ?>
      <div id="result-container">
      <!-- Models will be inserted here -->
      </div>
    </div>
  
    
    <?php include("footer.php");?>
    
    <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
    <!-- X3Dom includes -->
    <script type='text/javascript' src='../js/x3dom.js'> </script>
    <script type='text/javascript' src='../js/x3d-extensions.js'> </script>
    <script type='text/javascript' src='../js/viewer.js'> </script>
    <script src="../js/ajax.js"></script>
    <script src="../js/editcourse.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/tools.js"></script>
  </body>
</html>
