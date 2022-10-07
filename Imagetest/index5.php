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
    $name=$_POST['uname'];

	//$db = mysqli_connect("localhost", "root", "", "geeksforgeeks");
    $conn=mysqli_connect($dbServer,$dbUser,$dbPass,$database);
	// Get all the submitted data from the form
	$sql = "INSERT INTO myimage (imagefile,Name) VALUES ('$filename','$name')";

	
	

	// Now let's move the uploaded image into the folder: image
	if (move_uploaded_file($tempname, $folder)) {
		echo "<h3> Image uploaded successfully!</h3>";
        // Execute query
        mysqli_query($conn, $sql);
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
	<link href="index5.css" rel="stylesheet">
    <style>
        

    </style>
</head>

<body>
	<div id="content">
		<form method="POST" action="" enctype="multipart/form-data">
			<div class="form-group">
				<input class="form-control" type="file" name="uploadfile" value="" /><br>
                <input class="form-control" type="text" name="uname" value="" />
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
		
        

            // echo "<div class='responsive'>
            //     <div class='gallery'>
            //     <a target='_blank' href='./image/".$data['imagefile']."'>
            //     <img src='./image/".$data['imagefile']."' width='600' height='400'>
            //     </a>
            // <div class='desc'>".$data['Name']."</div>
            // </div>
            // </div>";

            // echo "<div class='container'>
            // <img src='./image/".$data['imagefile']."'  style='width:90px'>
            // <p><span>".$data['Name']."</span> CEO at Mighty Schools.</p>
            // <p>".$data['Name']."saved us from a web disaster.</p>
            // </div>";

            
          echo  "
              <div class='column'>
                <div class='content'>
                  <img src='./image/".$data['imagefile']."'  style='width:100%'>
                  <h3>".$data['Name']."</h3>
                  <p>".$data['Name']."Lorem ipsum dolor sit amet, tempor prodesset eos no. Temporibus necessitatibus sea ei, at tantas oporteat nam. Lorem ipsum dolor sit amet, tempor prodesset eos no.</p>
                </div>
              
              
              </div>";
            


		}
		?>
	</div>
</body>

</html>
