<div class="box latest">
<h2>Latest Posts</h2>
<?php 
    $q = "SELECT page_id,page_name, content, post_on FROM pages ORDER BY post_on DESC LIMIT 0, 2";
    $r = mysqli_query($dbc, $q); confirm_query($r, $q);
    if(mysqli_num_rows($r) > 0) {
        // Have posts to display
        while(list($pid,$page_name, $content, $the_date) = mysqli_fetch_array($r, MYSQLI_NUM)) {
            echo "<h4>{$page_name}</h4>
                    <h5>{$the_date}</h5>
                <p>". the_excerpt($content, 150)."</p>
                <a href='{$pid}'>Read more</a><p></p>
                ";
        } // END WHILE
    } else {
        echo "<p> There is currently no post</p>";
    }

?>
</div>