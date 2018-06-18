<?php
/* Gửi mail nhắc nhở người học những từ người đó đã học*/
require 'db_config.php';
$link = 'http://localhost:81/tienganh/index.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$sql = "Select Email,MaNH from nguoihoc where kichhoat = 1";
$rs = $mysqli->query($sql);
if ($rs->num_rows > 0) {
    require 'PHPMailer/PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/PHPMailer/src/SMTP.php';
    require 'PHPMailer/PHPMailer/src/Exception.php';
    while ($row = mysqli_fetch_array($rs)) {
        $email = $row[0];
        $manh = $row[1];
        $sql1 = "Select Tu from tuvung where MaNH = ".$manh;
        $rs1 = $mysqli->query($sql1);
        if ($rs1->num_rows > 0) {
            $list = "";
            while ($row1 = mysqli_fetch_array($rs1)) {
                $list .= $row1[0].", ";
            }
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
                $mail->addAddress($row['Email']);     // Add a recipient
                $mail->Subject = 'Remember your word';
                $mail->Body = 'Congratulations on learning these new words: '.$list.'.Please continue to improve your skills at: '.$link.' ';

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
}
?>