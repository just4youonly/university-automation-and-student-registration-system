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

  <style >
    @keyframes myChangee {
      from {
          height: 0px;
      } to {
          height:300px;
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
    .input{
      width:100%;
      margin: 10px;
      padding: 5px;
    }
  </style>

  <body  style="margin: 0px" style="user-select: none;" >

    <div class="hcon" style="border: 2px solid ;user-select: none;">

      <div class="imgcontainer">
         <img class ="img" src="imgs/logo2.png" alt="logo" >
      </div>

      <div class="topnav">
          <a href="root_home.php ">Home</a>
          <a href="administratorslist.php">Administrator</a>
          <a href="fakultieslist.php">Faculties</a>
          <a href="departmentslist.php">Departments</a>
          <a style="margin-right: 20px" href="../../controller/controller.php?method=logout" id="out">Sign out</a>
            <a style="margin-right: 20px" href="#contact" id="username"><?php echo $_SESSION['ROOT_NAME'] ?></a>
      </div>

    </div>

    <div style="top: 200px ; height:300px; margin-bottom: 75px; " class="tabblecontainer" id="form" >

       <form action="../../controller/controller.php?method=adddepartment" method="POST" enctype="multipart/form-data"  id="formid">  
         <div style="margin: 25px;">
            <h3 style="color:#006699 ;user-select:none">New department:</h3>
            <br>
            <label style="user-select:none">Department name:</label>
            <input  name="fname" type="text"  placeholder="Department name" id="Dname" required>
          <br>
            <label style="user-select:none">Fakulty:</label>
            <select name="facultyName" placeholder="Fakulty" id="facultyName" class="input">
              
            </select>
          <br>
          <br>
          <br>
          <button  type="submit" style="position: static;float: right;" >&#10004;</button>
         </div>
       </form>

    </div>

<script type="text/javascript">





$(document).ready(function(){

  var url = new URL(window.location.href);
  var departmentId = String(url.searchParams.get("departmentId"));
  var departmentName = String(url.searchParams.get("departmentName"));
  var facultyName1 = String(url.searchParams.get("facultyName"));
  var method =String(url.searchParams.get("method"));
  var valueid=0;

  var rates ;
  $.get("../../controller/controller.php?method=listfaculties", function(data){
    var duce = jQuery.parseJSON(data);
    var size = duce[0];
    for(var i=1;i<=size;i++){
      rates = JSON.parse(duce[i]);
      if(facultyName1==rates.facultyName){
        valueid=rates.facultyId;
      }
      $('#facultyName').append(
        '<option id="ad" value="'+rates.facultyId+'">'+i+" - "+rates.facultyName+'</option>'
      );
      document.getElementById("facultyName").value = valueid ;
    }
  });
  if(method=="update"){
    document.getElementById('Dname').value = departmentName;
    $('#formid').attr('action', '../../controller/controller.php?method=updatedepartment&departmentId='+departmentId);
  }
});
</script>
  </body>
</html>
