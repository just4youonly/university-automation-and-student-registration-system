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
    body {
      font-family: Arial, Helvetica, sans-serif;user-select: none;
      background-image: url("imgs/Grad.jpg");
      height: 100%; 
      background-position: right 85px;
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>



<body  >
  <div  style="border: 2px solid ;user-select: none;">

    <div class="imgcontainer">
      <img class ="img" src="imgs/logo2.png" alt="logo" >
    </div>

    <div class="topnav">
      <a href="root_home.php ">Home</a>
      <a href="administratorslist.php">Administrator</a>
      <a href="fakultieslist.php">Faculties</a>
      <a style="background-color: #0066cc;" href="departmentslist.php">Departments</a>
      <a style="margin-right: 20px" href="../../controller/controller.php?method=logout" id="out">Sign out</a>
      <a style="margin-right: 20px" id="username"><?php echo $_SESSION['ROOT_NAME'] ?></a>
    </div>

  </div>

  <div id ="topbtn">
    <a id="addadministrator"  href="adddepartment.php"  style="float: left;">Add Department</a>.
      <div class="search"  href="#.html"  style="float: right;">
        <b style="float: left;margin-left: 10px;  margin-right: 5px;user-select: none;">Search :</b>
        <input id="search" type="text" name="search" placeholder="Write to Search">
      </div>
  </div>

  <div style="margin-top:100px ; height: 100%; margin-bottom: 80px; " class="tabblecontainer"  style="overflow-x:auto;width: 900px;" >

    <div class="tablecontainer" style="margin: 20px;">
      <table id="table"> 
      <thead>
        <h3 style="color:#006699 ;margin-bottom: 5px;margin-left:20px;user-select:none"> - Departments List :</h3> 
        <tr>
          <th  id="delete_edit" style="background-color: #ff6666 ;color:white"> </td>
          <th  id="delete_edit" style="background-color: #ff6666 ;color:white"> </td>
          <th  style="background-color: #ff6666 ;color:white">ID</th>
          <th class="thh" style="background-color: #ff6666 ;color:white">Department Name</th>
          <th class="thh" style="background-color: #ff6666 ;color:white">Fakulty Name</th>
         
        </tr>
        <thead>
      </table>
    </div>

  </div>
<script type="text/javascript">

$(document).ready(function(){
  list();
});
$("#search").keyup(function(){
  list();
});
function delete_row(r,id) {
    var i = r.parentNode.rowIndex;
    document.getElementById("table").deleteRow(i);
    //ajax
    $.ajax({url: "../../controller/controller.php" ,data:{departmentId :id , method:'departmentdelete'}, async: true, success: function(result){}});
}
//ajax
function list(){
  var param = $('#search').val();
    $("#table tbody").remove();
    $.get("../../controller/controller.php?method=searchdepartment&param="+param+"", function(data){
      var duce = jQuery.parseJSON(data);
      var size = duce[0];
      for(var i=1;i<=size;i++){
         rates = JSON.parse(duce[i]);
         $('#table').append(
            '<tbody> <tr>'+
              '<td id="delete_edit" onclick="delete_row(this,'+rates.departmentId+')"><a class="deleteeditbtn"   >delete</a></td>'+
              '<td id="delete_edit" ><a class="deleteeditbtn" href="adddepartment.php?method=update&departmentId='+rates.departmentId+'&departmentName='+rates.departmentName+'&facultyName='+rates.facultyName+'" >edit</a></td>'+
              '<td >'+rates.departmentId+'</td>'+
              '<td >'+rates.departmentName+'</td>'+
              '<td >'+rates.facultyName+'</td>'+
            '</tr> </tbody>'
          );
      }
    });
} 

 

</script>
</body>
</html>
