<!DOCTYPE html>
<html>
<head>
	<title> Artists </title>
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Forum|Lobster+Two|Poiret+One" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
	<?php
		$artists = 'active';
		include 'nav.php';
		include 'functions.php';
	?>

	<h2 id='titlehead'> Artist Info </h2>

	<form method="POST" action="artists.php">
		<div class="search">
			<input type="text" name="query" placeholder="Search..." required>
			<button type="submit" name="formSubmit"><i class="fa fa-search"></i></button>
		</div>
	</form>
	<div id='edit_request'>
		<table align="center" class="editclicks">
	  		<tr>
			    <th>Artist Name</th> 
			    <th></th>
	  		</tr>
	  		<?php
	  			//sorry I know I cheated using global but I spent so long trying to figure out how to do it otherwise
	  			global $result;

	  			if(isset($_POST['formSubmit']))
				{
  					$result = search_result();
				} 
				else if(isset($_POST['edit_form_delete']))
				{
					$result = delete();
				}
				else if (isset($_POST['edit_form_submit']))
				{
					$result = edit_artist();
				}
				else if (isset($_POST['add_form_submit']))
				{
					$result = add_artist();
				}
				else
				{
					$result = display_table();
				}

	  		?>
		</table>

	</div>
	<form method="POST" action="artists.php" id="add_form">
		<div style="text-align: center;" class="add">
			<a href='#' style="color: #6C3483" id='add_artist_link'> Add Artist </a>
		</div>
	</form>

		<div class='onedit'>
			<form method="POST" action="artists.php">
				<div class="edit_input">
					<input type="text" name="edit_query" value="" id="edit_query" required>
					<input type="hidden" name="artid" id="artid">
					<button type="submit" name="edit_form_submit" class="edit_submit">Edit Artist</button>
					<button type="submit" name="edit_form_delete" id="delete_button">Delete Artist</button>
				</div>
			</form>
		</div>

		<div class='onadd'>
			<form method="POST" action="artists.php">
				<div class="add_input">
					<input type="text" name="add_query" value="" id="add_query" required>
					<button type="submit" name="add_form_submit" class="add_submit">Add Artist</button>
					<button type="button" value="Back" onclick="window.location.href = 'artists.php'">Back</button>
			</form>

			
		</div>	
		
		

		
	<script type="text/javascript" src="artist_script.js"></script>
	<script type="text/javascript">
			var result = <?php echo json_encode($result); ?>;
	</script>
</body>
</html>
