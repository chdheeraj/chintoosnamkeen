<?php
include("admin/app.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/fontawesome/css/all.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title><?=$app_name?> | Home</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row" style="background: #F5F5F5;">
        <div class="col-12">
          <?php include("header.php"); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
            <div class="banner">
                <img src="images/banner.png" style="width: 100%;margin-top: 83px;">
            </div>
        </div>
      </div>
      <div class="row" style="background: #F5F5F5;">
        <div class="col-4" style="padding-bottom: 59px">
            <div class="report_block" style="border-right: 2px solid #828282;">
                <div class="report_header">60+</div>
                <div class="report_text">Products</div>
            </div>
        </div>
        <div class="col-4">
            <div class="report_block" style="border-right: 2px solid #828282;">
                <div class="report_header">120+</div>
                <div class="report_text">Countries</div>
            </div>
        </div>
        <div class="col-4">
            <div class="report_block">
                <div class="report_header">100+</div>
                <div class="report_text">Distributors</div>
            </div>
        </div>
      </div>
      <div class="row" style="background: #061354;color: white;padding: 20px;">
          <div class="col-6 regtext">
              Agency Registration
          </div>
          <div class="col-6" style="text-align: end;">
            <a href="registration.php" class="regbtn" style="float: right;font-size: 16px;border-radius: 16px;">Agency Registration</a>
          </div>
      </div>

      <div class="row" >
          <div class="col-6">
              <div style="margin: 122px;">
                  <h4 style="margin: 0px;">Our Mission</h4>
                  <p>
                  Our mission at Chintoos Food is to provide a wide variety of hygienic, high-quality Snacks, Fryums and Namkeens to our customers
    through continuous innovation and a commitment to excellence.
                  </p>
              </div>
          </div>
          <div class="col-6">
              <div class="parent">
              <img src="images/rectangle.png" class="image1" style="float: right;margin-right: -12px;margin-top: -18px;height: 481px;">
              <img src="images/mission.png" class="image2" style="height: auto;width: 73%;">
                  
              </div>
          </div>
      </div>
      <?php include("footer.php"); ?>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>