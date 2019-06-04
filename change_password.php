<?php $title = 'Đổi mật khẩu'; include('includes/header.php');?>
<?php include('includes/mysqli_connect.php');?>
<?php include('includes/functions.php');?>
<?php include('includes/sidebar-a.php'); ?>
<div id="content">
    <?php 
        // Kiem tra xem nguoi dung da dang nhap hay chua?
        is_logged_in();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Bat dau xu ly form
            $errors = array();
            
            // Kiem tra xem current password co dung dinh dang va ton tai hay khong?
            if(isset($_POST['cur_password']) && preg_match('/^\w{4,20}$/', trim($_POST['cur_password']))) {
                    $cur_password = mysqli_real_escape_string($dbc,trim($_POST['cur_password']));
                    
                // Truy van CSDL de tim xem mat khau co ton tai hay khong?
                $q = "SELECT first_name FROM users WHERE pass = SHA1('$cur_password') AND user_id = {$_SESSION['uid']}";
                $r = mysqli_query($dbc, $q); confirm_query($r, $q);
                
                // Neu co gia tri tra ve, thi se lam tiep
                if(mysqli_num_rows($r) == 1) {
                    
                    // Tim thay nguoi dung trong CSDL, cho phep nguoi dung thay doi mat khau
                    // Kiem tra xem password co dung dinh dang cho phep hay khong?
                    if(isset($_POST['password1']) && preg_match('/^\w{4,20}$/', trim($_POST['password1']))) {
                        // Neu dung ...
                            // Kiem tra xem password 1 co bang password 2 hay khong?
                            if($_POST['password1'] == $_POST['password2']) {
                                $np = mysqli_real_escape_string($dbc, trim($_POST['password1']));
                                
                                // Neu hai truong password la giong nhau, update CSDL voi password moi
                                $q = "UPDATE users SET pass = SHA1('$np') WHERE user_id = {$_SESSION['uid']} LIMIT 1";
                                $r = mysqli_query($dbc, $q); confirm_query($r, $q);
                                
                                // Kiem tra xem co update thanh cong hay khong?
                                if(mysqli_affected_rows($dbc) == 1) {
                                    // Neu update thanh cong ...
                                    $message = "<p class='success'>Your password has been successfully updated.</p>";
                                } else {
                                    // Neu update khong thanh cong
                                    $errors[] = "<p class='error'>Your password could not be changed due to a system error.</p>";
                                }
                                
                            } else {
                                // Neu hai truong password khong giong nhau
                                $errors[] = "<p class='error'>Your password and confirm password do not match.</p>";
                            }
                        
                        } else {
                            // Neu sai ...
                            $errors = "<p class='error'>Your password is either too short or missing.</p>";
                        }
                        
                } else {
                    $errors[] = "<p class='error'>Your current password is incorrect. Please check your email to verify your password.</p>";
                }
            } else {
                // Mat khau qua ngan hoac thieu mat khau.
                $errors[] = "<p class='error'>Your password is either too short or missing.</p>";
            }
        } // END main IF
    ?>
    <h2>Change Password</h2>
    <?php if(isset($message)) echo $message; if(isset($errors)) {report_error($errors);}?>
    
    <form action="" method="post">          
        <fieldset>
    		<legend>Change Password</legend>
            <div>
                <label for="Current Password">Current Password</label> 
                <input type="password" name="cur_password" value="" size="20" maxlength="40" tabindex='1' />
            </div>
    
    		<div>
                <label for="New Password">New Password</label> 
                <input type="password" name="password1" value="" size="20" maxlength="40" tabindex='2' />
            </div>
            
            <div>
                <label for="Confirm Password">Confirm Password</label> 
                <input type="password" name="password2" value="" size="20" maxlength="40" tabindex='3' />
            </div>
    	</fieldset>
     <div><input type="submit" name="submit" value="Update Password" tabindex='4' /></div>
    </form>
</div><!--end content-->
<?php include('includes/sidebar-b.php');?>
<?php include('includes/footer.php'); ?>

