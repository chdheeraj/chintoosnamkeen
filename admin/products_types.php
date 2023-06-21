<?php
session_start();
include("app.php");
if(!isset($_SESSION['user_id']))
{
?>
<script>
    window.location = "login.php";
</script>
<?php
exit;  
}
if(isset($_POST['modelid']))
{
  $type_name = "";
  $modeltitle = "";
  $modelid = $_POST['modelid'];
  if($modelid > 0)
  {
    $modeltitle = "Edit Product Type";
    $edit_product_types_stmt = $pdo->query("SELECT * FROM `product_types` where ID='$modelid'");
    if($edit_product_types_stmt->rowCount() > 0)
    {
      $edit_product_types_stmt_r = $edit_product_types_stmt->fetch();
      $type_name = $edit_product_types_stmt_r['type_name'];
    }
  }else{
    $modeltitle = "ADD Product Type";
  }
?>
<div class="modal fade" id="basicModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?=$modeltitle?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="product_type_name" name="product_type_name" placeholder="Enter Product Type" class="form-control" value="<?=$type_name?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="add_close">Close</button>
        <button type="button" class="btn btn-primary" onclick="addProductType(<?=$modelid?>)" id="add_product">Submit</button>
      </div>
    </div>
  </div>
</div>
<?php  
  exit;
}
if(isset($_POST['deleted_id']))
{
  $delete_id = $_POST['deleted_id'];
  if($pdo->query("DELETE FROM `product_types` WHERE ID='$delete_id'") == true)
  {
    echo "1";
  }else{
    echo "0";
  } 
  exit;
}
if(isset($_POST['page']))
{
  $page = trim($_POST['page']);
  if(is_numeric($page) && $page > 0)
  {
    $page = $page;
  }else{
    $page;
  }
  $product_types_stmt = $pdo->query("SELECT * FROM `product_types`");
  if($product_types_stmt->rowCount() > 0)
  {
    $inc = 1;
      while($product_types_stmt_r = $product_types_stmt->fetch())
      {
        ?>
            <tr id="row_<?=$product_types_stmt_r['ID']?>">
              <th scope="row"><?=$inc++?></th>
              <td><?=$product_types_stmt_r['type_name']?></td>
              <td style="text-align: end;">
                <button class="btn btn-primary" onclick="openDynamicModel(<?=$product_types_stmt_r['ID']?>)"><i class="ri-edit-2-fill"></i></button>
                <button class="btn btn-danger" onclick="deleteRecord(<?=$product_types_stmt_r['ID']?>)"><i class="ri-delete-bin-4-fill"></i></button>
              </td>
            </tr>  
        <?php
      }
  }
  exit;
}
if(isset($_POST['product_type_name']) && isset($_POST['postid']))
{
  $product_type_name = trim($_POST['product_type_name']);
  $postid = trim($_POST['postid']);
  if(trim($product_type_name)!='')
  {
    if($postid == '0')
    {
      if($pdo->query("INSERT INTO `product_types` (`type_name`) VALUES ('".addslashes($product_type_name)."');") == true){
          echo "1";
      }else{
        echo "0";
      }
      
    }else{
      if($pdo->query("UPDATE `product_types` SET `type_name` = '".addslashes($product_type_name)."' WHERE  `ID` = '".$postid."';');") == true){
        echo "1";
      }else{
        echo "0";
      }
    }
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

  <title>Products - Chintoos Namkeen</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
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
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/sweetalert/sweetalert.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
    <?php include("header.php"); ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
    <?php include("sidemenu.php"); ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Product Types</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Product Types</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row" >
      <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                List of Product Types
                <span>
                  <button type="button" class="btn btn-primary" style="float:right;" onclick="openDynamicModel(0)">
                      ADD Product Type
                  </button>
                </span>
              </h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Type</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody id="result_table">
                                 
                </tbody>
              </table>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal" style="float:right;display: none;" id="dynamicmodel_btn">
                      ADD Product Type
                  </button>
              
              <!-- End Default Table Example -->
              <div id="dynamic_model"></div>
            </div>
          </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php //include("footer.php"); ?>
  <!-- End Footer -->

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
    function loadPages(page)
    {
        $( "#result_table" ).load( "", { "page": page }, function() {
          
        });
    }
    loadPages(1);
    function addProductType(id)
    {
      var product_type_name = $("#product_type_name").val().trim();
      if(product_type_name=='')
      {
        swal("Error", "Please Enter Product Type", "error");
        return false;
      }
      var login_btn_text = $("#add_product").html();
      $("#add_product").html("Please Wait...");
      $("#add_product").attr("disabled", true);
      $.ajax({
        type: "POST",
        url: "",
        data: {product_type_name: product_type_name, postid: id},
        success: function(result){
          result = result.trim();
          $("#add_product").attr("disabled", false);
          $("#add_product").html(login_btn_text);
          if(result == '1')
          {
            $('#add_close').click();
            loadPages(1);
          }else {
            swal("", "Failed to add product type", "error");
          }
        },
        error: function(error){
          $("#add_product").attr("disabled", false);
          $("#add_product").html(login_btn_text);
          console.log(error);
        }
      });
    }

    function deleteRecord(id)
    {
      $.ajax({
        type: "POST",
        url: "",
        data: {deleted_id: id},
        success: function(result){
          result = result.trim();
          if(result == '1')
          {
            $('#row_'+id).remove();
            loadPages(1);
          }else {
            swal("", "Failed to delete product type", "error");
          }
        },
        error: function(error){
          console.log(error);
        }
      });
    }

    function openDynamicModel(modelid)
    {
      $( "#dynamic_model" ).load( "", { "modelid": modelid }, function() {
          $("#dynamicmodel_btn").click();
      });
    }
  </script>
</body>

</html>