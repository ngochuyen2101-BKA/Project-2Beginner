<?php
require 'db_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST["email"])) {
    $sql = "insert into dangnhap (Username, Password, quyen) values ('".$_POST["email"]."','".$_POST["password"]."',2)";
    $rs = $mysqli->query($sql);
    if ($rs) {
        $sql = "insert into nguoihoc (HoTen,Email,DangXuatCuoi,levelspeak,levellisten,kichhoat) values ('" . $_POST["name"] . "','" . $_POST["email"] . "',null,1,1,0)";
        $rs = $mysqli->query($sql);
        if ($rs) {
            $sql = "select MaNH from nguoihoc where Email = '" . $_POST["email"] . "'";
            $rs1 = $mysqli->query($sql);
            $row = $rs1->fetch_row();
            $hash = urlencode('manh='.$row[0]);
            $link = 'http://localhost:81/tienganh/confirm.php?'.$hash;
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
                $mail->Subject = 'Confirm account';
                $mail->Body = 'Thank you for registering with 2Beginner. Please click this link to finish your registration: '.$link.' Wish you have a good time when learning at our website. Thank you, 2Beginner Team';
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                if (!$mail->send()) {
                    $sql = "delete from dangnhap where Username = '".$_POST["email"]."'";
                    $rs = $mysqli->query($sql);
                    $result = "We can't send mail for you. Please try register again!";
                    exit();
                } else {
                    $result = "success";
                }
            } catch (Exception $e) {
                $sql = "delete from dangnhap where Username = '".$_POST["email"]."'";
                $rs = $mysqli->query($sql);
                $result = "We can't send mail for you. Please try register again!";
            }
        } else {
            $sql = "delete from dangnhap where Username = '".$_POST["email"]."'";
            $rs = $mysqli->query($sql);
            $result = "Can't create your account. Please try again!";
        }
    }
    else {
        $result = "Your email must be used in our website. Try with other.\n".mysqli_error($mysqli);
        $sql = "delete from dangnhap where Username = '".$_POST["email"]."'";
        $rs = $mysqli->query($sql);
    }
    echo json_encode($result);
}
?>