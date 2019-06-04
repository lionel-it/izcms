<div id="content-container">
    <div id="section-navigation">
        <h2>Site Navigation</h2>
	   <ul class="navi">
       <?php
       
        // Xac dinh cat_id de to dam link
        if(isset($_GET['cid']) && filter_var($_GET['cid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $cid = $_GET['cid'];
            $pid = NULL;
        } elseif(isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
            $pid = $_GET['pid'];
            $cid = NULL;
        } else {
            $cid = NULL;
            $pid = NULL;
        }
        // get the category
            $cats = the_category();
            echo "<li><a href='index.php?cid={$cats['cat_id']}'";
                if($cats['cat_id'] == $cid) echo "class='selected'"; 
            echo ">".$cats['cat_name']. "</a>";
            
            // Cau lenh truy xuat pages
           $page = get_page_by_cid($cat['cat_id']);
            echo "<li><a href='index.php?pid={$pages['page_id']}'";
                if($pages['page_id'] == $pid) echo "class='selected'";
            echo ">".$pages['page_name']."</a></li>";
               echo "</ul>";
            echo "</li>";
       ?>
	   </ul>
</div><!--end section-navigation-->