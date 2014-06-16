<?php $nav = array(  //判断左边php名称对应右边按钮高亮
  'loged' => 'home',
  'index' => 'home',
  'user_info' => 'team1',
  'password_change' => 'team1',
  'user_add' => 'team1',
  'user_select' => 'team1',
  'system_log_check' => 'team1',
  'course_select' => "team1",
  'course_add' => 'team1',
  'course_info' => 'team1',
  'check_db' => 'team1',
  'about' => 'about',
   );
  $current_page = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);
  foreach ($nav as $page => $navbar) {
    if ($page == $current_page) {
      echo '<script type="text/javascript"> $(document).ready(function(){$("#'.$navbar.'").addClass("active")}) </script>';
    }
  }
?>

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
      <a class="navbar-brand" href="index.php">Education Service System</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li id="home"><a href="index.php">Home</a></li> <!-- class="active" --> 
        <li class="dropdown" id="team1">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Information Management<b class="caret"></b></a>
          <ul class="dropdown-menu">

            <li><a href="user_info.php">User Information</a></li>
            <li><a href="password_change.php">Change Password</a></li>

            <li class="divider"></li>

            <li><a href="course_select.php">Course Query</a></li>
            <?php if(isset($_SESSION['user_id'])):?>

              <?php if ("admin" == $_SESSION["usertype"] || "manager" == $_SESSION["usertype"]):?>
                <li><a href="course_add.php">Add Course</a></li>
              <?php endif;?>

              <?php if ("admin" == $_SESSION["usertype"] || "manager" == $_SESSION["usertype"]):?>
                <li class="divider"></li>
                <li><a href="user_select.php">User Query</a></li>
                <li><a href="user_add.php">Add User</a></li>
                <?php if ("admin" == $_SESSION["usertype"]):?>
                  <li><a href="system_log_check.php">Check SystemLog</a></li>
                  <li><a href="check_db.php">View Database</a></li>
                <?php endif;?>
              <?php endif;?>  

            <?php endif;?>

          </ul>
        </li>
        
        <li id="about"><a href="about.php">About</a></li>
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
