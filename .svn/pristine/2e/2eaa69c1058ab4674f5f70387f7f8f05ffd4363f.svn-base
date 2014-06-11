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
      <a class="navbar-brand" href="#">Education Sever System</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">User <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="user_info.php">User Info</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Course <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Course Info</a></li>
          </ul>
        </li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li>
        <a><?php 
        if(isset($_SESSION["user_id"])) echo "Hello,".$_SESSION["username"];
        ?></a>
      </li>
      <li>
        <?php 
        if(isset($_SESSION["user_id"])) echo '<a href="logout.php">sign out</a>';
        else echo'<a href="login.php">sign in</a>';
        ?></a>
      </li>
    </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>