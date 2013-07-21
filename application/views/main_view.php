<?php include('header.php'); ?>
	
    <div id="nav">
    <?php if(!empty($nav)): ?>
      <?php print $nav; ?>
    <?php endif; ?>  
    </div>
    
    <div id="content">
    <?php if(!empty($content)): ?>
      <?php print $content; ?>
    <?php endif; ?>   
    </div>

<?php include('footer.php'); ?>
