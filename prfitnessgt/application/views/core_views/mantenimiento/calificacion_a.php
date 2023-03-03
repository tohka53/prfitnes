<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 col-sm-6">
				Listado para la calificación 
				<br>				
				<br>
				<br>
				<?php echo $output; ?>				
			</div>
		</div>				
	</div>
</div>
				
