<?php include('../includes/header.php');?>
<?php include('../includes/mysqli_connect.php');?>
<?php include('../includes/functions.php');?>
<?php include('../includes/sidebar-admin.php'); 
// Kiem tra xem nguoi dung co duoc vao trang admin hay khong?
        admin_access(); 
        
?>

<div id="content">
<h2>Manage Pages</h2>
<table>
	<thead>
		<tr>
			<th><a href="view_pages.php?sort=pg">Pages</a></th>
			<th><a href="view_pages.php?sort=on">Posted on</th>
			<th><a href="view_pages.php?sort=by">Posted by</th>
            <th>Content</th>
            <th>Edit</th>
            <th>Delete</th>
		</tr>
	</thead>
	<tbody>
    <?php
        // Sap xep theo thu tu cua table head
            if(isset($_GET['sort'])) {
                switch ($_GET['sort']) {
                    case 'pg':
                    $order_by = 'page_name';
                    break;
                    
                    case 'on':
                    $order_by = 'date';
                    break;
                    
                    case 'by':
                    $order_by = 'name';
                    break;
                    
                    default:
                    $order_by = 'date';
                    break;
                } // End Switch
            } else {
                $order_by = 'date';
            }
        // truy xuat csdl de hien thi categories
        $q = "SELECT p.page_id, p.page_name, DATE_FORMAT(p.post_on, '%b %d %Y') AS date,CONCAT_WS(' ', first_name, last_name) AS name, p.content";
        $q .= " FROM pages AS p ";
        $q .= " JOIN users AS u ";
        $q .= " USING(user_id) ";
        $q .= " ORDER BY {$order_by} ASC";
        $r = mysqli_query($dbc, $q);
            confirm_query($r, $q);
        if(mysqli_num_rows($r) > 0) {
            // Neu co page de hien thi, thi lay page va hien thi ra trinh duyet
        while($pages = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            echo "
            <tr>
                <td>{$pages['page_name']}</td>
                <td>{$pages['date']}</td>
                <td>{$pages['name']}</td>
                <td>".the_excerpt($pages['content'])."</td>
                <td><a class='edit' href='edit_page.php?pid={$pages['page_id']}'>Edit</a></td>
                <td><a class='delete' href='delete_page.php?pid={$pages['page_id']}&pn={$pages['page_name']}'>Delete</a></td>
            </tr>
            
            ";
        } // End while loop
        } else {
            // Neu khong co page de hien thi, bao loi hoac noi nguoi dung tao page
            $messages = "<p class='warning'>There is currently no page to display. Please create a page first.</p>";
        }
    ?>
        
	</tbody>
</table>
</div><!--end content-->
<?php include('../includes/footer.php'); ?>