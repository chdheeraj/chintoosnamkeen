<?php
session_start();
if(isset($_SESSION['user_id']))
{
    session_destroy();
?>
<script>
    window.location = "login.php";
</script>
<?php    
}
?>