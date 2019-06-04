<?php include('../includes/header.php');?>
<?php include('../includes/mysqli_connect.php');?>
<?php include('../includes/functions.php');?>
<?php include('../includes/sidebar-admin.php'); ?>
    <div id="content">
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $errors = array();
                if(empty($_POST['page_name'])) {
                    $errors[] = 'page_name';
                } else {
                    $page_name = mysqli_real_escape_string($dbc,strip_tags($_POST['page_name']));
                }
                if(isset($_POST['category']) && filter_var($_POST['category'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
                    $cat_id = $_POST['category'];
                } else {
                    $errors[] = "category";
                }
                if(isset($_POST['position']) && filter_var($_POST['position'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
                    $position = $_POST['position'];
                } else {
                    $errors[] = "position";
                }
                if(empty($_POST['content'])) {
                    $errors[] = 'content';
                } else {
                    $content = mysqli_real_escape_string($dbc,$_POST['content']);
                }
                if(empty($errors)) {
                    $q = "INSERT INTO pages (user_id, cate_id, page_name, content, position, post_on) VALUES (1, {$cat_id}, '{$page_name}', '{$content}', $position, NOW())";
                    $r = mysqli_query($dbc,$q);
                    if(mysqli_affected_rows($dbc) == 1) {
                        $messages = "<p class='success'>The page was added successfully.</p>";
                    } else {
                        $messages = "<p class='warning'>The page could not be added due to a system error</p>";
                    }
                } else {
                    $messages = "<p class='warning'>Please fill in all the required fields</p>";
                }
            }
        ?>
        <h2>Create a page</h2>
        <?php if(!empty($messages)) echo $messages; ?>
        <form action="" id="login"  method="post">
            <fieldset>
                <legend>Add a Page</legend>
                <div>
                    <label for="page">Page Name: <span class="required">*</span>
                        <?php 
                            if(isset($errors) && in_array('page_name', $errors)) {
                                echo "<p class='warning'>Please fill in the page name</p>";
                            }
                        ?>
                    </label>
                    <input type="text" name="page_name" id="page_name" value="<?php if(isset($_POST['page_name'])) echo strip_tags($_POST['page_name']); ?>" size="20" maxlength="80" tabindex="1" />
                </div>
                <div>
                    <label for="category">All categories: <span class="required">*</span>
                        <?php 
                            if(isset($errors) && in_array('category', $errors)) {
                                echo "<p class='warning'>Please pick a category</p>";
                            }
                        ?>
                    </label>
                    <select name="category">
                        <option>Select Category</option>
                        <?php
                            $q = "SELECT cate_id, cate_name FROM categories ORDER BY position ASC";
                            $r = mysqli_query($dbc, $q);
                            if(mysqli_num_rows($r) > 0) {
                                while($cats = mysqli_fetch_array($r, MYSQLI_NUM)) {
                                    echo "<option value='{$cats[0]}'";
                                        if(isset($_POST['category']) && ($_POST['category'] == $cats[0])) echo "selected='selected'";
                                    echo ">".$cats[1]."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="position">Position: <span class="required">*</span>
                        <?php 
                            if(isset($errors) && in_array('position', $errors)) {
                                echo "<p class='warning'>Please pick a position</p>";
                            }
                        ?>
                    </label>
                    <select name="position">
                        <option>Select Position</option>
                        <?php
                            $q = "SELECT count(page_id) AS count FROM pages";
                            $r = mysqli_query($dbc,$q) or die("Query {$q} \n<br/> MySQL Error: " .mysqli_error($dbc));
                            if(mysqli_num_rows($r) == 1) {
                                list($num) = mysqli_fetch_array($r, MYSQLI_NUM);
                                for($i=1; $i <= $num+1; $i++) {
                                    echo "<option value='{$i}'";
                                        if(isset($_POST['position']) && $_POST['position'] == $i) echo "selected='selected'";
                                    echo ">".$i."</otption>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="page-content">Page Content: <span class="required">*</span>
                        <?php 
                            if(isset($errors) && in_array('content', $errors)) {
                                echo "<p class='warning'>Please fill in the content</p>";
                            }
                        ?>
                    </label>
                    <textarea name="content" cols="50" rows="20"><?php if(isset($_POST['content'])) echo htmlentities($_POST['content'], ENT_COMPAT, 'UTF-8'); ?></textarea>)
                </div>
            </fieldset>
            <p><input type="submit" name="submit" value="Add Page"></p>
        </form>
    </div><!--end content-->
<?php include('../includes/footer.php'); ?>