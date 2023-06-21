<?php
session_start();
if(isset($_SESSION['user_id']))
{
?>
<script>
    window.location = "index.php";
</script>
<?php
exit;  
}
include("app.php");
if (isset($_POST['username']) && isset($_POST['pwd'])) {
  $username = trim($_POST['username']);
  $pwd = trim($_POST['pwd']);
  $en_pwd = md5($pwd);
  $register_stmt = $pdo->query("SELECT * FROM `register` where username='".addslashes($username)."' AND en_pwd='".addslashes($en_pwd)."'");
  if($register_stmt->rowCount() > 0)
  {
    $register_stmt_r = $register_stmt->fetch();
    $_SESSION['user_id'] = $register_stmt_r['ID'];
    $_SESSION['username'] = $register_stmt_r['username'];
    $_SESSION['priority'] = $register_stmt_r['priority'];
    echo "1";
  }else{
    echo "-1";
  }
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/sweetalert/sweetalert.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="d-flex align-items-center w-auto">
                  <img src="../images/Chintoos_Logo.png" alt="">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="username" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="username"  required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="pwd" class="form-label">Password</label>
                      <input type="password" name="pwd" class="form-control" id="pwd" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="button" onclick="login()" id="login_btn">Login</button>
                    </div>
                  </form>

                </div>
              </div>


            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/jquery.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/sweetalert/sweetalert.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    function login()
    {
      var username = $('#username').val().trim();
      var pwd = $('#pwd').val().trim();
      var login_btn_text = $("#login_btn").html();
      $("#login_btn").html("Please Wait...");
      $("#login_btn").attr("disabled", true);
      $.ajax({
        type: "POST",
        url: "",
        data: {username: username, pwd: pwd},
        success: function(result){
          result = result.trim();
          $("#login_btn").attr("disabled", false);
          $("#login_btn").html(login_btn_text);
          if(result == '1')
          {
            window.location = "index.php";
          }else {
            swal("", "Login failed, You entered incorrect details, please enter valid details", "error");
          }
        },
        error: function(error){
          $("#login_btn").attr("disabled", false);
          $("#login_btn").html(login_btn_text);
          console.log(error);
        }
      });
    }
  </script>
</body>

</html>