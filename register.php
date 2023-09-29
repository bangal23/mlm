<?php
    include 'conn.php';

    $koneksi = bukaKoneksi();

    $newid = $_POST['id'];
    $nama = $_POST['name'];
    $alamat = $_POST['address'];
    $hp = $_POST['phone'];
    $upline = $_POST['upline'];

    try {
        // Membuat kueri SQL
        $sql = "SELECT * FROM tb_members WHERE id = :upline";
        $stmt = $koneksi->prepare($sql);
        $stmt->bindParam(':upline', $upline, PDO::PARAM_INT);
        $stmt->execute();
    
        // Memeriksa apakah ada hasil
        if ($stmt->rowCount() > 0) {
            // Mengambil hasil kueri dalam bentuk asosiatif
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $downline1 = $row['downline1'];
            $downline2 = $row['downline2'];

            // Memeriksa apakah downline1 atau downline2 adalah NULL
            if ($downline1 === NULL) {
                $stmt = $koneksi->prepare("INSERT INTO tb_members (id, nama, alamat, notelp, upline_id) VALUES (:newid, :nama, :alamat, :hp, :upline)");
                $stmt->bindParam(':newid', $newid, PDO::PARAM_STR);
                $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
                $stmt->bindParam(':alamat', $alamat, PDO::PARAM_STR);
                $stmt->bindParam(':hp', $hp, PDO::PARAM_STR);
                $stmt->bindParam(':upline', $upline, PDO::PARAM_STR);
                $stmt->execute();

                $stmt = $koneksi->prepare("UPDATE tb_members SET downline1 = :newid WHERE id = :upline");
                $stmt->bindParam(':newid', $newid, PDO::PARAM_STR);
                $stmt->bindParam(':upline', $upline, PDO::PARAM_STR);
                $stmt->execute();

                $pesan = "Registration Complete, Save your ID " . $newid . " and wait for your Mentor Call, Thank you";
            } else if ($downline2 === NULL) {
                $stmt = $koneksi->prepare("INSERT INTO tb_members (id, nama, alamat, notelp, upline_id) VALUES (:newid, :nama, :alamat, :hp, :upline)");
                $stmt->bindParam(':newid', $newid, PDO::PARAM_STR);
                $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
                $stmt->bindParam(':alamat', $alamat, PDO::PARAM_STR);
                $stmt->bindParam(':hp', $hp, PDO::PARAM_STR);
                $stmt->bindParam(':upline', $upline, PDO::PARAM_STR);
                $stmt->execute();

                $stmt = $koneksi->prepare("UPDATE tb_members SET downline2 = :newid WHERE id = :upline");
                $stmt->bindParam(':newid', $newid, PDO::PARAM_STR);
                $stmt->bindParam(':upline', $upline, PDO::PARAM_STR);
                $stmt->execute();
                $pesan = "Registration Complete, Save your ID " . $newid . " and wait for your Mentor Call, Thank you";
            } else {
                $pesan = "Sorry, the Upline ID you have used is already at full capacity. Please find another Upline ID below";
            }
        }else {
            $pesan = "Sorry, the Upline ID you have used is not available. Please fill your form correctly.";
        }
    }catch (PDOException $e) {
        $pesan = "Error: Please <a href='index.php'>Click Here</a> to try new Registration Form ";  //$e->getMessage();
    }


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  </head>
  <body>
    <h5 class="text-center mb-3" style="margin-top: 300px;"><?= $pesan; ?></h5>
    <p class="text-center"><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Click here for all data info.</button></p>
    
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data List</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Upline ID</th>
                            <th>Downline ID 1</th>
                            <th>Downline ID 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $alldata = tampilSemuaData(); foreach($alldata as $row){ ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['alamat']; ?></td>
                            <td><?= $row['notelp']; ?></td>
                            <td><?= $row['upline_id']; ?></td>
                            <td><?= $row['downline1']; ?></td>
                            <td><?= $row['downline2']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Upline ID</th>
                            <th>Downline ID 1</th>
                            <th>Downline ID 2</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript">
        new DataTable('#example')
    </script>


</body>
</html>