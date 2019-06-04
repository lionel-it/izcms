<div class="box latest">
<h2>Latest Posts</h2>
<?php 
    $q = "SELECT page_id,page_name, content FROM pages ORDER BY post_on DESC LIMIT 0, 20";
    $r = mysqli_query($dbc, $q); confirm_query($r, $q);
    if(mysqli_num_rows($r) > 0) {
        // Have posts to display
        echo "<ul class='totem'>";
        while(list($pid,$page_name, $content) = mysqli_fetch_array($r, MYSQLI_NUM)) {
            echo "<li>
                <h3><a href='single.php?pid={$pid}'>{$page_name}</a></h3>
                <p>". the_excerpt($content, 30)."</p>
                </li>
                ";
        } // END WHILE
        echo "</ul>";
    } else {
        echo "<p> There is currently no post</p>";
    }

?>
</div>