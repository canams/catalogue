<html>
	<head>
		<title> CD Catalogue </title>
		<link href="https://fonts.googleapis.com/css?family=Forum|Inconsolata|Lobster+Two|Poiret+One" rel="stylesheet">
		<link rel="stylesheet" href="styles.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>

	<body>
		
		<?php
			$home = 'active';
			include 'nav.php';
			include 'functions.php';
		?>

				<h2> Catalogue Info</h2>

			<ul class="info">
				<?php
					select_count("CD");
					select_count("Artist");
				?>
			</ul>

		<div class='onedit'>
			<form method="POST" action="albums.php">
				<div class="edit_input">
					<input type="text" name="album_edit_title" value="" id="album_edit_title" required>
					<!--
					<select name="Artists">
						<?php
							#artists_dropdown();
						?>
					</select>
				-->
					<input type="text" name="album_edit_price" value="" id="album_edit_price" required>
					<input type="text" name="album_edit_genre" value="" id="album_edit_genre" required>					
					<input type="hidden" name="edit_id" id="edit_id">
					<button type="submit" name="edit_form_submit" class="edit_submit">Edit Artist</button>
					<button type="submit" name="edit_form_delete" id="delete_button">Delete Artist</button>
				</div>
			</form>
		</div>
			



			
		<script type="text/javascript" src="script.js"></script>

	</body>
</html>
