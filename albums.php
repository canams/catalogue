<!DOCTYPE html>
<html>
<head>
	<title> Artists </title>
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Forum|Lobster+Two|Poiret+One" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="album_script.js"></script>
</head>

<body>
	<?php
		$albums = 'active';
		include 'nav.php';
		include 'functions.php';
	?>

	<h2 id="titlehead"> Album Info </h2>

	<form method="POST" action="albums.php">
		<div class="search">
			<input type="text" name="album_query" placeholder="Search..." required>
			<button type="submit" name="album_formSubmit"><i class="fa fa-search"></i></button>
		</div>
	</form>

	<table align="center" class="editclicks">
		<tr>
		    <th>Album Title</th> 
		    <th>Price</th>
		    <th>Genre</th>
		</tr>
		<?php
	  			global $album_result;

	  			if(isset($_POST['album_formSubmit']))
				{
  					$album_result = album_search_result();
				} 
				else if(isset($_POST['edit_form_delete']))
				{
					$album_result = delete_album();
				}
				else if(isset($_POST['edit_form_submit']))
				{
					$album_result = edit_album();
				}
				else if (isset($_GET['artID']))
				{
					$album_result = album_artist();
				}
				else if (isset($_POST['add_form_submit']))
				{
					$album_result = add_album();
				}
				else 
				{
					$album_result = album_display_table();
				}

	  		?>
		</table>

		<form method="POST" action="album.php" id="add_form">
			<div style="text-align: center;" class="add">
				<a href='#' style="color: #6C3483" id='add_album_link'> Add Album </a>
			</div>
		</form>

		<div class='onedit'>
			<form method="POST" action="albums.php">
				<div class="edit_input">
					<input type="text" name="album_edit_title" value="" id="album_edit_title" required>
					<input type="text" name="album_edit_price" value="" id="album_edit_price" required>
					<input type="text" name="album_edit_genre" value="" id="album_edit_genre" required>
					<input type='hidden' name='edit_album' id='edit_album'>					
					<button type="submit" name="edit_form_submit" class="edit_submit">Edit Album</button>
					<button type="submit" name="edit_form_delete" id="delete_button">Delete Album</button>
				</div>
			</form>
		</div>

		<div class='onadd'>
			<form name="addform" method="POST" action="albums.php" onsubmit="return validateForm()">
				<div class="add_input">
					<input type="text" name="add_title" value="Enter Album Title" id="add_title" required>
					<select name="add_artist" id="add_artist">
						<?php
							artists_dropdown();
						?>
					</select>
					<input type="text" name="add_price" value="Enter Album Price" id="add_price" required>
					<input type="text" name="add_genre" value="Enter Album Genre" id="add_genre" required>
					
					<button type="submit" name="add_form_submit" class="add_submit">Add Album</button>
					<button type="button" value="Back" onclick="window.location.href = 'albums.php'">Back</button>
			</form>

			
		</div>
	

	
	<script >
			var album_result = <?php echo json_encode($album_result); ?>;
	</script>
</body>
</html>
