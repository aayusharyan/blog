<?php
session_start();
//ADD NEW JOB
 $userid = $_SESSION['id'];
 $name = $_SESSION['name'];
 $username = $_SESSION['username'];
 $position = $_SESSION['position'];
 if(isset($_SESSION['return'])){
    $return = $_SESSION['return'];
    unset($_SESSION['return']);
}


if ($position!=="editor")
 {
    header("Location: ../../auth_error.php");
 }


$con=mysqli_connect("mysql.hostinger.in","u146795210_root","password", "u146795210_users");

// Check connection
if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
$qz = "SELECT * FROM members where id='".$userid."'" ;
$qz = str_replace("\'","",$qz);
$result = mysqli_query($con,$qz);
while($row = mysqli_fetch_array($result))
    {
$chk=1;
    }

if ($chk==0)
{
 header("Location: ../../auth_error.php");
}

mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Editor Panel | Pending Jobs</title>

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.php">Company Name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../index.php">Home</a></li>
            <li class="dropdown active">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Jobs <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="available.php">Pending Jobs</a></li>
            <li><a href="approved.php">Approved Jobs</a></li>
            <li role="separator" class="divider"></li>
            <li class="active"><a href="new.php">Create a Job</a></li>
          </ul>
        </li>
            <li><a href="../pay/index.php">Pay the Writers</a></li>
            <li><a href="../addnew/index.php">Add a new Editor</a></li>
          </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="../account.php"><?php echo $name?></a></li>
              <li><button type="button" class="btn btn-default navbar-btn" onclick="location.href='../../logout.php';">Sign Out</button></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Create a New Job</h1>
      </div>
        
        <?php 
        if(isset($return)){
            echo $return;
}
   ?>     
        
        
        
        
<form class="form-horizontal" action="add.php" method="post">
  <div class="form-group">
    <label for="inputname" class="col-sm-2 control-label">Job Name : </label>
    <div class="col-sm-9">
      <input type="text" name="jobname" class="form-control" id="inputname" required>
    </div>
  </div>
    <div class="form-group">
    <label for="inputtype" class="col-sm-2 control-label">Job Type : </label>
    <div class="col-sm-9">
      <select class="form-control" name="jobtype" required>
          
          
          <?php

          $con1=mysqli_connect("mysql.hostinger.in","u146795210_jobs","password", "u146795210_jobs");
$zero=0;
 $one=1;
$qz1 = "SELECT * FROM config WHERE id=$one" ;
$qz1 = str_replace("\'","",$qz1);
$result1 = mysqli_query($con1,$qz1);
while( $row1 = mysqli_fetch_assoc( $result1 ) )
        {
    $last_type = $row1['last_type'];
    $last_desc = $row1['last_desc'];
    $last_words = $row1['last_words'];
    $tries = $row1['tries'];
}
   
$con=mysqli_connect("mysql.hostinger.in","u146795210_jobs","password", "u146795210_jobs");
$zero=0;
$qz = "SELECT * FROM job_types" ;
$qz = str_replace("\'","",$qz);
$result = mysqli_query($con,$qz);
while( $row = mysqli_fetch_assoc( $result ) )
        {
    $sel="";
    if ($row['job_type']==$last_type)
    {
        $sel= "selected";
    }
    echo "<option value=\"{$row['job_type']}\" {$sel}>{$row['job_type']}</option>";
            
        }
mysqli_close($con1);
?>
          
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputdesc" class="col-sm-2 control-label">Description : </label>
    <div class="col-sm-9">
      <textarea class="form-control" name="description" rows="5" required><?php echo $last_desc;?></textarea>
    </div>
  </div>
    <div class="form-group">
    <label for="inputlevel" class="col-sm-2 control-label">Writer Level : </label>
    <div class="col-sm-9">
      <select class="form-control" name="writerlevel" id="writer_level" onchange="get_details();" required>
          <option value="" disabled selected> -- Select an Option --</option>
          
          
          <?php

          $con1=mysqli_connect("mysql.hostinger.in","u146795210_jobs","password", "u146795210_jobs");
$zero=0;
 $one=1;
$qz1 = "SELECT * FROM config WHERE id=$one" ;
$qz1 = str_replace("\'","",$qz1);
$result1 = mysqli_query($con1,$qz1);
while( $row1 = mysqli_fetch_assoc( $result1 ) )
        {
    $last_type = $row1['last_type'];
    $last_desc = $row1['last_desc'];
    $last_words = $row1['last_words'];
    $tries = $row1['tries'];
}
   
