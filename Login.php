  
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>

   
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
   <link rel="stylesheet" type="text/css" href="amino_cstyle.css"> 
  <script>
    $(document).ready(function () {
    $(".tab").click(function () {
        $(".tab").removeClass("active");
        $(this).addClass("active");
        $("#tabbed-content .tab-content").hide();
        $($(this).attr("href")).show();
    });
}); 
$(document).ready(function () {
    $('.form ul li a').click(function (ev) {
        $('.form ul li').removeClass('selected');
        $(ev.currentTarget).parent('li').addClass('selected');
    });
}); 
  </script>   
  </head>

  <body background="amino.jpg">
    <div class="header display_inline height1 color_head1">
        <div class="header_sub1"><img src="usc.jpg" id="usc_img"></div>
           <div class="header_sub2">
                <ul class="menu">
                <li>About &nbsp; </li>
                <li>&nbsp; | &nbsp; </li>
                <li>&nbsp; Search</li>
                <li>&nbsp; | &nbsp; </li>
                <li>&nbsp; Contact</li>
            </ul>
            </div>
    </div>
    <div class="style_head2">
        <p id="head2_norris" class="color_white"><span id="color_yellow">USC</span> Norris Comprehensive Cancer Center</p>
        <p id="head2_keck" class="color_white">Keck Medicine of <span id="color_yellow">USC</span></p>
    </div>
    <div id="member_login" class="header menu_style color_white">
        > Member Login to your account
    </div>
    <br>
    <div class="form" id="loginform">
      <ul class="tab-group">
        <li><a href="#login" class="tab">Login</a></li>
        <li><a href="#signup" class="tab">Sign Up</a></li>
      </ul>
      <div id="tabbed-content">
        <div id="login" class="tab-content">
          <form action="" method="post">
            <div class="field-wrap">
            <label class="color_white"> User Type</label> &nbsp; &nbsp;<input type= "radio" name="usertype" value="admin" checked>Admin
              <input type="radio" name="usertype" value="user" autocomplete="off"/> 
              User
            </div>
            <div class="field-wrap">
              <label class="color_white"> Username <span class="req"></span></label > &nbsp;
              <input type="text"required autocomplete="on"/ name="username" autocomplete="off"/>
            </div>
            <div class="field-wrap">
              <label class="color_white"> Password <span class="req"></span> </ label> &nbsp;
              <input type="password"required autocomplete=off/ name="password">
            </div>
            <button name="Login" class="button button-block"/>Log In</button>
          </form>
        </div>
  
        <div id="signup" class="tab-content hidden">   
          <h1>Sign Up for Free</h1>
          <form action="" method="post">
            <div class="field-wrap">
             <label>Username*</label>&nbsp;&nbsp;<input name="username" type="text" required autocomplete="off"/>
            </div>
            <div class="field-wrap">
              <label>Set A Password*</label>&nbsp;<input name="password" type="password"required autocomplete="off"/>
            </div>
            <button name="Signup" class="button button-block"/>Get Started</button>
          </form>
        </div>
      </div>
    </div>


<?php
$con = mysql_connect("127.0.0.1:3306","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("mysql", $con);

if (isset($_POST['Login'])){
  $sql="Select * from user_login where username='". $_POST['username']. "' and password= '" . $_POST['password'] . "' and type='" . $_POST['usertype'] . "'";
        $proj=mysql_query($sql);
        if (!$proj) 
      {
        echo mysql_error();
      }
     $matchFound = mysql_num_rows($proj);
     if ($matchFound === 0)
     {
       echo "<script type='text/javascript'>alert('Invalid input. Please enter the credentials again.');</script>";
     }
     else {
          echo "<script type='text/javascript'>document.getElementById('loginform').remove();</script>";
          if ($_POST['usertype'] === "user") { 
            echo file_get_contents("analysis.html");;
          } else {
            require 'admin.html';
          }
     }     
}
if (isset($_POST['Signup'])){
      $sql="Insert into user_login VALUES('" . $_POST['username'] . "','" . $_POST['password'] . "', 'user')";
      $ins=mysql_query($sql);
      if (!$ins) {
          echo "<script type='text/javascript'>alert('Error: " . mysql_error() . ");</script>";
      } else
      {
        echo "<script type='text/javascript'>alert('You have successfully created an account. Please login with your credentials');</script>";
      }
      
}

?>
</script>

  </body>
</html>
