<?php

$npp = $_SESSION['id'];

if(isset($_GET['s']))
	$state = $_GET['s'];
else
	$state = 1;

?>

<div class="row">
	<div class="col-12">
		<div class="card card-chart" style="height: 100%;">
			<div class="card-header ">
				<div class="row">
					<div class="col-sm-12 text-left">
						<div class='row'>
							<div class='col-md-3'>
								<a href="?s=1" class="btn btn-info form-control">Add Item</a>
							</div>
							<div class='col-md-3'>
								<a href="?s=2" class="btn btn-info form-control">Loan</a>
							</div>
							<div class='col-md-3'>
								<a href="?s=3" class="btn btn-info form-control">Return</a>
							</div>
							<div class='col-md-3'>
								<a href="?s=4" class="btn btn-info form-control">Report</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<?php

if($state == 1)
{
	if(!isset($_GET['id']))
		include 'admin_add_item.php';
	else
		include 'admin_edit_item.php';
}
else if($state == 2)
	include 'admin_loan.php';
else if($state == 3)
	include 'admin_return.php';
else if($state == 4)
	include 'admin_report.php';
else 
	include 'admin_report.php';

?>

<!-- <div id="resultModal" class="modal fade" role="dialog" style="overflow-x:auto;">
	<div class="modal-dialog my-modal" style="margin:auto;max-width: 80%;">
		<div class="modal-content" id='result'>
		</div>	
	</div>
</div>

<div id="bimbinganModal" class="modal fade" role="dialog">
	<div class="modal-dialog my-modal" style="margin:auto;max-width: 80%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Kesimpulan Bimbingan</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="simpan_catatan.php">
					<table class='table' style="background-color: black">
						<tr> 
							<td> NIM </td>
							<td id='nim_bimbingan'> : 00.00.0000 </td>
						</tr>
						<tr>
							<td> Nama Mahasiswa </td>
							<td id='nama_bimbingan'> : NoobMaster </td>
						</tr>
						<tr>
							<td> Perihal Bimbingan </td>
							<td id='perihal_bimbingan'> : - </td>
					</table>
					<input type="hidden" id="id_request_bimbingan" name="id_request_bimbingan" value="test">
					<div class='form-group'>
						<label for="catatan">Catatan</label>
						<textarea type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan Bimbingan" style="resize: none; color:black;" required="true"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary form-control">Simpan Catatan</button>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>	
	</div>
</div>

<div id="seminarModal" class="modal fade" role="dialog">
	<div class="modal-dialog my-modal" style="margin:auto;max-width: 80%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Catatan dan Nilai Magang</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="simpan_seminar.php">
					<table class='table' style="background-color: black">
						<tr> 
							<td> NIM </td>
							<td id='nim_seminar'> : 00.00.0000 </td>
						</tr>
						<tr>
							<td> Nama Mahasiswa </td>
							<td id='nama_seminar'> : NoobMaster </td>
						</tr>
					</table>
					<input type="hidden" id="id_seminar" name="id_seminar" value="test">
					<div class='form-group'>
						<label for="catatan">Catatan</label>
						<textarea type="text" class="form-control" id="catatan_seminar" name="catatan" placeholder="Catatan Bimbingan" style="resize: none; color:black;" required="true"></textarea>
					</div>
					<div class='form-group'>
						<label for="catatan">Nilai Angka</label>
						<input type="number" name="nilai" id="nilai_seminar" class="form-control" required="true" style="color: black;">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary form-control">Simpan Catatan dan Nilai</button>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>	
	</div>
</div> -->