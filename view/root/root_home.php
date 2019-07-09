<?php
  session_start();
  if($_SESSION['ROOT_NAME']==null){
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
          <a href="root_home.php" style="background-color: #0066cc;">Home</a>
          <a href="administratorslist.php">Administrator</a>
          <a href="fakultieslist.php">Faculties</a>
          <a href="departmentslist.php">Departments</a>
          <a style="margin-right: 20px" href="../../controller/controller.php?method=logout" id="out">Sign out</a>
           <a style="margin-right: 20px" href="#contact" id="username"><?php echo $_SESSION['ROOT_NAME'] ?></a>
      </div>
    </div>

    <div id ="homeadminlist">
      <a href="addadministrator.php" >Add Administrators</a>
      <a href="addfakulty.php"  >Add Faculties</a>
      <a href="adddepartment.php">Add Departments</a>
    </div>
  </body>
  
</html>
