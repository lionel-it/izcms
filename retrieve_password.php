<?php $title = 'Quên mật khẩu'; include('includes/header.php');?>
<?php include('includes/mysqli_connect.php');?>
<?php include('includes/functions.php');?>
<?php include('includes/sidebar-a.php'); ?>
<div id="content">
    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $uid = FALSE; 
            $errors = array();
            // Bat dau xu ly form.
            if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $e = mysqli_real_escape_string($dbc, $_POST['email']);
                
                // Kiem tra trong CSDL de xem email co ton tai hay khong
                $q = "SELECT user_id FROM users WHERE email = '{$e}'";
                $r = mysqli_query($dbc, $q); confirm_query($r, $q);
                if(mysqli_num_rows($r) == 1) {
                    // Tim thay email trong CSDL
                    list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
                }
            } else {
                // Queen ko dien email
                $errors[] = "<p class='error'>Please enter your email</p>";
            }
            
            if($uid) {
                // Neu co uid, thi chuan bi update lai mat khau cua nguoi dung
                $temp_pass = substr(md5(uniqid(rand(), true)), 3, 10);
                
                // Updat CSDL voi password tam thoi
                $q = "UPDATE users SET pass = SHA1('$temp_pass') WHERE user_id = {$uid} LIMIT 1";
                $r = mysqli_query($dbc, $q); confirm_query($r, $q);
                if(mysqli_affected_rows($dbc) == 1) {
                    // Neu update thanh cong, thi email den nguoi dung password tam thoi
                    $body = "Your password has been temporarily changed to {$temp_pass}. Please use this email address and the new password. Make sure you change it later.";
                    mail($e, "Your temporary password", $body, "FROM: admin localhost");
                    $errors[] = "<p class='success'>Your password has been changed successfully. YOu will receive an email with the new password.<p.";
                } else {
                    $errors[] = "<p class='error'>Your password cannot be changed due to a system error.</p>";
                }
            } else {
                $errors[] = "<p class='error'>The email could not be found in our database.<p>";
            }
        } // END main IF
    ?>
<h2>Retrieve Password</h2>
<?php 
    if(isset($errors)) {
    foreach ($errors as $e) {
        echo $e;
    }
}  
?>
<form id="login" action="" method="post">
    <fieldset>
    	<legend>Retrieve Password</legend>
    	<div>
            <label for="email">Email: </label> 
            
            <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) {echo htmlentities($_POST['email']);} ?>" size="40" maxlength="80" tabindex="1" />
        </div>
    </fieldset>
    <div><input type="submit" name="submit" value="Retrieve Password" /></div>
</form>
</div><!--end content-->
<?php include('includes/sidebar-b.php');?>
<?php include('includes/footer.php'); ?>

