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
          height:900px;
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
        <a href="root_home.php" >Home</a>
        <a href="administratorslist.php">Administrator</a>
        <a href="fakultieslist.php">Faculties</a>
        <a href="departmentslist.php">Departments</a>
        <a style="margin-right: 20px" href="../../controller/controller.php?method=logout" id="out">Sign out</a>
          <a style="margin-right: 20px" href="#contact" id="username"><?php echo $_SESSION['ROOT_NAME'] ?></a>
    </div>

  </div>


<div class="ad">
    <div style="top: 200px ; height:900px; margin-bottom: 80px; " class="tabblecontainer" id="form"   >
       <form  action="../../controller/controller.php?method=addadmin" method="POST" enctype="multipart/form-data" id="formid" >  
         <div style="margin: 25px;">
            <h3 style="color:#006699 ;user-select:none">New Administrator:</h3>
            <label style="user-select:none">Fname:</label>
            <input  name="fname" type="text"  placeholder="Fname" id="fname" required>
          <br>
            <label style="user-select:none">Lname:</label>
             <input  name="lname" type="text"  placeholder="Lname" id="lname" required>
           <br>
             <label style="user-select:none">Email:</label>
            <input  name="email"  type="email" placeholder="Email" id="email" required>
           <br>
            <label style="user-select:none">Password:</label>
            <input  name="Password"  type="Password" placeholder="Password" id="Password" required>
           <br>
            <label style="user-select:none">Id:</label>
            <input  name="tc"  type="number" placeholder="Id" id="tc" required>
           <br>
            <label style="user-select:none">Tel:</label>
            <input  name="tel"  type="number" placeholder="Tel" id="tel" required>
           <br>
            <label style="user-select:none">Birth date:</label>
            <input name="birthday" type="date" placeholder="Birth date" id="birthday" required>
           <br>
            <label style="user-select:none">Adress:</label>
            <input  name="adress"  type="text" placeholder="Adress" id="adress" required>
           <br>
            <label style="user-select:none ;">Gender:</label><br>
            <label style="user-select:none ;font-weight: normal;" >Male : </label>
            <input style="width: 10px;" checked="checked" type="radio" name="gender" value="male" id="male" required><br>
            <label style="user-select:none ;font-weight: normal;">Female:</label>
            <input style="width: 10px;"  type="radio" name="gender" value="female" id="female" required ><br>
           <br>
           <br>
          <button  type="submit" style="position: static;float: right;" >&#10004;</button>
         </div>
       </form>
    </div>

 </div> 
 <script type="text/javascript">

  $(document).ready(function(){
    var url = new URL(window.location.href);
    var adminId = String(url.searchParams.get("adminId"));
    var adminName = String(url.searchParams.get("adminName"));
    var adminSurname = String(url.searchParams.get("adminSurname"));
    var adminEmail = String(url.searchParams.get("adminEmail"));
    var adminTC = String(url.searchParams.get("adminTC"));
    var adminTel = String(url.searchParams.get("adminTel"));
    var adminBirthdate = String(url.searchParams.get("adminBirthdate"));
    var adminAddress = String(url.searchParams.get("adminAddress"));
    
    var method =String(url.searchParams.get("method"));
    if(method=="update"){
      $(fname).val(adminName);
      $(lname).val(adminSurname);
      $(email).val(adminEmail);
      $(tc).val(adminTC);
      $(tel).val(adminTel);
      $(birthday).val(adminBirthdate);
      $(adress).val(adminAddress);
      $('#formid').attr('action', '../../controller/controller.php?method=updateadmin&adminId='+adminId+'');
    }
  });

 
 </script>

  </body>
</html>


