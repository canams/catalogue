<?php

	function display_table(){
		include 'db.php';
		$result_array = array();
		$sql = "SELECT * FROM artist ORDER BY artID";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($artID, $title);

		while ($stmt->fetch()) {
			echo "<tr>";
			echo "<td> <a href='albums.php?artID=" .htmlentities($artID). "'>" . htmlentities($title) . "</a></td>";
			array_push($result_array, $title);
			echo "<td> <a href=> Edit </a> </td>";
			echo "</tr>";
		}

		echo "<input type='hidden' name='title_id' id='title_id'>";

		return $result_array;

	}

	function search_result(){
		include 'db.php';
		$result_array = array();
		$query = filter_input(INPUT_POST, 'query', FILTER_SANITIZE_STRING);
		$sql = "SELECT * FROM artist WHERE artName LIKE '%". $query ."%' ORDER BY artID";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($artID, $title);
		$counter = 0;

		while ($stmt->fetch()) {
			echo "<tr>";
			echo "<td> <a href='albums.php?artID=$" .htmlentities($artID). "'>" . htmlentities($title) . "</a></td>";
			array_push($result_array, $title);
			echo "<td> <a href='#'>Edit</a> </td";
			echo "</tr>";
			$counter++;
		}

		echo "<input type='hidden' name='title_id' id='title_id'>";

		if ($counter == 0){
			echo "<tr> <td colspan='2'> No results found. </td> </tr>";
		}

		return $result_array;
		
	}



	function select_count($tablename){
		include 'db.php';

		$sql = "SELECT COUNT(*) AS total FROM $tablename";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($result);

		while ($stmt->fetch()) {
			echo "<li> <pre>Number of $tablename" .  "s:" . htmlentities($result) . "     </pre> </li>";
		}
	}


	function get_id(){
		include 'db.php';

		$query = filter_input(INPUT_POST, 'artid', FILTER_SANITIZE_STRING);
		$sql = "SELECT artID FROM artist WHERE artName LIKE '$query'";

		$idresult = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($idresult);
		$id = $row['artID'];
		return $id;
	}

	function delete(){
		include 'db.php';
		$id = get_id();

		$sql = "DELETE FROM cd WHERE artID = $id";
		
		$stmt = $conn->prepare($sql);
		
		if ($conn->query($sql) === TRUE) {
    		echo "<script> console.log('ID: " .$id ." deleted successfully'); </script>";
		} else {
    		echo "Error deleting record: " . $conn->error;
		}

		$sql = "DELETE FROM artist WHERE artID = $id";
		$stmt = $conn->prepare($sql);
		
		if ($conn->query($sql) === TRUE) {
    		echo "<script> console.log('ID: " .$id ." deleted successfully'); </script>";
		} else {
    		echo "Error deleting record: " . $conn->error;
		}

		$result = display_table();
		return $result;
	}

	function edit_artist(){
		include 'db.php';
		$id = get_id();
		$query = filter_input(INPUT_POST, 'edit_query', FILTER_SANITIZE_STRING);
		$sql = "UPDATE artist SET artName = '$query' WHERE artID = $id";
		$stmt = $conn->prepare($sql);
		
		if ($conn->query($sql) === TRUE) {
    		echo "<script> console.log('ID: " .$id ." updated successfully'); </script>";
		} else {
    		echo "Error updating record: " . $conn->error;
		}

		$result = display_table();
		return $result;
	}

	function album_display_table(){
	include 'db.php';
	$result_array = array();
	$sql = "SELECT * FROM cd ORDER BY cdID";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($cdID, $artID, $title, $price, $genre, $num);

	while ($stmt->fetch()) {
		echo "<tr>";
		echo "<td> <a href=>" . htmlentities($title) . "</a></td>";
		array_push($result_array, $title);
		echo "<td>" . htmlentities($price) . "</td>";
		array_push($result_array, $price);
		echo "<td>" . htmlentities($genre) . "</td>";
		array_push($result_array, $genre);
		echo "<td> <a href=> Edit </a> </td";
		echo "</tr>";
	}

	return $result_array;

	}

	function album_artist(){
	include 'db.php';
	$result_array = array();
	$id = $_GET['artID'];
	$sql = "SELECT * FROM cd WHERE artID = $id ORDER BY cdID";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($cdID, $artID, $title, $price, $genre, $num);

	while ($stmt->fetch()) {
		echo "<tr>";
		echo "<td> <a href=>" . htmlentities($title) . "</a></td>";
		array_push($result_array, $title);
		echo "<td>" . htmlentities($price) . "</td>";
		array_push($result_array, $price);
		echo "<td>" . htmlentities($genre) . "</td>";
		array_push($result_array, $genre);
		echo "<td> <a href=> Edit </a> </td";
		echo "</tr>";
	}

	return $result_array;

	}

	function album_search_result(){
		include 'db.php';
		$result_array = array();
		$query = filter_input(INPUT_POST, 'album_query', FILTER_SANITIZE_STRING);
		$sql = "SELECT * FROM cd WHERE cdTitle LIKE '%". $query ."%' OR cdGenre LIKE '%". $query ."%' OR cdPrice LIKE '%". $query ."%' ORDER BY cdID";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($cdID, $artID, $title, $price, $genre, $num);
		$counter = 0;

		while ($stmt->fetch()) {
			echo "<tr>";
			echo "<td> <a href=>" . htmlentities($title) . "</a></td>";
			array_push($result_array, $title);
			echo "<td>" . htmlentities($price) . "</td>";
			array_push($result_array, $price);
			echo "<td>" . htmlentities($genre) . "</td>";
			array_push($result_array, $genre);
			echo "<td> <a href='#'>Edit</a> </td";
			echo "</tr>";
			$counter++;
		}

		if ($counter == 0){
			echo "<tr> <td colspan='2'> No results found. </td> </tr>";
		}

		return $result_array;
		
	}

	function add_artist(){
		include 'db.php';
		$query = filter_input(INPUT_POST, 'add_query', FILTER_SANITIZE_STRING);
		
		$sql = "INSERT INTO artist (artName) VALUES ('$query')";
		$stmt = $conn->prepare($sql);
		
		if ($conn->query($sql) === TRUE) {
    		echo "<script> console.log('Artist: " .$query ." added successfully'); </script>";
		} else {
    		echo "Error adding record: " . $conn->error;
		}

		$result = display_table();
		return $result;
			

	}

	function artists_dropdown(){
		include 'db.php';
		$sql = "SELECT artName FROM artist ORDER BY artID";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($title);

		while ($stmt->fetch()) {
			echo " <option value='". $title ."'>" . $title . "</option>";
		}
	}

	function get_album_id(){
		include 'db.php';

		#change query to be id of submit edit button (submitedit var in JS script)
		$query = filter_input(INPUT_POST, 'edit_album', FILTER_SANITIZE_STRING);
		echo "query is:" .$query;
		$sql = "SELECT cdID FROM cd WHERE cdTitle LIKE '$query'";

		$idresult = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($idresult);
		$id = $row['cdID'];
		return $id;
	}

	function edit_album(){
		include 'db.php';
		$id = get_album_id();
		$title = filter_input(INPUT_POST, 'album_edit_title', FILTER_SANITIZE_STRING);
		$price = filter_input(INPUT_POST, 'album_edit_price', FILTER_SANITIZE_STRING);
		$genre = filter_input(INPUT_POST, 'album_edit_genre', FILTER_SANITIZE_STRING);
		$sql = "UPDATE cd SET cdTitle = '$title', cdPrice = '$price', cdGenre = '$genre' WHERE cdID = $id";
		$stmt = $conn->prepare($sql);
		
		if ($conn->query($sql) === TRUE) {
    		echo "<script> console.log('ID: " .$id ." updated successfully'); </script>";
		} else {
    		echo "<script> console.log(Error updating record: " . $conn->error . ") </script>";
		}


		$result = album_display_table();
		return $result;
	}

	function delete_album(){
		include 'db.php';
		$id = get_album_id();

		$sql = "DELETE FROM cd WHERE cdID = $id";
		$stmt = $conn->prepare($sql);
		
		if ($conn->query($sql) === TRUE) {
    		echo "<script> console.log('ID: " .$id ." deleted successfully'); </script>";
		} else {
    		echo "Error deleting record: " . $conn->error;
		}

		

		$result = album_display_table();
		return $result;
	}

	function add_album(){
		include 'db.php';

		$artist = filter_input(INPUT_POST, 'add_artist', FILTER_SANITIZE_STRING);
		$title = filter_input(INPUT_POST, 'add_title', FILTER_SANITIZE_STRING);
		$genre = filter_input(INPUT_POST, 'add_genre', FILTER_SANITIZE_STRING);
		$price = filter_input(INPUT_POST, 'add_price', FILTER_SANITIZE_STRING);

		$sql = "INSERT INTO cd (artID, cdTitle, cdGenre, cdPrice) VALUES ((SELECT artID from Artist WHERE artName = '$artist'), '$title', '$genre', $price)";
		$stmt = $conn->prepare($sql);
		
		if ($conn->query($sql) === TRUE) {
    		echo "<script> console.log('Album: " .$title ." added successfully'); </script>";
		} else {
    		echo "Error adding record: " . $conn->error;
		}

		$result = album_display_table();
		return $result;
			

	}

				
?>
