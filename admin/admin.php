<?php include('../includes/header.php');?>
<?php include('../includes/mysqli_connect.php');?>
<?php include('../includes/functions.php');?>
<?php include('../includes/sidebar-admin.php'); 
// Kiem tra xem nguoi dung co duoc vao trang admin hay khong?
        admin_access(); 
        
?>
<div id="content">

    <h2>Welcome To izCMS Admin Panel</h2>
    <div>
        <p>
           Chào mừng bạn đến với trang quản lý của izCMS. Bạn có thể thêm, xóa và chỉnh sửa bài viết ở đây.
        </p>
        
         <p>
          Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus
        </p>
        

    </div>

</div><!--end content-->
<?php include('../includes/footer.php'); ?>