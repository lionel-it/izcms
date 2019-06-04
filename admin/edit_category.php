<?php include('../includes/header.php');?>
<?php include('../includes/mysqli_connect.php');?>
<?php include('../includes/functions.php');?>
<?php include('../includes/sidebar-admin.php'); ?>
    <?php
    // Kiem tra xem nguoi dung co duoc vao trang admin hay khong?
        admin_access(); 
        
    // Xac nhan bien GET ton tai va thuoc loai du lieu cho phep
        if(isset($_GET['cid']) && filter_var($_GET['cid'], FILTER_VALIDATE_INT, array('min_range' =>1))) {
            $cid = $_GET['cid'];
        } else {
            redirect_to('admin/admin.php');
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') { // Gia tri tri ton tai, xu ly form.
            $errors = array();
            // Kiem tra ten cua category
            if(empty($_POST['category'])) {
                $errors[] = "category";
            } else {
            $cat_name = mysqli_real_escape_string($dbc,strip_tags($_POST['category']));
            }
            
            // Kiem tra position cua category
            if(isset($_POST['position']) && filter_var($_POST['position'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
                $position = $_POST['position'];
            } else {
                $errors[] = "position";
            }
            
            if(empty($errors)) {
                // Neu khong co loi xay ra, thi chen vao csdl.
            $q = "UPDATE categories SET cat_name = '{$cat_name}', position = $position WHERE cat_id = {$cid} LIMIT 1";
            $r = mysqli_query($dbc, $q);
            confirm_query($r, $q);
            
            if(mysqli_affected_rows($dbc) == 1) {
                $messages = "<p class='success'>The category was edited successfully.</p>";
            } else {
                $messages = "<p class='warning'>Could not edit the category due to a system error.</p>";
            }
        } else {
            $messages = "<p class='warning'>Please fill all the required fields</p>";
        }
        } // END main IF submit condition
    ?>
    <div id="content">
        <?php
            $q = "SELECT cat_name, position FROM categories WHERE cat_id = {$cid}";
            $r = mysqli_query($dbc, $q);
            confirm_query($r, $q);
            if(mysqli_num_rows($r) == 1) {
                // Neu category ton tai trong database, dua vao CID, xuat du lieu ra ngoai trinh duyet
                list($cat_name, $position) = mysqli_fetch_array($r, MYSQLI_NUM);
            } else {
                // Neu CID khong hop le, se khong the hien thi category
                $messages = "<p class='warning'>The category does not exist.</p>";
            }
        ?>
    <h2>Edit category: <?php if(isset($cat_name)) echo $cat_name; ?></h2>
    <?php if(!empty($messages)) echo $messages; ?>
	<form id="edit_cat" action="" method="post">
    <fieldset>
    	<legend>Edit category</legend>
            <div>
                <label for="category">Category Name: <span class="required">*</span>
                    <?php 
                        if(isset($errors) && in_array('category', $errors)) {
                            echo "<p class='warning'>Please fill in the category name</p>";
                        }
                    ?>
                
                </label>
                <input type="text" name="category" id="category" value="<?php if(isset($cat_name)) echo $cat_name; ?>" size="20" maxlength="150" tabindex="1" />
            </div>
            <div>
                <label for="position">Position: <span class="required">*</span>
                    <?php 
                    if(isset($errors) && in_array('position', $errors)) {
                        echo "<p class='warning'>Please pick a position</p>";
                    }
                    ?>
                
                </label>
                <select name="position" tabindex='2'>
                    <?php
                        $q = "SELECT count(cat_id) AS count FROM categories";
                        $r = mysqli_query($dbc,$q) or die("Query {$q} \n<br/> MySQL Error: " .mysqli_error($dbc));
                        if(mysqli_num_rows($r) == 1) {
                            list($num) = mysqli_fetch_array($r, MYSQLI_NUM);
                            for($i=1; $i<=$num+1; $i++) { // Tao vong for de ra option, cong them 1 gia tri cho position
                                echo "<option value='{$i}'";
                                    if(isset($position) && ($position == $i)) echo "selected='selected'";
                                echo ">".$i."</otption>";
                            }
                        }
                    ?>
                </select>
            </div>
    </fieldset>
    <p><input type="submit" name="submit" value="Add Category" /></p>
</form>

</div><!--end content-->
<?php include('../includes/sidebar-b.php');?>
<?php include('../includes/footer.php'); ?>