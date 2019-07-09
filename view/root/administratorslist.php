
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
    .deleteeditbtn{
      user-select:none;
      background-color: #cceeff;
      border-radius:10px 20px;
      text-align: center;
      color: #006699;
      padding-left: 15px;
      padding-right: 15px;
      padding-bottom: 15px;
      padding-top: 15px;
    }
    @media only screen and (min-width: 1500px) {
      .deleteeditbtn{
        padding-bottom: 12px;
        padding-top: 7px;
      }
    }
  </style>



<body  >
  <div  style="border: 2px solid ;user-select: none;">

    <div class="imgcontainer">
      <img class ="img" src="imgs/logo2.png" alt="logo" >
    </div>

    <div class="topnav">
      <a href="root_home.php ">Home</a>
      <a href="administratorslist.php" style="background-color: #0066cc">Administrator</a>
      <a href="fakultieslist.php">Faculties</a>
      <a href="departmentslist.php">Departments</a>    
      <a style="margin-right: 20px" href="../../controller/controller.php?method=logout" id="out">Sign out</a>
      <a style="margin-right: 20px" id="username"><?php echo $_SESSION['ROOT_NAME'] ?></a>
    </div>

  </div>

  <div id ="topbtn">
    <a id="addadministrator"  href="addadministrator.php"  style="float: left;">Add Administrator</a>.
      <div class="search"  href="#"  style="float: right;">
        <b style="float: left;margin-left: 10px;  margin-right: 5px;user-select: none;">Search :</b>
        <input id="search" type="text" name="search" placeholder="Write to Search">
      </div>
  </div>

  <div style="margin-top:100px ; height: 100%; margin-bottom: 80px;" style="overflow-x:auto;width: 900px;" class="tabblecontainer"  >

    <div class="tablecontainer" style="margin: 20px;">
      <table id="table"> 
        <h3 style="color:#006699 ;margin-bottom: 5px;margin-left:20px;user-select:none"> - Administrators List :</h3> 
        <thead>
        <tr>
          <th  id="delete_edit" style="background-color: #ff6666 ;color:white"> </td>
          <th  id="delete_edit" style="background-color: #ff6666 ;color:white"> </td>
          <th  style="background-color: #ff6666 ;color:white">ID</th>
          <th  style="background-color: #ff6666 ;color:white">Fname</th>
          <th  style="background-color: #ff6666 ;color:white">Lname</th>
          <th  style="background-color: #ff6666 ;color:white">Password</th>
          <th  class="thh" style="background-color: #ff6666 ;color:white;">Email</td>
          <th  style="background-color: #ff6666 ;color:white">Identity</th>
          <th  style="background-color: #ff6666 ;color:white">Tel</td>
          <th  style="background-color: #ff6666 ;color:white ;width: 20%;">Birh Date</th>
          <th  class="thh" style="background-color: #ff6666 ;color:white " >Address</th>
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
    $.ajax({url: "../../controller/controller.php" ,data:{adminId:id , method:'admindelete'}, async: true, success: function(result){}});
}
//ajax
function list(){
  var param = $('#search').val();
    $("#table tbody").remove();
    $.get("../../controller/controller.php?method=searchadmin&param="+param+"", function(data){
      var duce = jQuery.parseJSON(data);
      var size = duce[0];
      for(var i=1;i<=size;i++){
         rates = JSON.parse(duce[i]);
         $('#table').append(
            '<tbody> <tr>'+
              '<td id="delete_edit" onclick="delete_row(this,'+rates.adminId+')"><a class="deleteeditbtn">delete</a></td>'+
              '<td id="delete_edit" ><a class="deleteeditbtn" href="addadministrator.php?method=update&adminId='+rates.adminId+'&adminName='+rates.adminName+'&adminSurname='+rates.adminSurname+'&adminEmail='+rates.adminEmail+'&adminTC='+rates.adminTC+'&adminTel='+rates.adminTel+'&adminBirthdate='+rates.adminBirthdate+'&adminAddress='+rates.adminAddress+'" >edit</a></td>'+
                '<td >'+rates.adminId+'</td>'+
                '<td >'+rates.adminName+'</td>'+
                '<td >'+rates.adminSurname+'</td>'+
                '<td >'+rates.adminPassword+'</td>'+
                '<td >'+rates.adminEmail+'</td>'+
                '<td >'+rates.adminTC+'</td>'+
                '<td >'+rates.adminTel+'</td>'+
                '<td >'+rates.adminBirthdate+'</td>'+
                '<td >'+rates.adminAddress+'</td>'+
            '</tr> </tbody>'
          );
      }
    });
} 


</script>
</body>


</html>
