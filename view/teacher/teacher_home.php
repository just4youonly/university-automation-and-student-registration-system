<?php
  session_start();
  if($_SESSION['TEACHER_NAME']==null){
      header("location:/yazilim_projesi/index.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
      <link rel="stylesheet" href="css/css.css">
  </head>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;user-select: none;
      background-image: url("imgs/Grad.jpg");
      height: 100%; 
      background-position: right 85px;
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>


  <body style="">
    <div class="hcon" style="border: 2px solid ;user-select: none;">

      <div class="imgcontainer">
         <img class ="img" src="imgs/logo2.png" alt="logo" >
      </div>

      <div class="topnav">
          <a style="background-color: #0066cc;" href="teacher_home.php">Home</a>
          <a href="teachersubjectlist.php">My subject</a>
          <a href="#faculties">My students</a>
          <a style="margin-right: 20px" href="../../controller/controller.php?method=logout" id="out">Sign out</a>
          <a style="margin-right: 20px" href="#contact" id="username"><?php echo $_SESSION['TEACHER_NAME'] ?></a>
      </div>
    </div>

    <div id ="homeadminlist">
      <a href="teachersubjectlist.php" >View My Subjects</a>
      <a href="addfakulty.html" >View My Students</a>
    </div>
  </body>
  
</html>
