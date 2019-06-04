<?php $title = 'Activate Account'; include('../includes/header.php');?>
<?php include('../includes/mysqli_connect.php');?>
<?php include('../includes/functions.php');?>
<?php include('../includes/sidebar-a.php'); ?>
<div id="content">
    <?php 
    if(isset($_GET['x'], $_GET['y']) && filter_var($_GET['x'], FILTER_VALIDATE_EMAIL) && strlen($_GET['y']) == 32) {
        // Neu day du thong tin va hop le, xu ly form va truy van csdl
        $e = mysqli_real_escape_string($dbc, $_GET['x']);
        $a = mysqli_real_escape_string($dbc, $_GET['y']);
        
        $q = "UPDATE users SET active = NULL WHERE email = '{$e}' AND active = '{$a}' LIMIT 1";
        $r = mysqli_query($dbc, $q); confirm_query($r, $q);
        if(mysqli_affected_rows($dbc) == 1) {
            echo "<p class='success'>Your acccount has been activated successfully. You may <a href='".BASE_URL."/login.php'>login </a> now.</p>";
        } else {
            echo "<p class='warning'>Your account could not be activated. Please try again later.</p>";
        }
    } else {
        // Thong tin khong dung, hoac khong hop le, chuyen huong nguoi dung ve trang index
        redirect_to();
    }
    ?>
</div><!--end content-->
<?php include('../includes/sidebar-b.php');?>
<?php include('../includes/footer.php'); ?>