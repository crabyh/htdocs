<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Education Sever System</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li id="home"><a href="index.php">Home</a></li> <!-- class="active" --> 
        <li class="dropdown" id="user">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">User <b class="caret"></b></a>
          <ul class="dropdown-menu">

            <li><a href="user_info.php" id="1">User Info</a></li>
            <li><a href="password_change.php" id="2">Change Password</a></li>
            <li><a href="user_add.php" id="1">Add User</a></li>
            <li><a href="user_select.php" id="1">User Select</a></li>
            <li><a href="system_log_check.php" id="1">Check SystemLog</a></li>

          </ul>
        </li>
        <li class="dropdown" id="course">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="course">Course <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="course_select.php">Course Info</a></li>
            <li><a href="course_add.php">Add Course</a></li>
          </ul>
        </li>
        <li><a href="#about">About</a></li>
      </ul>
      <p class="nav navbar-text navbar-right">

        <?php 
        if(isset($_SESSION["user_id"])) echo "Hello,".$_SESSION["username"];
        ?>
        <?php 
        if(isset($_SESSION["user_id"])) echo '<a href="logout.php">sign out</a>';
        else echo'<a href="login.php">sign in</a>';
        ?>

    </p>
    </div><!--/.nav-collapse -->
  </div>
</div>
