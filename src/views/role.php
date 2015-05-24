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
 * @file role.php
 * Webpage with infos and links to ROLE
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
    <link rel="stylesheet" type="text/css" href="../css/da-slider.css" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php 
      include("menu.php");
      require '../config/config.php';
    ?>

    <header id="head" class="secondary">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h1>ROLE</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- container -->
    <section class="container">
        <div class="row">
            <!-- main content -->
            <section class="col-sm-8 maincontent">
                <h3>How to setup the viewing environment</h3>

                <p>
                    <img src="../images/role-full.jpg" alt="" class="img-rounded pull-right" width="300">
                    <p>Setting up the environment for collaborative viewing is really
    easy. If you do it for the first time, you can follow these steps:</p>

                <ol>
                  <li>Create a ROLE space <a href="http://role-sandbox.eu/">here</a></li>
                  <li>Log in (e.g. with your Google account)</li>
                  <li>Add the following widgets in the sidebar on the left</li>
                  <ul>
                <li><?php echo $baseUrl; ?>/src/role/overview.xml</li>
                <li><?php echo $baseUrl; ?>/src/role/model_viewer.xml</li>
                  </ul>
                  <li>Invite others by providing the link to the space (e.g. http://role-sandbox.eu/spaces/spacename)</li>
                  <li>Select a model in the overview</li>
                </ol>

                </ul>

        </div>
        <div style="padding-bottom:10%"></div>
    </section>
    <!-- /container -->
    <?php include("footer.php"); ?>



    <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
    <!-- script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script-->
    <!-- script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script-->
    <!-- script src="../js/jquery.cslider.js"></script -->
    <script src="../js/custom.js"></script>

    <?php
       //Decide if this site is inside a separate widget
       if(isset($_GET["widget"]) && $_GET["widget"] == "true")
       {
           print("<script type='text/javascript' src='../js/overview-widget.js'> </script>");
           print("<script type='text/javascript' src='../js/init-subsite.js'></script>");
       }
    ?>
</body>
</html>
