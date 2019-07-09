<?php
    session_start();
    if($_SESSION['TEACHER_NAME']==null){
        header("location:/yazilim_projesi/index.php");
    }
?>
<!DOCTYPE html>
<html>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <head>
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/css1.css">
  </head>

  <style type="text/css">
    body {
      font-family: Arial, Helvetica, sans-serif;user-select: none;
      background-image: url("imgs/Grad1.jpg");
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
      width:35%;
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
      <a href="teachersubjectlist.php" >My subject</a>
      <a href="#faculties">My students</a>
      <a style="margin-right: 20px" href="../../controller/controller.php?method=logout" id="out">Sign out</a>
      <a style="margin-right: 20px" href="#" id="username"><?php echo $_SESSION['TEACHER_NAME'] ?></a>
    </div>

  </div>

  <div id ="topbtn">
      <div class="search"  href="addadministrator.html"  style="float: right;">
        <b style="float: left;margin-left: 10px;  margin-right: 5px;user-select: none;">Search :</b>
        <input id="search" type="text" name="search" placeholder="Write to Search">
      </div>
  </div>

  <div style="margin-top:100px ; height: 100%; margin-bottom: 80px; " class="tabblecontainer"  style="overflow-x:auto;width: 900px;" >

    <div class="tablecontainer" style="margin: 20px;">
      <table id="table">
        <h3 style="color:#006699 ;margin-bottom: 5px;margin-left:20px;user-select:none"> - subjects Name : Database</h3>
        <h3 style="color:#006699 ;margin-bottom: 5px;margin-left:20px;user-select:none"> - subjects kod  : asd55</h3>
        <h3 style="color:#006699 ;margin-bottom: 5px;margin-left:20px;user-select:none"> - Number of students : 33</h3>
        <h3 style="color:#006699 ;margin-bottom: 5px;margin-left:20px;user-select:none"> - mid : 60</h3>
        <thead>
            <tr>
            <th  style="background-color: #ff6666 ;color:white">Student ID</th>
            <th class="thh" style="background-color: #ff6666 ;color:white">Student Name</th>
            <th class="thh" style="background-color: #ff6666 ;color:white">Student Surname</th>
            <th class="thh" style="background-color: #ff6666 ;color:white">Mid Term</th>
            <th class="thh" style="background-color: #ff6666 ;color:white">Final Term</th>
            <th  style="background-color: #ff6666 ;color:white">Average</th>
            <th  style="background-color: #ff6666 ;color:white">status</th>
            <th  style="background-color: #ff6666 ;color:white">Action</th>
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
    function list(){
        var url = new URL(window.location.href);
        var subjectId = String(url.searchParams.get("id"));
        console.log(subjectId);
        var param = $('#search').val();
        $("#table tbody").remove();
        $.get("../../controller/controller.php?method=list_studentSubject&id="+subjectId+"&t_id="+<?php echo $_SESSION['TEACHER_ID']?>+"&param="+param, function(data){
            var duce = jQuery.parseJSON(data);
            var size = duce[0];
            for(var i=1;i<=size;i++){
                rates = JSON.parse(duce[i]);
                var average = (rates.midTerm*0.4)+(rates.finalTerm*0.6);
                console.log(rates.studentName);
                $('#table').append(
                    '<tbody> <tr>'+
                        '<td >'+rates.studentId+'</td>'+
                        '<td class="examtd">'+rates.studentName+'</td>'+
                        '<td class="examtd">'+rates.studentSurname+'</td>'+
                        '<td class="examtd"><input type="text" name="exam" id="mid_'+rates.subjectId+rates.studentId+'" placeholder="Mid Not" value="'+rates.midTerm+'"></td>'+
                        '<td class="examtd"><input type="text" name="exam" id="final_'+rates.subjectId+rates.studentId+'" placeholder="Final Not" value="'+rates.finalTerm+'"></td>'+
                        '<td id="average_'+rates.subjectId+rates.studentId+'">'+average+'</td>'+
                        '<td >'+rates.subjectStatus+'</td>'+
                        '<td class="cklicsubject" onclick="update_grade(this, '+rates.subjectId+', '+rates.studentId+')"><a>Update</a></td>'+
                    '</tr> </tbody>'
                );
            }
        });
    } 
    function update_grade(row, sub_id, stu_id) {
        var mid_term = document.getElementById('mid_'+sub_id+stu_id).value,
            final_term = document.getElementById('final_'+sub_id+stu_id).value;
            console.log(mid_term);
            console.log(final_term);
        //ajax
        $.ajax({
            url: "../../controller/controller.php" ,
            data:{subjectId:sub_id , studentId:stu_id, midGrade:mid_term, finalGrade:final_term, method:'update_grade'}, 
            async: true,
            success: function(result){
                document.getElementById('average_'+sub_id+stu_id).innerHTML = (mid_term*0.4)+(final_term*0.6);
                alert("Updated Successfully !");
            }});
    }
  </script>

</body>
</html>
