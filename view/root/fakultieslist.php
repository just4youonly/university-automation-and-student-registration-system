
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
    .thh{
      padding-top: 5px;
      padding-bottom: 5px;
      padding-right: 12px;
      padding-left: 12px;
      background-color: #cceeff;
      border-radius: 5px 20px;
      height: 25px;
      text-align: center;
      user-select:none;
      width: 100%;
      color: #006699;
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
      <a style="background-color: #0066cc;" href="fakultieslist.php">Faculties</a>
      <a href="departmentslist.php">Departments</a>
      <a style="margin-right: 20px" href="../../controller/controller.php?method=logout" id="out">Sign out</a>
      <a style="margin-right: 20px" id="username"><?php echo $_SESSION['ROOT_NAME'] ?></a>
    </div>

  </div>

  <div id ="topbtn">
    <a id="addadministrator"  href="addfakulty.php"  style="float: left;">Add Fakulty</a>.
      <div class="search"  href="#"  style="float: right;">
        <b style="float: left;margin-left: 10px;  margin-right: 5px;user-select: none;">Search :</b>
        <input id="search" type="text" name="search" placeholder="Write to Search">
      </div>
  </div>

  <div style="margin-top:100px ; height: 100%;  margin-bottom: 80px; " style="overflow-x:auto;width: 900px;"  class="tabblecontainer"  >

    <div class="tablecontainer" style="margin: 20px;">
      <table id="table"> 
        <h3 style="color:#006699 ;margin-bottom: 5px;margin-left:20px;user-select:none"> - Fakulties List :</h3> 
        <thead>
        <tr>
          <th  id="delete_edit" style="background-color: #ff6666 ;color:white"> </td>
          <th  id="delete_edit" style="background-color: #ff6666 ;color:white"> </td>
          <th  style="background-color: #ff6666 ;color:white">ID</th>
          <th class="thh" style="background-color: #ff6666 ;color:white">Fakulty name</th>
        </tr>
        </thead>
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
    $.ajax({url: "../../controller/controller.php" ,data:{facultyId:id , method:'fakultydelete'}, async: true, success: function(result){}});
}
//ajax
function list(){
  var param = $('#search').val();
    $("#table tbody").remove();
    $.get("../../controller/controller.php?method=searchfaculty&param="+param+"", function(data){
      var duce = jQuery.parseJSON(data);
      var size = duce[0];
      for(var i=1;i<=size;i++){
         rates = JSON.parse(duce[i]);
         $('#table').append(
            '<tbody> <tr>'+
              '<td id="delete_edit" onclick="delete_row(this,'+rates.facultyId+')"><a class="deleteeditbtn" >delete</a></td>'+
              '<td id="delete_edit" ><a href="addfakulty.php?method=update&facultyId='+rates.facultyId+'&facultyName='+rates.facultyName+'" class="deleteeditbtn" >edit</a></td>'+
              '<td >'+rates.facultyId+'</td>'+
              '<td >'+rates.facultyName+'</td>'+
            '</tr> </tbody>'
          );
      }
    });
} 

</script>
</body>
</html>
