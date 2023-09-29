<!doctype html>
<?php include "conn.php"; ?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">


    <title>MLM</title>
  </head>
  <body>
    <h1 class="text-center mt-5 mb-5">Welcome to our Multilevel Marketing</h1>

    <div class="card mx-auto" style="width: 40%;">
     <div class="card-header">
        <h5 class="text-center">Register and become a Millionaire</h5>
     </div>

     <div class="card-body">
      <form action="register.php" method="post">
          <div class="mb-3">
            <label for="get_random_id" class="form-label">ID <small>(automatic from server)</small></label>
            <input type="text" class="form-control" id="get_random_id" value="<?php getRandomNumber(); ?>" name="id" readonly>
          </div>
          <div class="mb-3">
            <label for="fullname" class="form-label">Fullname</label>
            <input type="text" class="form-control" id="fullname" name="name" required placeholder="Ex: Bambang Pamungkas">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required placeholder="Ex: Jalan Kelas Kakap Nomor 5A">
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" pattern="[0-9]{10,}" placeholder="Ex: 081378xxx" required>
          </div>
          <div class="mb-3">
            <label for="upline" class="form-label">Upline ID <small>(5 digit)</small></label>
            <input type="text" class="form-control" id="upline" name="upline" pattern="[0-9]{5}"  placeholder="Your Mentor ID" required>
          </div>
       
     </div>

     <div class="card-footer">
      <input type="submit" class="btn btn-primary float-end" value="Register">
      </form>
     </div>
 </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>

  </body>
</html>