<?php $title = 'Lot Out'; include('includes/header.php');?>
<?php include('includes/mysqli_connect.php');?>
<?php include('includes/functions.php');?>
<?php include('includes/sidebar-a.php'); ?>
<div id="content">
    <?php 
        if(!isset($_SESSION['first_name'])) {
            // Neu nguoi dung chua dang nhap va khong co thong tin trong he thong
            redirect_to();
        } else {
            // Neu co thong tin nguoi dung, va da dang nhap, se logout nguoi dung.
            $_SESSION = array(); // Xoa het array cua SESSIOM
            session_destroy(); // Destroy session da tao
            setcookie(session_name(),'', time()-36000); // Xoa cookie cua trinh duyet
        } 
        echo "<h2>You are now logged out.</h2>";
    ?>
</div><!--end content-->
<?php include('includes/sidebar-b.php');?>
<?php include('includes/footer.php'); ?>

