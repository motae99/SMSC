<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); 

//$result=mysql_query("SELECT count('location') as location from sms where location = 'khartoum'");
$query = "SELECT * FROM sms" ;
    global $connection;
    $result = mysqli_query($connection, $query);
        confirm_query($result);

    $data=mysql_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl" xml:lang="ar">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="big.png">

    <title>SMS Service Dashboard</title>
        <script src="js/Chart.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="stylesheets/bootstrap.min.css" rel="stylesheet">
    
    <!-- ICONS CSS FILE -->
    <link href="venders/css/icons.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="stylesheets/dashboard.css" rel="stylesheet">

  </head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top ">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">SMS PORTAL</a>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
          
          <ul class="nav navbar-nav navbar-right">
            <!-- <li><a href="#">الرجاء</a></li>
            <li><a href="#">تحديد</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">تواجدك</a></li> -->
            <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo "مرحبا  " . ucfirst($_SESSION["username"]);?> <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Change Password</a></li>
                    <li><a href="logout.php">logout</a></li>
                
                  </ul>
                </li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="بحث...">
          </form>
                   
        </div>
      </div>
    </nav>

  <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 col-md-push-3 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">عرض <span class="sr-only">(current)</span></a></li>
            <li><a href="#charts"><span class="icon16 minia-icon-bars-2"></span>التقرير</a></li>
            <li><a href="#sms"><span class="icon16 icomoon-icon-mail-3 "></span>الرسائل</a></li>
 	      </div>
 	
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
     <div id="charts"class="row placeholders">
          <h1 class="page-header">لوحة التحكم</h1>

              <div id="canvas-holder" class="col-xs-6 col-sm-6 ">
                <canvas id="Pie" width="400" height="300"/>
              <?php     echo $data['service'] . $data['location']; ?>
              </div>

              <div id="canvas-holder" class="col-xs-6 col-sm-6 ">
                <canvas id="Doughnut" width="400" height="300"/>
              </div>
        </div>
  

  <script>

    var pieData = [
        {
          <?php
          $set = count_location('الخرطوم') ;
           while($result = mysqli_fetch_assoc($set)){
            $count_no =  $result["loc"] ;
            $city = $result['location'] ;
          } 
          ?>
          value: <?php echo $count_no; ?>,
          color:"#F7464A",
          animationSteps : 100,
          highlight: "#FF5A5E",
          label: "<?php echo $city ;?>"
        },
        {
          <?php
          $set = count_location('بحري') ;
           while($result = mysqli_fetch_assoc($set)){
            $count_no =  $result["loc"] ;
            $city = $result['location'] ;
          } 
          ?>
          value: <?php echo $count_no; ?>,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          animationSteps : 100,
          label: "<?php echo $city ;?>"
        },
        {
          <?php
          $set = count_location('امدرمان') ;
           while($result = mysqli_fetch_assoc($set)){
            $count_no =  $result["loc"] ;
            $city = $result['location'] ;
          } 
          ?>
          value: <?php echo $count_no; ?>,
          color: "#FDB45C",
          highlight: "#FFC870",
          animationSteps : 100,
          label: "<?php echo $city ;?>"
        }

      ];
       
      

        var doughnutData = [
        {
          <?php 
          $set = count_servie('صيدلية') ;
          while($result = mysqli_fetch_assoc($set)){
            $service = $result['service'] ;
            $cnt =  $result["no"] ;
          } 
          ?>
          value: <?php echo $cnt; ?>,
          color:"#FDB45C",
          highlight: "#FFC870",
          label: "<?php echo $service; ?>"
        },
        {
          <?php 
          $set = count_servie('معمل') ;
          while($result = mysqli_fetch_assoc($set)){
            $service = $result['service'] ;
            $cnt =  $result["no"] ;
          } 
          ?>
          value: <?php echo $cnt; ?>,
          color: "#949FB1",
          highlight: "#A8B3C5",
          label: "<?php echo $service; ?>"
        },
        {
          value: 10,
          color: "#4D5360",
          highlight: "#616774",
          label: "دكتور"
        }

      ];

      

      window.onload = function(){
         var ctx = document.getElementById("Pie").getContext("2d");
        window.myPie = new Chart(ctx).Pie(pieData);

        var ctx = document.getElementById("Doughnut").getContext("2d");
        window.myDoughnut = new Chart(ctx).Doughnut(doughnutData);
      };


  </script>
       


	<?php echo message(); ?>
          
          <div id="sms"class="table-responsive">
            <h2 class="sub-header">لوحة الرسائل المرسلة</h2>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>رقم العميل</th>
                  <th>المكان</th>
                  <th>الخدمة</th>
                  <th>الوقت</th>
                  <th>الرسالة</th>
                </tr>
              </thead>
              <tbody>
              <?php  
	      global $connection;
	      $q = "SELECT * FROM `sms`";
	      $r_s = mysqli_query($connection, $q);
		      while($r = mysqli_fetch_assoc($r_s)){
		?>
		          <tr>
                  <td><?php echo $r['no'];?></td>
                  <td><?php echo $r['location'];?></td>
                  <td><?php echo $r['service'];?></td>
                  <td><?php echo $r['time'];?></td>
                  <td><?php echo $r['text'];?></td>
              </tr>
		<?php 
	        }
    ?>
             
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="assets/js/vendor/holder.js"></script>
    

  </body>
</html>
