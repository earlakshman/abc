
<?php 
//db connection
$dbServer="localhost";
$dbUser="root";
$dbPass="";
$database="tableconnect";
//my sqli Connection

// if($conn){
//     echo 'Sucessess';
// }





error_reporting(0);

$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {

	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "./image/" . $filename;

	//$db = mysqli_connect("localhost", "root", "", "geeksforgeeks");
    $conn=mysqli_connect($dbServer,$dbUser,$dbPass,$database);
	// Get all the submitted data from the form
	$sql = "INSERT INTO myimage (imagefile) VALUES ('$filename')";

	// Execute query
	mysqli_query($conn, $sql);

	// Now let's move the uploaded image into the folder: image
	if (move_uploaded_file($tempname, $folder)) {
		echo "<h3> Image uploaded successfully!</h3>";
	} else {
		echo "<h3> Failed to upload image!</h3>";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Image Upload</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
	<div id="content">
		<form method="POST" action="" enctype="multipart/form-data">
			<div class="form-group">
				<input class="form-control" type="file" name="uploadfile" value="" />
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
			</div>
		</form>
	</div>
	<div id="display-image">
		<?php
		$query = " select * from myimage ";
		$result = mysqli_query($conn, $query);

		while ($data = mysqli_fetch_assoc($result)) {
		?>
			<img src="./image/<?php echo $data['imagefile']; ?>">
            <iframe src="./image/<?php echo $data['imagefile']; ?>">

		<?php
		}
		?>
	</div>
</body>

</html>
