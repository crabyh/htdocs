<!DOCTYPE HTML>
<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php include 'check_access.php'; ?>

<!-- include head file-->
<head>
<?php include 'header.php'; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>DatePicker</title>

<style>
.date-picker-wp {
display: none;
position: absolute;
background: #f1f1f1;
left: 40px;
top: 40px;
border-top: 4px solid #3879d9;
}
.date-picker-wp table {
border: 1px solid #ddd;
}
.date-picker-wp td {
background: #fafafa;
width: 22px;
height: 18px;
border: 1px solid #ccc;
font-size: 12px;
text-align: center;
}
.date-picker-wp td.noborder {
border: none;
background: none;
}
.date-picker-wp td a {
color: #1c93c4;
text-decoration: none;
}
.strong {font-weight: bold}
.hand {cursor: pointer; color: #3879d9}
</style>

<script type="text/javascript">
var DatePicker = function () {
    var $ = function (i) {return document.getElementById(i)},
        addEvent = function (o, e, f) {o.addEventListener ? o.addEventListener(e, f, false) : o.attachEvent('on'+e, function(){f.call(o)})},
        getPos = function (el) {
            for (var pos = {x:0, y:0}; el; el = el.offsetParent) {
                pos.x += el.offsetLeft;
                pos.y += el.offsetTop;
            }
            return pos;
        }

    var init = function (n, config) {
        window[n] = this;
        Date.prototype._fd = function () {var d = new Date(this); d.setDate(1); return d.getDay()};
        Date.prototype._fc = function () {var d1 = new Date(this), d2 = new Date(this); d1.setDate(1); d2.setDate(1); d2.setMonth(d2.getMonth()+1); return (d2-d1)/86400000;};
        this.n = n;
        this.config = config;
        this.D = new Date;
        this.el = $(config.inputId);
        this.el.title = this.n+'DatePicker';
        
        this.update();
        this.bind();
    }
    init.prototype = {
    
        update : function (y, m) {
            var con = [], week = ['Su','Mo','Tu','We','Th','Fr','Sa'], D = this.D, _this = this;
                fn = function (a, b) {return '<td title="'+_this.n+'DatePicker" class="noborder hand" onclick="'+_this.n+'.update('+a+')">'+b+'</td>'},
                _html = '<table cellpadding=0 cellspacing=2>';
            y && D.setYear(D.getFullYear() + y);
            m && D.setMonth(D.getMonth() + m);
            var year = D.getFullYear(), month = D.getMonth() + 1, date = D.getDate();
            for (var i=0; i<week.length; i++) con.push('<td title="'+this.n+'DatePicker" class="noborder">'+week[i]+'</td>');
            for (var i=0; i<D._fd(); i++ ) con.push('<td title="'+this.n+'DatePicker" class="noborder">&nbsp;</td>');
            for (var i=0; i<D._fc(); i++ ) con.push('<td class="hand" onclick="'+this.n+'.fillInput('+year+', '+month+', '+(i+1)+')">'+(i+1)+'</td>');
            var toend = con.length%7;
            if (toend != 0) for (var i=0; i<7-toend; i++) con.push('<td class="noborder">&nbsp;</td>');
            _html += '<tr>'+fn("-1, null", "&lt;&lt;")+fn("null, -1", "&lt;")+'<td title="'+this.n+'DatePicker" colspan=3 class="strong">'+year+'/'+month+'/'+date+'</td>'+fn("null, 1", "&gt;")+fn("1, null", "&gt;&gt;")+'</tr>';
            for (var i=0; i<con.length; i++) _html += (i==0 ? '<tr>' : i%7==0 ? '</tr><tr>' : '') + con[i] + (i == con.length-1 ? '</tr>' : '');
            !!this.box ? this.box.innerHTML = _html : this.createBox(_html);
        },
        fillInput : function (y, m, d) {
            var s = this.config.seprator || '/';
            this.el.value = y + s + m + s + d;
            this.box.style.display = 'none';
        },
        show : function () {
            var s = this.box.style, is = this.mask.style;
            s['left'] = is['left'] = getPos(this.el).x + 'px';
            s['top'] = is['top'] = getPos(this.el).y + this.el.offsetHeight + 'px';        
            s['display'] = is['display'] = 'block';
            is['width'] = this.box.offsetWidth - 2 + 'px';
            is['height'] = this.box.offsetHeight - 2 + 'px';
        },
        hide : function () {
            this.box.style.display = 'none';
            this.mask.style.display = 'none';
        },
        bind : function () {
            var _this = this;            
            addEvent(document, 'click', function (e) {
                e = e || window.event;
                var t = e.target || e.srcElement;
                if (t.title != _this.n+'DatePicker') {_this.hide()} else {_this.show()}
            })
        },
        createBox : function (html) {
            var box = this.box = document.createElement('div'), mask = this.mask = document.createElement('iframe');
            box.className = this.config.className || 'datepicker';
            mask.src = 'javascript:false';
            mask.frameBorder = 0;
            box.style.cssText = 'position:absolute;display:none;z-index:9999';
            mask.style.cssText = 'position:absolute;display:none;z-index:9998';
            box.title = this.n+'DatePicker';
            box.innerHTML = html;
            document.body.appendChild(box);
            document.body.appendChild(mask);
                        
            return box;
        }
    }
    
    return init;
}();
onload = function () {
new DatePicker('_DatePicker_demo', {
inputId: 'date-input',
className: 'date-picker-wp',
seprator: '-'
});
new DatePicker('_demo2', {inputId: 'demo2', className: 'date-picker-wp'})
}
</script>


</head>

<body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php include 'navigation.php'; ?>

      <!--CheckUserType-->
      <?php 
      include 'check_user_type.php';
      CheckUserType('manager');
      ?> 

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>Add User
          </h1>
        </div>

        <!-- accessing database not completed -->
        <?php
          if(isset($_POST['submit']))
          {
            $input_newpassword = $_POST['input_newpassword'];
            $repeat_newpassword = $_POST['repeat_newpassword'];
            // echo $input_newpassword." ".$repeat_newpassword;
            if($input_newpassword != $repeat_newpassword)
            {
              echo'<div class="alert alert-danger alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4>
                         The two passwords are different!
                      </h4> <strong>Please check your password and try again.</strong></a>
                    </div>';

            }
            else 

            {
                require_once 'connectvars.php'; 
                $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                $u_id=$_POST['u_id']; 
                $u_name=$_POST['u_name'];
                $typ=$_POST['typ'];
                $gender=$_POST['gender'];
                $department=$_POST['department'];
                $enroll_time=$_POST['enroll_time'];
                $birthday=$_POST['birthday'];
                $email=$_POST['email'];
                $phone=$_POST['phone'];
                $query = "SELECT * FROM accounts WHERE user_id = '$u_id';";
                $data = mysqli_query($dbc,$query);
                if(mysqli_num_rows($data)==1)
                {
                  echo'<div class="alert alert-danger alert-dismissable">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>
                          This User '.$u_id.' is already existed!
                        </h4> <strong>Please try another one.</strong>
                      </div>';
                }
                else
                {
                    $md5_newpassword = md5("$input_newpassword");
                    $user_id = $_SESSION['user_id'];
                    $query = "INSERT INTO accounts VALUES('$u_id','$md5_newpassword','$typ');";
                    $data = mysqli_query($dbc,$query);

                    $query = "INSERT INTO user_info VALUES('$u_id','$u_name','$department','$gender',date('$birthday'),'$enroll_time','$phone','$email');";
                    $data = mysqli_query($dbc,$query);
                    if(mysqli_num_rows($data)==1)
                    {
                      echo'<script type="text/javascript"> 
                       setTimeout(window.location.href="loged.php?passw_ch=success",3); 
                       </script>';
                    }
                    else
                    {
                      // echo mysqli_errno($dbc)." ".mysqli_error($dbc);

                      echo'<script type="text/javascript"> 
                         setTimeout(window.location.href="loged.php?passw_ch=success",3); 
                        </script>';}
                }
            }




          }
        ?>
        <!-- page body -->
        <div class="row clearfix"> 
          <div class="col-md-5 column">
            <form class="form" id='9' method="POST" action="user_add.php">
              
              <div class="form-group">
                <label>User ID</label>
                <input type="text" class="form-control" name="u_id" placeholder="">
              </div>

              <div class="form-group">
                <label >New password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="input_newpassword" placeholder="Password" required>
              </div>

              <div class="form-group">
                <label for="NewPassword">Confirm your password again</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="repeat_newpassword" placeholder="Password" required>
              </div>

              <div class="form-group">
                <label>User Name</label>
                <input type="text" class="form-control" name="u_name" placeholder="">
              </div>

              <div class="form-group">
              <label>User Type</label><br/>
                <select name="typ" id="seltype" class="form-control">
                  <option value="student">Student</option>
                  <option value="teacher">Teacher</option>
                  <option value="manager">Manager</option>
                  <option value="admin">Administration</option>
                </select>
              </div>

              <div class="form-group">
              <label>Gender</label><br/>
                <select name="gender" id="seltype" class="form-control">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>

              <div class="form-group">
                <label>Department</label>
                <input type="text" class="form-control" name="department" placeholder="">
              </div>

              <div class="form-group">
                <label>Enroll Year</label>
                <input type="number" class="form-control" name="enroll_time" value="2014">
              </div>

              <div class="form-group">
                <label>Birthday</label>
                <input type="text" class="form-control" id="date-input" name="birthday" />
              </div>

              <div class="form-group">
                <label>Phone</label>
                <input type="phone" class="form-control" name="email" placeholder="">
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="tel" class="form-control" name="phone" placeholder="">
              </div>

              <br>

              <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                <button type="reset" class="btn btn-default" name="reset" value="reset">Reset</button>
              </div>

            </form>
          </div>
        </div>

      </div><!-- container -->
    </div>

    <!-- page footer -->
    <?php include"footer.php"; ?>

    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>