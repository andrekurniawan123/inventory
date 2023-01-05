<?php 
include 'conn.php';
include 'fungsi.php';

if(!isset($_SESSION['user_email_address']))
  header("Location:login.php");

$email = $_SESSION['user_email_address'];

$sql = "SELECT * FROM t_user WHERE email = '$email'";
$query = mysqli_query($conn, $sql);

$role = "user";

if(mysqli_num_rows($query)>0)
{
  $row = mysqli_fetch_array($query);
  $status = $row['status'];
  if($status == 1)
    $role = "admin";

  $_SESSION['id'] = $row['id'];
}
else
{
  $sql_insert = "INSERT INTO t_user (email) VALUES ('$email')";
  $query_insert = mysqli_query($conn, $sql_insert);
  
  $get_id = "SELECT id FROM t_user WHERE email = '$email'";
  $query_get_id = mysqli_query($conn, $get_id);
  $row_get_id = mysqli_fetch_array($query_get_id);
  $_SESSION['id'] = $row_get_id['id'];
}

$nama_array = explode("@", $email);
$nama = $nama_array[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Sistem Inventaris SIEGA
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
  <script type="text/javascript">
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
  </script>
  
</head>
<?php 
include 'javascript.php';
?>

<body class="">
  <div class="d-flex" id="wrapper">
    <!-- Sidebar-->
    <div class="border-end bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-light">INVENTARIS</div>
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?php echo $rekaman_sosialisasi;?>" target="_blank">PANDUAN</a>
        </div>
    </div>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <p>Hai, <?php echo $email;?></p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Panduan</a>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo $rekaman_sosialisasi;?>" target="_blank">Rekaman Sosialisasi</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo $alur_magang;?>" target="_blank">Alur Magang</a>
                        <a class="dropdown-item" href="<?php echo $panduan_magang;?>" target="_blank">Panduan Magang</a>
                        <a class="dropdown-item" href="<?php echo $penyusunan_laporan;?>" target="_blank">Panduan Penyusunan Laporan</a>
                      </div>
                    </li>
                    
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dokumen</a>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="<?php echo $format_laporan;?>" target="_blank">Format Laporan Ver 2.2</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?php echo $surat_pengantar;?>">Surat Pengantar</a>
                          <a class="dropdown-item" href="<?php echo $form_nilai;?>" target="_blank">Form Nilai Magang</a>
                          <a class="dropdown-item" href="<?php echo $form_selesai;?>" target="_blank">Form Selesai Magang</a>
                      </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="index.php?s=3">Presensi</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
      <?php 
        if($role == "admin")
          include 'admin.php';
        else if($role == "user")
          include 'user.php';
        else
          header("Location:login.php");
      ?>  
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 80%;">
    <div class="modal-content" id="result" style="background-color: white;">
      
    </div>
  </div>
</div>


</body>
</html>