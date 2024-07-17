<?php 
include 'connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $user_name = htmlspecialchars($_POST['user_name']);
  $user_email = htmlspecialchars($_POST['user_email']);
  $user_password = $_POST['user_password'];
  $user_confirm_password = $_POST['user_confirm_password'];

  if($user_password != $user_confirm_password){
    echo "<script>alert('Password and Confirm Password do not match');</script>";
  } else {
    // Check if email already exists
    $check_email = "SELECT * FROM users WHERE user_email='$user_email'";
    $result_email = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($result_email) > 0){
      echo "<script>alert('Email already exists');</script>";
      exit();
    } else {
      // Hash the password
      $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

      // Insert the new user
      $sql = "INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $user_name, $user_email, $hashed_password);

      if($stmt->execute()){
        header("Location: login.php");
        exit();
      } else {
        echo "Error: " . $stmt->error;
      }
      $stmt->close();
    }
  }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
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
                                <h2 class="text-uppercase text-center mb-5">Create an account</h2>
                                <form action="register.php" method="POST">
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="user_name" required />
                                        <label class="form-label" for="form3Example1cg">Your Name</label>
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="user_email" required />
                                        <label class="form-label" for="form3Example3cg">Your Email</label>
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="user_password" required />
                                        <label class="form-label" for="form3Example4cg">Password</label>
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" id="form3Example4cdg" class="form-control form-control-lg" name="user_confirm_password" required />
                                        <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                    </div>
                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" required />
                                        <label class="form-check-label" for="form2Example3cg">
                                            I agree to all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                    </div>
                                    <p class="text-center text-muted mt-5 mb-0">Already have an account? <a href="login.php" class="fw-bold text-body"><u>Login here</u></a></p>
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
