<?php
    $dbc = mysqli_connect('localhost', 'root','','chp6');
    
    // neu ket noi khong thanh cong, thi bao loi ra
    if(!$dbc) {
        trigger_error("Could not connect to DB: " . mysqli_connect_error());
    } else {
        // dat phuong thuc ket noi la utf-8
        mysqli_set_charset($dbc, 'utf-8');
    }
?>
<div id="content">
    <a href="http://localhost/icms/login.php?PHPSESSID=ehvi1q2c0i62jo7neeqaisd2l3"> Click here</a>
    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Bat dau xu ly form. Tao bien $errors
        $errors = array();
        
        $e = $_POST['email'];
        $p = $_POST['password']; 
        
        if(empty($errors)) {
            // Bat dau truy van CSDL de lay thong tin nguoi dung
            $q = "SELECT * FROM user WHERE username ='$e' AND pw = '$p'";
            $r = mysqli_query($dbc, $q) or die("Mysqli error $q". mysqli_errno($dbc));
            if(mysqli_num_rows($r) > 0) {
                // Neu tim thay thong tin nguoi dung trong CSDL, se chuyen huong nguoi dung ve trang thich hop.
                list($uid, $username) = mysqli_fetch_array($r, MYSQLI_NUM);
               
                    echo "welcome $username";      

            } else {
                $message = "<p class='error'>The email or password do not match those on file. </p>";
            }
        } else {
            $message = "<p class='erorr'>Please fill in all the required fields.</p>";
        }
    
    } // END MAIN IF
    ?>
    
<div id="content">
	<h2>Login</h2>
    <?php if(!empty($message)) echo $message; ?>
    <form id="login" action="" method="post">
        <fieldset>
        	<legend>Login</legend>
            	<div>
                    <label for="email">Email:
                        <?php if(isset($errors) && in_array('email',$errors)) echo "<span class='warning'>Please enter your email.</span>";?>
                    </label>
                    <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) {echo htmlentities($_POST['email']);} ?>" size="20" maxlength="80" tabindex="1" />
                </div>
                <div>
                    <label for="pass">Password:
                        <?php if(isset($errors) && in_array('password',$errors)) echo "<span class='warning'>Please enter your password.</span>";?>
                    </label>
             <input type="password" name="password" id="pass" value="" size="20" maxlength="20" tabindex="2" />
                </div>
        </fieldset>
        <div><input type="submit" name="submit" value="Login" /></div>
    </form>
    <p><a href="retrieve_password.php">Forgot password?</a></p>
 </div><!--end content-->

</div><!--end content-->
