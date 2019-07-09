<?php

?>

<!DOCTYPE html>
<html>
 <head>
    <link rel="stylesheet" href="view/admin/css/csslogin.css">
  </head>
<style type="text/css">
body {
  font-family: Arial, Helvetica, sans-serif;user-select: none;
  background-image: url("view/admin/imgs/Grad1.jpg");
  height: 100%; 
  background-position: top;
  background-repeat: no-repeat;
  background-size: cover;
}
@media only screen and (max-width: 1100px) {
  body {
    font-family: Arial, Helvetica, sans-serif;user-select: none;
    background-size:  auto auto  ;
    background-repeat: no-repeat;
    user-select: none;
  }

}
</style>

<body>

<div class="loginconti">

  <div class="homeimgcon" >
      <img src="view/admin/imgs/logo1.png" alt="Avatar"  class="imgavatarlogo" >
  </div>

  
<div class="logincontainer">
  <form class="loginform" action="./controller/controller.php?method=login" method="POST" enctype="multipart/form-data"  >
    
      <label for="uname"><b>User ID</b></label>
      <input type="text" id="ID" placeholder="Enter ID" name="ID" required>

      <label for="psw"><b>Password</b></label>
      <input type="password"  id="password" placeholder="Enter Password" name="password" required>
          
      <button class="loginbtn" type="submit">Login</button>
      <div>
        <label>
          <input type="radio" checked="checked" id="student" name="radio" value="2"> <b>student</b>
          <input type="radio"  id="teacher" name="radio" value="1"> <b>teacher</b>
          <input type="radio" id="admin" name="radio" value="0"> <b>admin</b>
        </label>
      </div>
    
  </form>
</div>
</div>

</body>

</html>
