<?php include 'header.php'; ?>   
<?php if (isset($page_title) && $page_title == "Login" || $page_title == "Registration") : else : ?>

	<?php if (auth('user_login') == TRUE) : ?> 
		<?php include '_users/user_menu.php'; ?> 
		<?php include '_users/user_sidebar.php'; ?>  
	
	<?php elseif (__auth('auth_login') == TRUE) : ?>
		<?php include '_admin/admin_menu.php'; ?> 
		<?php include '_admin/admin_sidebar.php'; ?>  
	<?php endif ?>
	
	
	
	
<?php endif; ?>  
