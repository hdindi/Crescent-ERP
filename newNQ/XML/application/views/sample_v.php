

	<div align="center">
		<?php echo validation_errors('<p class="error">', '</p>');
		echo $this -> table -> generate($samples_details);
		?>
	</div>
