<?php
session_start();
if(!isset($_SESSION['username'])){
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else{
	?>
<?php
require_once('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Welcome Admin</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Profile</a></li>
    <li><a data-toggle="tab" href="#menu2">Upload</a></li>
    <li style="float:right;"><a href="logout.php">Logout</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Home</h3>
	</div>

    <div id="menu1" class="tab-pane fade">
      <h3>Profile</h3>
      <table class="table">
    <thead>
      <tr>
        <th>id</th>
        <th>Name</th>
		<th>Email</th>
		<th>Image</th>
      </tr>
    </thead>
    <tbody>
	
  </table>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Upload</h3>
      <form action="index.php" method="post" enctype="multipart/form-data">
  
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
    <input class="btn btn-primary" type="submit" value="Upload Image" name="submit">
      </form>
    </div>
    
	</div>
  </div>
</div>

</body>
</html>
<?php
if(isset($_POST['submit'])){
	$file=$_FILES['fileToUpload']['name'];
	$file_tmp=$_FILES['fileToUpload']['tmp_name'];

	move_uploaded_file($file_tmp,"uploads/$file");
	$insert="INSERT INTO `tbl_uploads`(file) VALUES ('$file')";
	$insert_img=mysqli_query($connection,$insert);
	if($insert_img){
	   
	   echo "<script>alert('file has been uploaded!')</script>";
	   echo " <script>window.open('index.php?insert_file','_self')</script>";
   }
   
   
}
?>
<?php } ?>