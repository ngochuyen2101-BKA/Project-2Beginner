<?php
require 'db_config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["email"])) {
    $sql = "select quyen from dangnhap where Username = '" . $_POST["email"] . "'";
    $rs = $mysqli->query($sql);
    if ($rs->num_rows > 0) {
        $row = $rs->fetch_row();
        $quyen = $row[0];
        $flag = true;
        if ($quyen = 2) {
            $sql = "select kichhoat from nguoihoc where Email = '".$_POST["email"]."'";
            $rs = $mysqli->query($sql);
            $rows = $rs->num_rows;
            $row = $rs->fetch_row();
            if ($row[0] == 0) {
                $flag = false;
                $result = "Your email haven't been actived. Please check email to finish activation.";
            }
        }
        if ($flag == true) {
            $hash = urlencode('email=' . $_POST["email"]);
            $link = 'http://localhost:81/tienganh/resetpassword.php?' . $hash;
            require 'PHPMailer/PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/PHPMailer/src/SMTP.php';
            require 'PHPMailer/PHPMailer/src/Exception.php';
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = '2beginnervn@gmail.com';                 // SMTP username
                $mail->Password = '2beginner123*';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to
                //Recipients
                $mail->setFrom('2beginnervn@gmail.com');
                $mail->addAddress($_POST['email']);     // Add a recipient
                $mail->Subject = 'Reset password';
                $mail->Body = 'We received a request to reset your password. If you sent, please click this link to reset your password: ' . $link . ' If not, you can ignore this email. Thank you, 2Beginner Team';
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                if (!$mail->send()) {
                    $result = "We can't send mail for you. Please try again!";
                    exit();
                } else {
                    $result = "success";
                }
            } catch (Exception $e) {
                $result = "We can't send mail for you. Please try again! ".$e->getMessage();
            }
        }
    } else {
        $result = "Your email doesn't exist in our website!";
    }
    echo json_encode($result);
}

?>