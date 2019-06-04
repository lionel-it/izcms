<div id="section-navigation">
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
            // Cau lenh truy xuat categories
            $q = "SELECT cate_name, cate_id FROM categories ORDER BY position ASC";
            $r = mysqli_query($dbc, $q);
             // Lay categories tu csdl
            while($cats = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                echo "<li><a href='index.php?cid={$cats['cate_id']}'";
                if($cats['cate_id'] == $cid) echo "class='selected'"; 
                echo ">".$cats['cate_name']. "</a>";
                // Cau lenh truy xuat pages
                $q1 = "SELECT page_name, page_id FROM pages WHERE cate_id={$cats['cate_id']} ORDER BY position ASC";
                $r1 = mysqli_query($dbc, $q1);
                echo "<ul class='pages'>";
                // Lay pages tu csdl
                while($pages = mysqli_fetch_array($r1, MYSQLI_ASSOC)) { 
                    echo "<li><a href='index.php?pid={$pages['page_id']}'";
                    if($pages['page_id'] == $pid) echo "class='selected'";
                    echo ">".$pages['page_name']."</a></li>";
                    
                } // End WHILE pages
                echo "</ul>";
            }
        ?>
    </ul>
</div>