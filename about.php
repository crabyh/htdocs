<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php include 'check_access.php'; ?>

<!-- include head file-->
<head>
<?php include 'header.php'; ?>
<script type="text/javascript">
function act(){
  var user = document.getElementById("home")
  user.className = "active"
}
</script>
</head>

<body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php include 'navigation.php'; ?>

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">

          <h1>About Us</h1>
        </div>

        <!-- page body -->
        <div class="row clearfix">
          <div class="col-md-10 column">
            <p class="lead">We are group one Mr.Bao and his little friends. It's our team first web project.</p>
            <p class="lead">Team leader is Crabyh, and members are StarCalm, HyukSoa, Xenia Qian and LeLe.</p>
            <p class="lead">As you see my English is not so good, but they think it's GaoDaShang to use English instead of Chinese. And it's two o'clock and some of us are still coding and debugging. Maybe it's so tiring, but I think it is also such happiness to work in this group.</p>
          </div>
        </div>

        <div class="row clearfix">
          <div class="col-md-10 column">
            <dl>
              <dt class="lead">Crabyh </dt>
              <dd class="lead">Yuhan Mao, working on job assignment, communication to other teams, front-end bootstrap development and php-part worker.</dd>
            </dl>

            <dl>
              <dt class="lead">StarCalm </dt>
              <dd class="lead">Junze Bao, working on JavaScript part, implementing part-refresh using AJAX which makes web work faster. Building some of the pages and debugging. Also known as a python user.</dd>
            </dl>

            <dl>
              <dt class="lead">HyukSoa </dt>
              <dd class="lead">Xuqian Zhang, working on PHP of security part, such as defending SQL injection, and system log. Also is responsible for managing files.</dd>
            </dl>

            <dl>
              <dt class="lead">Xenia Qian </dt>
              <dd class="lead">Xin Qian, working on front-end bootstrap development and php of database part, doing testing job afterwards.</dd>
            </dl>

            <dl>
              <dt class="lead">Lele </dt>
              <dd class="lead">Liao Li, working on the documenting jobs, also a tester afterwards.</dd>
            </dl>
              
            <p class="lead" align="right">2014.6</p>

            </br>

            </form>
          </div>
        </div>
      </div>
    </div>


    <!-- page footer -->
    <?php include"footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>