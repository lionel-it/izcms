<?php include('includes/header.php');?>
<?php include('includes/mysqli_connect.php');?>
<?php include('includes/functions.php');?>
<?php include('includes/sidebar-a.php'); ?>
<div id="content">
    <?php 
        if(isset($_GET['cid']) && filter_var($_GET['cid'], FILTER_VALIDATE_INT, array('min_range' =>1))) {
            $cid = $_GET['cid'];
                $q = " SELECT p.page_name, p.page_id, p.content,"; 
                $q .= " DATE_FORMAT(p.post_on, '%b %d, %y') AS date, ";
                $q .= " CONCAT_WS(' ', u.first_name, u.last_name) AS name, u.user_id ";
                $q .= " FROM pages AS p ";
                $q .= " INNER JOIN users AS u ";
                $q .= " USING (user_id) ";
                $q .= " WHERE p.cat_id={$cid}";
                $q .= " ORDER BY date ASC LIMIT 0, 10";
                $r = mysqli_query($dbc,$q);
                confirm_query($r, $q);
                if(mysqli_num_rows($r) > 0) {
                    // Neu co post de hien thi ra trinh duyet.
                    while($pages = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                        echo "
                            <div class='post'>
                                <h2><a href='single.php?pid={$pages['page_id']}'>{$pages['page_name']}</a></h2>
                                <p>".the_excerpt($pages['content'])." ... <a href='single.php?pid={$pages['page_id']}'>Read more</a></p>
                                <p class='meta'><strong>Posted by:</strong> <a href='author.php?aid={$pages['user_id']}'> {$pages['name']}</a> | <strong>On: </strong> {$pages['date']} </p>
                            </div>
                        ";
                    } // End while loop
                } else {
                    echo "<p>There are currenlty no post in this category.</p>";
                }
            } elseif (isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' =>1))) {
                $pid = $_GET['pid'];
                $q = " SELECT p.page_name, p.content, ";
                $q .= " DATE_FORMAT(p.post_on, '%b %d, %y') AS date, "; 
                $q .= " CONCAT_WS(' ', u.first_name, u.last_name) AS name, "; 
                $q .= " u.user_id, COUNT(c.comment_id) AS count ";
                $q .= " FROM users AS u INNER JOIN pages as p ";
                $q .= " USING(user_id) LEFT JOIN comments AS c ";
                $q .= " ON p.page_id = c.page_id ";
                $q .= " WHERE p.page_id = {$pid} ";
                $q .= " GROUP BY p.page_name ";
                $q .= " ORDER BY date ASC ";
                $r = mysqli_query($dbc, $q);
                confirm_query($r, $q);
                if(mysqli_num_rows($r) > 0) {
                    // Neu co ket qua tra ve, hien thi ra trinh duyet.
                    while($page = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                        echo "
                            <div class='post'>
                                <h2><a href='single.php?pid={$pid}'>{$page['page_name']}</a></h2>
                                <p class='comments'><a href='single.php?pid={$pid}#disscuss'>{$page['count']}</a></p>
                                <p>".the_excerpt($page['content'])." ... <a href='single.php?pid={$pid}'>Read more</a></p>
                                <p class='meta'><strong>Posted by:</strong><a href='author.php?aid={$page['user_id']}'> {$page['name']}</a> | <strong>On: </strong> {$page['date']} </p>
                            </div>
                        ";
                    } // END WHILE
                } else {
                    // Neu khong co ket qua, hoac ID khong ton tai hoac khong hop le
                    echo "<p class='warning'>The article you are viewing is not available.</p>";
                }
            } else {
            ?>
            <h2>Welcome To izCMS</h2>
            <div>
                <p>
                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus
                </p>
                
                <p>
                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus
                </p>
                
                <p>
                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus
                </p>
                
                <p>
                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus
                </p>
                
                <p>
                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus
                </p>
                
                <p>
                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus
                </p>
            </div>
            <?php }?>
</div><!--end content-->
<?php include('includes/sidebar-b.php');?>
<?php include('includes/footer.php'); ?>