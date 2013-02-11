<?php include('header.php'); ?>
	
    	
	<div id="header">
		<h1><?php print !empty($title) ? $title: ''; ?></h1>
		<?php if(!empty($back)): ?>
		  <?php print $back; ?>
		<?php endif; ?>
	</div>
	
	<?php if(!empty($messages)): ?>
	<div class="messages">
	  <?php print $messages; ?>
	</div>
	<?php endif; ?>
	
  <?php if(!empty($nav)): ?>
  <div class="nav">
    <?php print $nav; ?>
  </div>
  <?php endif; ?>
  
  <?php if(!empty($content)): ?>
  <div class="content">
    <?php print $content; ?>
  </div>
  <?php endif; ?>

<?php include('footer.php'); ?>
