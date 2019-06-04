<?php 
    include('includes/mysqli_connect.php');
    include('includes/functions.php');
    
    if($pid = validate_id($_GET['pid'])) {
            // Neu pid hop le thi tien hanh truy van csdl
            $set = get_page_by_id($pid);
            $page_views = view_counter($pid);
            $posts = array(); // Tao mot array trong de luu gia tri vao su dung sau nay cho phan noi dung
        if(mysqli_num_rows($set) > 0) {
            // Neu co post de hien thi ra trinh duyet.
            $pages = mysqli_fetch_array($set, MYSQLI_ASSOC); 
            $title = $pages['page_name'];
            $posts[] = array(
                        'page_name' => $pages['page_name'], 
                        'content' => $pages['content'], 
                        'author' => $pages['name'], 
                        'post-on' => $pages['date'],
                        'aid' => $pages['user_id']
                        );
        } else {
            echo "<p>There are currenlty no post in this category.</p>";
        }
    } else {
        // Neu pid khong hop le, thi chuyen huong nguoi dung ve trang index.
        redirect_to();
    }
    
    include('includes/header.php');
    include('includes/sidebar-a.php'); 
?>
<div id="content">
    <?php 
        foreach($posts as $post) {
        echo "
            <div class='post'>
                <h2>{$post['page_name']}</h2>
                <p>".the_content($post['content'])."</p>
                <p class='meta'>
                    <strong>Posted by:</strong><a href='author.php?aid={$post['aid']}'> {$post['author']}</a> | 
                    <strong>On: </strong> {$post['post-on']} 
                    <strong>Page views: </strong> {$page_views}
                    </p>
            </div>
        ";
    } // End foreach.
    ?>
    
    <?php include('includes/comment_form.php');?>
</div><!--end content-->
<?php 
    include('includes/sidebar-b.php');
    include('includes/footer.php'); 
?>