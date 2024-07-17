
<?php 
include 'connection.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $user_email = htmlspecialchars($_POST['user_email']);
  $user_password = $_POST['user_password'];

  $check_email = "SELECT * FROM users WHERE user_email='$user_email'";
  $result_email = mysqli_query($conn, $check_email);
  if(mysqli_num_rows($result_email) > 0){
    
    $row = mysqli_fetch_assoc($result_email);
    if (password_verify($user_password, $row['user_password'])) {
      header("Location: index.php");
      exit();
    } else {
      echo "<script>alert('Email or Password is incorrect');</script>";
    }
  }
}
?>
<?php 
include 'connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $user_email = htmlspecialchars($_POST['user_email']);
  $user_password = $_POST['user_password'];

  // Check if email exists in the database
  $check_email = "SELECT * FROM users WHERE user_email='$user_email'";
  $result_email = mysqli_query($conn, $check_email);

  if(mysqli_num_rows($result_email) > 0){
    $row = mysqli_fetch_assoc($result_email);

    // Verify the password
    if (password_verify($user_password, $row['user_password'])) {
      header("Location: index.php");
      exit();
    } else {
      echo "<script>alert('Email or Password is incorrect');</script>";
    }
  } else {
    echo "<script>alert('Email or Password is incorrect');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css">
</head>
<body>
    <section class="vh-100 bg-image" style="background-image: url('images/your-image.webp');">
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
              <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">
                  <h2 class="text-uppercase text-center mb-5">Login</h2>
                  <form action="login.php" method="POST">
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="user_email" required />
                      <label class="form-label" for="form3Example3cg">Your Email</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="user_password" required />
                      <label class="form-label" for="form3Example4cg">Password</label>
                    </div>
                    <div class="d-flex justify-content-center">
                      <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
                    </div>
                    <p class="text-center text-muted mt-5 mb-0">Don't have an account? <a href="register.php"
                        class="fw-bold text-body"><u>Register here</u></a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="js/scripts.js"></script>
</body>
</html>
