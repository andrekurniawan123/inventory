<?php
	if(isset($_POST['submit']))
	{
		$category 	= $_POST['category'];
		$inv_num 	= $_POST['inv_num'];
		$name 		= $_POST['name'];
		$description= $_POST['description'];
		$total 		= $_POST['total'];

		$file_name = str_replace("/", "-", $inv_num);

		$target_dir = "uploads/";
		$target_file = $target_dir . $file_name ." - ". basename($_FILES["img"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		echo "<div class='container'>";

		// echo $target_file;
		// Check if file already exists
		if (file_exists($target_file)) {
		  	echo "Sorry, file already exists.<br>";
		  	$uploadOk = 0;
		}

		// Check file size
		if ($_FILES["img"]["size"] > 1000000) {
		  	echo "Sorry, your file is too large, Max 1 MB.<br>";
		  	$uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "jpeg") {
		  	echo "Sorry, only JPG, JPEG files are allowed.<br>";
		  	$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  	echo "Sorry, your file was not uploaded.<br>";
		// if everything is ok, try to upload file
		} else {
	  		if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
		    	$sql_insert = "INSERT INTO t_item (category, inv_num, name, description, total, img) VALUES ('$category', '$inv_num', '$name', '$description', '$total', '$target_file')";
		    	$query_insert = mysqli_query($conn, $sql_insert);
		    	
		    	$sql_get_id = "SELECT id FROM t_item WHERE inv_num = '$inv_num'";
		    	$query_get_id = mysqli_query($conn, $sql_get_id);
		    	$row_get_id = mysqli_fetch_array($query_get_id);
		    	$new_id = $row_get_id['id'];
		    	$description = "Inserted new item ".$name." total ".$total." item.";

		    	$sql_insert_log = "INSERT INTO t_log (id_item, description) VALUES ('$new_id', '$description')";
		    	$query_insert_log = mysqli_query($conn, $sql_insert_log);


		    	echo "<script>alert('Upload Successfully');window.location.reload();</script>";
		    	// echo "Upload Successfully.<br>";	
		  	} else {
		    	echo "Sorry, there was an error uploading your file.<br>";
		  	}
		}
		echo "</div>";
	}
?>
<script type="text/javascript">
	function GenerateInvNum()
	{
		var category = document.getElementById("category").value;
		var type = document.getElementById("type").value;
		$.ajax({
			type: "POST",
			url: "api_inv_num.php", 
			data: {
				id_category : category,
				id_type : type
			},
			success: function(result){
				var result_div = document.getElementById("inv_num");
				result_div.value = result;
			}
		});
	}
</script>
<div class='container'>
	<h2>Form Input Inventory</h2>
	<form action="#" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="form-group">
				<label>Category</label>
				<select id="category" name="category" class="form-control" onchange="GenerateInvNum()" required>
					<option value="">--Pilih Kategori--</option>
					<?php
						$get_category = "SELECT * FROM t_category";
						$query_category = mysqli_query($conn, $get_category);
						while ($row_category = mysqli_fetch_array($query_category)) {
							echo "<option value='".$row_category['id']."'>".$row_category['category']." (".$row_category['code'].")</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<label>Type</label>
				<select id="type" name="type" class="form-control" onchange="GenerateInvNum()" required>
					<option value="">--Pilih Jenis--</option>
					<?php
						$get_type = "SELECT * FROM t_type";
						$query_type = mysqli_query($conn, $get_type);
						while ($row_type = mysqli_fetch_array($query_type)) {
							echo "<option value='".$row_type['id']."'>".$row_type['type']." (".$row_type['code'].")</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<label>Inventory Number</label>
				<input type="text" id="inv_num" name="inv_num" class='form-control' readonly required>
			</div>
		</div>
		<div class="row">
			<div class="form-group">
				<label>Item Name</label>
				<input type="text" name="name" class='form-control' required>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label>Description</label>
				<textarea name="description" class="form-control" required></textarea>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label>Total Item</label>
				<input type="number" name="total" min='1' class='form-control' required>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label>Image</label>
				<input type="file" name="img" class='form-control' required accept="image/jpeg">
				<small>File Size Max 1 MB, Format jpeg</small>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<input type="submit" name="submit" value='Simpan' class='form-control btn btn-success'>
			</div>
		</div>
	</form>
</div>


<?php

$sql_data = "SELECT * FROM t_item";
$query_data = mysqli_query($conn,$sql_data);
echo "<div class='container' style='margin-top:15px'>";
echo "<h2>Inventory Table</h2>";
if(mysqli_num_rows($query_data)>0)
{
	echo "<table class='table table-striped'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>No</th>";
	echo "<th>Inventory Number</th>";
	echo "<th>Item Name</th>";
	echo "<th>Description</th>";
	echo "<th>Total</th>";
	echo "<th>Image</th>";
	echo "<th>Edit Total</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	$i = 0;
	while ($row_data = mysqli_fetch_array($query_data)) {
		$i ++;
		$id = $row_data['id'];
		echo "<tr>";
		echo "<td>".$i."</td>";
		echo "<td>".$row_data['inv_num']."</td>";
		echo "<td>".$row_data['name']."</td>";
		echo "<td>".$row_data['description']."</td>";
		echo "<td>".$row_data['total']."</td>";
		echo "<td><img src='".$row_data['img']."' style='height:100px;'></td>";
		echo "<td><a href='index.php?s=1&id=".$id."'>Edit</a></td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
}
else
{
	echo "Tidak ditemukan data.";
}
echo "</div>";
?>
