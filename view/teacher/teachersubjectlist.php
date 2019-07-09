<?php
    session_start();
    if($_SESSION['TEACHER_NAME']==null){
        header("location:/yazilim_projesi/index.php");
    }
?>

<!DOCTYPE html>
<html>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-animate.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <head>
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/css1.css">
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
    
    @media only screen and (max-width: 900px) {
      .search{
        height: 40px;
        width:40%;
      }
      #search{
        position: static;
        width:80%;
        top: 30px;
        margin-top:5px;
        margin-left: 10px;
        font-size: 9px;
        padding: 5px;
      }
    }
    
    
  </style>



<body  >
  <div  style="border: 2px solid ;user-select: none;">

    <div class="imgcontainer">
      <img class ="img" src="imgs/logo2.png" alt="logo" >
    </div>

    <div class="topnav">
      <a href="teacher_home.php">Home</a>
      <a href="teachersubjectlist.php" style="background-color: #0066cc;">My subject</a>
      <a href="#faculties">My students</a>
      <a style="margin-right: 20px" href="../../controller/controller.php?method=logout" id="out">Sign out</a>
      <a style="margin-right: 20px" href="#" id="username"><?php echo $_SESSION['TEACHER_NAME'] ?></a>
    </div>

  </div>

  <div id ="topbtn">
      <div class="search"  href="addadministrator.html"  style="float: right;">
        <b style="float: center;margin-left: 10px;  margin-right: 5px;user-select: none;">Search :</b>
        <input id="search" type="text" name="search" placeholder="Write to Search">
      </div>
  </div>

  <div style="margin-top:100px ; height: 100%;  margin-bottom: 80px; " style="overflow-x:auto;width: 900px;"  class="tabblecontainer"  >

    <div class="tablecontainer" style="margin: 20px;">
      <table id="table"> 
        <h3 style="color:#006699 ;margin-bottom: 5px;margin-left:20px;user-select:none"> - My Subjects List:</h3>
        <thead>
        <tr>
          <th  style="background-color: #ff6666 ;color:white">Subject ID</th>
          <th class="thh" style="background-color: #ff6666 ;color:white">Subject Name</th>
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
  //ajax
  function list(){
    var param = $('#search').val();
      $("#table tbody").remove();
      $.get("../../controller/controller.php?method=list_teacherSubject&id="+<?php echo $_SESSION['TEACHER_ID']?>+"&param="+param, function(data){
        var duce = jQuery.parseJSON(data);
        var size = duce[0];
        for(var i=1;i<=size;i++){
          rates = JSON.parse(duce[i]);
          $('#table').append(
              '<tbody> <tr>'+
                '<td >'+rates.subjectId+'</td>'+
                '<td class="cklicsubject"><a href="subjectstudents.php?id='+rates.subjectId+'">'+rates.subjectName+'</a></td>'+
              '</tr> </tbody>'
            );
        }
      });
  } 
  </script>
</body>
</html>