$con=mysqli_connect("mysql.hostinger.in","u146795210_jobs","password", "u146795210_jobs");
$zero=0;
$qz = "SELECT * FROM writer_levels" ;
$qz = str_replace("\'","",$qz);
$result = mysqli_query($con,$qz);
while( $row = mysqli_fetch_assoc( $result ) )
        {
    echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
        }
mysqli_close($con1);
?>
          
</select>
    </div>
    </div>
    <div class="form-group">
        <label for="inputwords" class="col-sm-2 control-label">Words : </label>
    <div class="col-sm-3">
      <input type="number" name="words" class="form-control" id="inputwords" value="<?php echo $last_words?>" required>
    </div>
        <label for="inputmax" class="col-sm-offset-1 col-sm-2 control-label">Normal Amount : </label>
    <div class="col-sm-3">
      <input type="number" name="amount" class="form-control" id="inputmax" required>
    </div>
  </div>
    <div class="form-group">
    <label for="inputtries" class="col-sm-2 control-label">Tries : </label>
    <div class="col-sm-3">
      <input type="number" name="tries" class="form-control" id="inputtries" value="<?php echo $tries?>" required>
    </div>
        <label for="inputmin" class="col-sm-offset-1 col-sm-2 control-label">Base Amount : </label>
    <div class="col-sm-3">
      <input type="number" name="base_amount" class="form-control" id="inputmin" required>
        <div id="money"></div>
    </div>
  </div>
    <div class="form-group">
    <label for="time" class="col-sm-2 control-label">Time : </label>
    <label for="time" class="col-sm-1 control-label"> (Days) : </label>
    <div class="col-sm-2">
        <select class="form-control" name="days" id="time" required>
          <option value="" disabled selected> - Days - </option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            </select>            
    </div>
    <label for="time" class="col-sm-1 control-label"> (Hrs.) : </label>
    <div class="col-sm-2">
        <select class="form-control" name="hours" id="time" required>
          <option value="" disabled selected> - Hrs. - </option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            </select> 
    </div>
    <label for="time" class="col-sm-1 control-label"> (Mins.) : </label>
    <div class="col-sm-2">
        <select class="form-control" name="minutes" id="time" required>
          <option value="" disabled selected> - Mins. - </option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
            <option value="32">32</option>
            <option value="33">33</option>
            <option value="34">34</option>
            <option value="35">35</option>
            <option value="36">36</option>
            <option value="37">37</option>
            <option value="38">38</option>
            <option value="39">39</option>
            <option value="40">40</option>
            <option value="41">41</option>
            <option value="42">42</option>
            <option value="43">43</option>
            <option value="44">44</option>
            <option value="45">45</option>
            <option value="46">46</option>
            <option value="47">47</option>
            <option value="48">48</option>
            <option value="49">49</option>
            <option value="50">50</option>
            <option value="51">51</option>
            <option value="52">52</option>
            <option value="53">53</option>
            <option value="54">54</option>
            <option value="55">55</option>
            <option value="56">56</option>
            <option value="57">57</option>
            <option value="58">58</option>
            <option value="59">59</option>
            </select> 
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" id="funbutton" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>

        
        
        
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Footer content here.</p>
      </div>
    </footer>

  <script>
          
       
  
//function to get details  
function get_details(){  
  
        //get the Value ID  
        var lvl = $('#writer_level').val(); 
        $("#inputmax").attr("disabled", "disabled");
        $("#inputmin").attr("disabled", "disabled");
        $("#inputtries").attr("disabled", "disabled");
        //use ajax to run the check  
        $.post("getamount.php", { lvl: lvl },  
            function(result){  
            $("#inputmax").attr("value", result);
            $("#inputmax").removeAttr("disabled");
                
        }); 
        $.post("getbase.php", { lvl: lvl },  
            function(result){  
                $("#inputmin").attr("value", result);
                $("#inputmin").removeAttr("disabled");
        }); 
         $.post("gettries.php", { lvl: lvl },  
            function(result){  
             $("#inputtries").attr("value", result);
             $("#inputtries").removeAttr("disabled");
                
        }); 
}  
 
          
</script>
      
      
      
    <!-- Bootstrap core JavaScript
    ================================================== -->
      
    <script>window.jQuery || document.write('<script src="../../js/jquery.min.js"><\/script>')</script>
    <script src="../../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

