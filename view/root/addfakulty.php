<?php
  session_start();
  if($_SESSION['ROOT_NAME']==null){
      header("location:/yazilim_projesi/index.php");
}
?>


<!DOCTYPE html>
<html>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <head>
    <link rel="stylesheet" href="css/css.css">
  </head>
  <style type="text/css">
     @keyframes myChangee {
      from {
          height: 0px;
      } to {
          height:250px;
      }
    }
    body {
      font-family: Arial, Helvetica, sans-serif;user-select: none;
      background-image: url("imgs/Grad.jpg");
      height: 100%; 
       background-position: right 85px;
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>

<body>

  <div class="hcon" style="border: 2px solid ;user-select: none;">

    <div class="imgcontainer">
       <img class ="img" src="imgs/logo2.png" alt="logo" >
    </div>

    <div class="topnav">
          <a href="root_home.php">Home</a>
          <a href="administratorslist.php">Administrator</a>
          <a href="fakultieslist.php">Faculties</a>
          <a href="departmentslist.php">Departments</a>
        <a style="margin-right: 20px" href="../../controller/controller.php?method=logout" id="out">Sign out</a>
          <a style="margin-right: 20px" href="#contact" id="username"><?php echo $_SESSION['ROOT_NAME'] ?></a>
    </div>

  </div>


<div class="ad">

    <div style="top: 200px ; height:250px; margin-bottom: 80px; " class="tabblecontainer" id="form"   >

       <form action="../../controller/controller.php?method=addfaculty" method="POST" enctype="multipart/form-data"  id="formid">  
         <div style="margin: 25px;">
            <h3 style="color:#006699 ;user-select:none">New Fakulty:</h3>
            <label style="user-select:none">Fakulty name:</label>
            <input  name="fname" type="text"  placeholder="Fname" id="fname" required>
            <br>    
          <button  type="submit" style="position: static;float: right;" >&#10004;</button>
         </div>
       </form>
       
    </div>

 </div> 

 <script type="text/javascript">


  $(document).ready(function(){
    var url = new URL(window.location.href);
    var facultyId = String(url.searchParams.get("facultyId"));
    var facultyName = String(url.searchParams.get("facultyName"));
    var method =String(url.searchParams.get("method"));
    if(method=="update"){
      $(fname).val(facultyName);
      $('#formid').attr('action', '../../controller/controller.php?method=updatefakulty&facultyId='+facultyId+'');
    }
  });

 
 </script>
  </body>

</html>


