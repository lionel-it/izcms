<?php include('../includes/header.php');?>
<?php include('../includes/mysqli_connect.php');?>
<?php include('../includes/functions.php');?>
<?php include('../includes/sidebar-admin.php'); 
// Kiem tra xem nguoi dung co duoc vao trang admin hay khong?
    admin_access(); 
        
?>
<div id="content">
<h2>Manage Categories</h2>
<table>
	<thead>
		<tr>
			<th><a href="view_categories.php?sort=cat">Categories</a></th>
			<th><a href="view_categories.php?sort=pos">Position</th>
			<th><a href="view_categories.php?sort=by">Posted by</th>
            <th>Edit</th>
            <th>Delete</th>
		</tr>
	</thead>
	<tbody>
    <?php
        // Sap xep theo thu tu cua table head
            if(isset($_GET['sort'])) {
                switch ($_GET['sort']) {
                    case 'cat':
                    $order_by = 'cat_name';
                    break;
                    
                    case 'pos':
                    $order_by = 'position';
                    break;
                    
                    case 'by':
                    $order_by = 'name';
                    break;
                    
                    default:
                    $order_by = 'position';
                    break;
                } // End Switch
            } else {
                $order_by = 'position';
            }
        // truy xuat csdl de hien thi categories
        $q = "SELECT c.cat_id, c.cat_name, c.position, c.user_id, CONCAT_WS(' ', first_name, last_name) AS name";
        $q .= " FROM categories AS c ";
        $q .= " JOIN users AS u ";
        $q .= " USING(user_id) ";
        $q .= " ORDER BY {$order_by} ASC";
        $r = mysqli_query($dbc, $q);
            confirm_query($r, $q);
        while($cats = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            echo "
            <tr>
                <td>{$cats['cat_name']}</td>
                <td>{$cats['position']}</td>
                <td>{$cats['name']}</td>
                <td><a class='edit' href='edit_category.php?cid={$cats['cat_id']}'>Edit</a></td>
                <td><a class='delete' href='delete_category.php?cid={$cats['cat_id']}&cat_name={$cats['cat_name']}'>Delete</a></td>
            </tr>
            
            ";
        }
    ?>
        
	</tbody>
</table>
</div><!--end content-->

<?php include('../includes/footer.php'); ?>