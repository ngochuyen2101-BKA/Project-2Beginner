<?php
/* Gửi mail nhắc nhở những người học không vào học > 10 ngày*/
require 'db_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$date = date_create();
date_sub($date,date_interval_create_from_date_string("10 days"));
$dangXuat = date_format($date,"Y-m-d H:i:s");
$sql = "Select Email from nguoihoc where kichhoat = 1 and DangXuatCuoi < '".$dangXuat."'";
$rs = $mysqli->query($sql);
if ($rs->num_rows > 0) {
    require 'PHPMailer/PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/PHPMailer/src/SMTP.php';
    require 'PHPMailer/PHPMailer/src/Exception.php';
    $link = 'http://localhost:81/tienganh/index.php';
    while ($row = mysqli_fetch_array($rs)) {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                              // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = '2beginnervn@gmail.com';                 // SMTP username
            $mail->Password = '2beginner123*';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('2beginnervn@gmail.com');
            $mail->addAddress($row[0]);     // Add a recipient
            $mail->Subject = 'Hello '.$row[0];
            $mail->Body = 'Long time no see you, come back to continue to practice skills with us. Please click this link to comeback: '.$link.' ';

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            if (!$mail->send()) {
                echo $row[0]." - failed<br>";
            } else {
                echo $row[0]." - success<br>";
            }
        } catch (Exception $e) {
            echo $e->errorMessage();
        }
    }
}
?>