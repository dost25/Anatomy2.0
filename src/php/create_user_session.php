<?php

/* 
 * Copyright 2015 Adam Brunnmeier, Dominik Studer, Alexandra Wörner, Frederik Zwilling, Ali Demiralp, Dev Sharma, Luca Liehner, Marco Dung, Georgios Toubekis
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *  http://www.apache.org/licenses/LICENSE-2.0
 * 
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 * 
 *  @file create_user_session.php
 *  Reads user data. Saves user data in session variables. If the user is not 
 *  yet known in our database or not up-to-date, the database entry is 
 *  created/updated.
 */
  include 'user_management.php';
  require_once 'authorization.php';

  $confirmed = 0;
  $access_token = filter_input(INPUT_POST, 'access_token');
  
  if (isset($access_token) && $access_token != 'null') {

		// Setup session and cache access_token as login-validation, also for other pages      
    session_start();
    
    // Store which type of login service is used for authentication
    // Currently only the 'LearningLayers' service is supported
    $_SESSION['service_type'] = filter_input(INPUT_POST, 'service_type');
		$_SESSION['access_token'] = $access_token;
    
    $authorization = new Authorization();
    $userProfile = $authorization->getUserProfile();
    
		//from fake login:
		$_SESSION['sub'] = $userProfile->sub;
		$_SESSION['email'] = $userProfile->email;
		// fake_end		
      
    ////// Search database for user and create new entry if it doesn't have      
    require '../php/db_connect.php';
    $userManagement = new UserManagement();
    // FIRST OF ALL, CHECK WHETHER THE USER IS KNOWN TO THE SYSTEM
    // THIS IS DONE BY CHECKING WHETHER THE UNIQUE OPEN ID CONNECT SUB EXISTS IN OUR DATABASE
    $user = $userManagement->readUser($userProfile->sub);

    // If $user is empty, the user is not known
    if(!$user) {
      $userManagement->createUser($userProfile);
    } else {
      // TODO: update in database: user-email, name, first name, etc.
    }
    
    echo 'orig token '.$access_token;
    echo 'service '.$_SESSION['service_type'];
    echo 'token '.$_SESSION['access_token'];
  }
  else {
    echo 'no token '. $access_token;
  }