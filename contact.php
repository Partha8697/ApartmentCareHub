<?php require_once "process-signup.php"; ?>
<?php 

$email = $_SESSION['email'];
$password = $_SESSION['password'];

if (!isset($_SESSION['user_loggedin']) || $_SESSION['user_loggedin'] !== true) {
  header("Location: index.php");
  exit();
}

if($email != false && $password != false) {
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified") {
            if($code != 0) {
                header('Location: user-reset-code.php');
            }
        } else {
            header('Location: user-otp.php');
        }
    }
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css?v=1" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="content">
        <div class="left-side">
          <div class="address details">
            <i class="fas fa-map-marker-alt"></i>
            <div class="topic">Address</div>
            <div class="text-one">Surkhet, NP12</div>
            <div class="text-two">Birendranagar 06</div>
          </div>
          <div class="phone details">
            <i class="fas fa-phone-alt"></i>
            <div class="topic">Phone</div>
            <div class="text-one">+0098 9893 5647</div>
            <div class="text-two">+0096 3434 5678</div>
          </div>
          <div class="email details">
            <i class="fas fa-envelope"></i>
            <div class="topic">Email</div>
            <div class="text-one">complaintbooking@gmail.com</div>
            <div class="text-two">complaint.booking.system@gmail.com</div>
          </div>
        </div>
        <div class="right-side">
          <div class="topic-text">Send us a message</div>
          <p>Please share your feedback here or if you have any types of quries related to Complaint Booking, you can send message from here</p>
          <form action="contact.php" method="POST" novalidate>
            <div class="input-box">
              <input type="text" name="name" placeholder="Enter your name">
            </div>
            <div class="input-box">
              <input type="text" name="email" placeholder="Enter your email" />
            </div>
            <div class="input-box message-box">
              <textarea name="msg" placeholder="Enter your message"></textarea>
            </div>
            <div class="button">
              <button type="submit" name="send" value="Send">Send</button>
              <button type="button" onclick="window.location.href='home.php'">Back</button>
            </div>
          </form>
        </div>
      </div>
    </div>  
  </body>
</html>
