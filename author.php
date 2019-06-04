<?php $title = 'Author Page'; include('includes/header.php');?>
<?php include('includes/mysqli_connect.php');?>
<?php include('includes/functions.php');?>
<?php include('includes/sidebar-a.php'); ?>
<div id="content">
    <?php 
        if($aid = validate_id($_GET['aid'])) {
            // Đặt số trang muốn hiển thị ra trình duyệt
                $display = 4;
            // Xác định vị trí bắt đầu.    
                $start = (isset($_GET['s']) && filter_var($_GET['s'], FILTER_VALIDATE_INT, array('min_range' => 1))) ? $_GET['s'] : 0;
                
            // Neu author id ton tai, thi se truy van CSDL
            $q = " SELECT p.page_id, p.page_name, p.content,"; 
            $q .= " DATE_FORMAT(p.post_on, '%b %d, %y') AS date, ";
            $q .= " CONCAT_WS(' ', u.first_name, u.last_name) AS name, u.user_id ";
            $q .= " FROM pages AS p";
            $q .= " INNER JOIN users AS u";
            $q .= " USING (user_id)";
            $q .= " WHERE u.user_id={$aid}";
            $q .= " ORDER BY date ASC LIMIT {$start}, {$display}";
            $r = mysqli_query($dbc, $q);
            confirm_query($r, $q);
            if(mysqli_num_rows($r) > 0) {
                // Co gia tri tra ve, hien thi ra trinh duyet
                while($author = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                        echo "
                            <div class='post'>
                                <h2><a href='single.php?pid={$author['page_id']}'>{$author['page_name']}</a></h2>
                                <p>".the_excerpt($author['content'])." ... <a href='single.php?pid={$author['page_id']}'>Read more</a></p>
                                <p class='meta'><strong>Posted by:</strong><a href='author.php?aid={$author['user_id']}'> {$author['name']}</a> | <strong>On: </strong> {$author['date']} </p>
                            </div>
                        ";
                    } // END WHILE
                    
                    // Phan trang cho phan author
                echo pagination($aid, $display);
                
            } else {
            // Neu author ID khong ton tai, thi bao loi hoac redirect nguoi dung
            echo "<p class='warning'>The author you are trying to view is no longer available.<p>";
        }
        } else {
            redirect_to();
        }

    ?>
</div><!--end content-->
<?php include('includes/sidebar-b.php');?>
<?php include('includes/footer.php'); ?>