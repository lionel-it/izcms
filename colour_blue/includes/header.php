<?php 
ini_set('session.use_only_cookies', true);
session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset='UTF-8' />
	
	<title>izCMS - <?php echo (isset($title)) ? $title : "My Home page"; ?></title>
	<script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/totem.min.js"></script>
    <script type="text/javascript" src="js/check_ajax.js"></script>
    <script type="text/javascript" src="js/delete_comment.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.totem').totemticker({
                row_height: '60px',
                speed: 800,
                interval: 8000,
                max_items: 5,
                mousestop: true
            });
        });
    </script>
    <script type="text/javascript" src="http://localhost/icms/js/tinymce/tiny_mce.js" ></script >
        <script type="text/javascript" >
        tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        plugins : "emotions,spellchecker,advhr,insertdatetime,preview", 
                
        // Theme options - button# indicated the row# only
        theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect",
        theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",      
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true
        });
    </script >
	<link rel='stylesheet' href='css/style.css' />
</head>

<body>
	<div id="container">
	<div id="header">
		<h1><a href="http://localhost/icms/index.php">izCMS</a></h1>
        <p class="slogan">The iz Content Management System</p>
	</div>
	<div id="navigation">
		<ul>
	        <li><a href='index.php'>Home</a></li>
			<li><a href='#'>About</a></li>
			<li><a href='#'>Services</a></li>
			<li><a href='contact.php'>Contact us</a></li>
		</ul>
        
        <p class="greeting">Xin chào <?php echo (isset($_SESSION['first_name'])) ? $_SESSION['first_name'] : "bạn hiền!"; ?></p>
	</div><!-- end navigation-->