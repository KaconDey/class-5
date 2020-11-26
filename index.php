<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php
if(isset($_POST['btn'])){
	//print_r($_FILES); die();
	$type			= array('jpg','png');
	$imageName 		= $_FILES['image']['name'];
	$tem_location	= $_FILES['image']['tmp_name'];
	$directory		= 'images/';
	$image_type		= pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
	$image_size		= $_FILES['image']['size'];
	$image_url		= $directory.$imageName;	
	
	if($imageName != null){
		if(file_exists($image_url)){
			$imageErr	= 'file already exists';
		}elseif($image_size > 1000000 ){
			$imageErr	= 'Image should not be greeter then 1 mb';
		}elseif(!in_array($image_type,$type)){
			$imageErr	= 'Image should be jpg or png extension';
		}else{
			move_uploaded_file($tem_location,$image_url);
			$ingOk	= 'Image Uploaded sucessfully';
		}
	}else{
		$imageErr	= 'Please select a img file';
	}
}
?>
	<div class="container mt-3">
		<h2>Image Upload</h2>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
				<p> custom file:</p>
				<div class="custom-file mb-3">
					<input type="file" class="custom-file-input" id="customFile" name="image" accept="image/*">
					<label class="custom-file-label" for="customFile">Choose File</label>
				</div>
				<div class="mt-3">
					<button type="submit" class="btn btn-primary" name="btn">Submit</button>
				</div>	
			</form>
	</div>
	<div class="container mt-3">
		<div class="row">
			<?php
				$dirname	='images/';
				$images		=glob($dirname."*.{jpg,jpeg,png}",GLOB_BRACE);
				foreach($images as $image){
			?>
				<div class="col-md-4">
					<?php
					echo '<img class="" src="'.$image.'" width="100% height="250px">';
					echo pathinfo($image, PATHINFO_FILENAME);
					?>
				</div>
			<?php
				}
			?>	
		</div>
	</div>

</body>
</html>