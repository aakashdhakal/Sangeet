<?php
include "database.php";
header('Content-Type: application/json');


use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/phpmailer/src/Exception.php';
require 'vendor/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['action'] == "sendOtp") {

        $otpCode = rand(100000, 999999);
        $email = $_POST['email'];
        $purpose = $_POST['purpose'];
        $sql = "INSERT INTO verify_email (otp, email) VALUES ('$otpCode', '$email')";
        $result = mysqli_query($mysqli, $sql);
        $message = "Welcome to SANGEET <br>Thank you for registering with us. Please use the following One-Time Password (OTP) to complete your verification process:";

        if ($purpose == "forgot") {
            $message = "Please use the following One-Time Password (OTP) to reset your password:";
        }

        $htmlContent = "
      <!DOCTYPE html>
   <html lang='en'>

   <head>
       <meta charset='UTF-8'>
       <meta name='viewport' content='width=device-width, initial-scale=1.0'>
       <title>Document</title>
   </head>

   <body style='margin:auto;padding:20px;border:2px dashed black;width:40%;color:black;'>
           <img src='https://raw.githubusercontent.com/aakashdhakal/Music-streaming-site/refs/heads/main/public/images/logo-title-side.png' width='50%' style='margin-left: 7rem;'>
           <section id='body' style='width: 83%; padding: 40px; font-family:Tahoma; margin: auto;'>
               <p style='font-size: 1rem; font-weight: 500; letter-spacing: 1px; line-height: 2;'>Hello &nbsp;<span style='font-weight: 700;'>" . $username . "</span></p>
               <p style='font-size: 1rem; font-weight: 500; letter-spacing: 1px; line-height: 2;'>Welcome to SANGEET,<br> Your verification code is : <span style='font-weight: 70'>" . $otpCode . "</span></p>
               <p style='font-size: 1rem; font-weight: 500; letter-spacing: 1px; line-height: 2;'>Thank you <br> The SANGEET Team</p>
           </section>
           <hr style='width: 83%; margin: 30px auto 30px;'>
           <section id='copyright' style='width: 83%; margin: auto;'>
               <p style='width: 100%; font-size: 0.9rem; font-weight: 500; letter-spacing: 1px; line-height: 1.8; color: gray; text-align: center;'>Copyright &copy; " . date('Y') . " SANGEET. All rights reserved.</p>
           </section>

   </body>

   </html>

    ";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "anoother124@gmail.com";
        $mail->Password = "ailfbddokyddbqhh";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;

        $mail->setFrom("noreply@aakashdhakal.com.np");
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Welcome to SANGEET";
        $mail->Body = $htmlContent;

        if ($mail->send()) {
            echo json_encode(["status" => 200]);
        } else {
            echo json_encode(["status" => 400, "error" => $mail->ErrorInfo]);
        }
    } else if ($_POST['action'] == "verifyOtp") {
        $otp = $_POST['otp'];
        $email = $_POST['email'];

        $sql = "SELECT * FROM verify_email WHERE otp = ? AND email = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("is", $otp, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $sql = "SELECT * FROM verify_email WHERE otp = ? AND username = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("is", $otp, $username);
        $stmt->execute();
        $result = $stmt->get_result();


        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_assoc($result);
            $time = strtotime($result['time']);
            $curtime = time();
            $interval = $curtime - $time;
            echo $curtime . " " . $time > " " . $interval;
            if ($interval < 120) {
                $sql = "DELETE FROM verify_email WHERE otp = ? AND username = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("is", $otp, $username);
                $stmt->execute();
                echo json_encode(array("status" => 200));
            } else {
                echo "OTP expired";
            }

        } else {
            echo json_encode(["status" => 404, "error" => "Invalid OTP"]);
        }
    }
}
