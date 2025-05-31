<?php
// Include PHPMailer library files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Make sure to include the PHPMailer autoloader

$mail = new PHPMailer(true);    // Create a new PHPMailer instance

try {
    // Server settings
    $mail->isSMTP();                                        // Use SMTP
    $mail->Host = 'smtp.gmail.com';                           // SMTP server (for Gmail)
    $mail->SMTPAuth = true;                                  // Enable SMTP authentication
    $mail->Username = 'phmediabuying@gmail.com';             // Your Gmail email address
    $mail->Password = 'qdmgnltwpzfxswri';                    // Your Gmail email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Encryption: TLS (you can also use PHPMailer::ENCRYPTION_SMTPS for SSL)
    $mail->Port = 587;                                       // SMTP Port (587 for TLS, 465 for SSL)

    // Recipients
    $mail->setFrom('phmediabuying@gmail.com', 'Lavista el paito Website');  // Set the "From" address
    $mail->addAddress('phmediabuying@gmail.com', 'Recipient Name'); // Add recipient email

    // Content
    $mail->isHTML(true);                                      // Set email format to HTML
    $mail->Subject = 'New Lead From Lavista el paito Website';

    // Get form data
    $name  = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email  = trim($_POST['email']);

    // Prepare email body
    $message = "
    -------------------<br><br>
    Visitor name: $name <br>
    Visitor phone: $phone <br><br>
    // Visitor interested in email: $email <br><br>
    -------------------
    ";
    $mail->Body = $message;

    // Send the email
    if ($mail->send()) {
        // Redirect to thank you message and then to index.html
        $delay = 3;  // Delay before redirecting to index.html
    } else {
        // If email fails, set a shorter delay
        $delay = 3;
        $errorMessage = "Failed to send the email.";
    }
} catch (Exception $e) {
    $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $delay = 3;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .message {
            padding: 20px;
            color: black;
            font-size: 24px;
            border-radius: 10px;
            text-align: center;
            animation: fadeIn 3s ease-in-out forwards;
        }

        /* Animation to fade in and out the message */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            50% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(-30px);
            }
        }
    </style>
    <meta http-equiv="refresh" content="<?php echo $delay; ?>;url=index.html">
</head>
<body>

    <div class="message">
        <?php
        if (isset($errorMessage)) {
            echo "<strong>Error:</strong> " . $errorMessage;
        } else {
            echo "<div
            class='modal-body'
            style='
                padding: 50px;
                min-width: 500px;
                min-height: 500px;
                gap: 30px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            '
        >
            <img src='assets/img/check.png' />
            <h3>Thank You</h3>
            <h4>Your Form is Submitted we will contact you soon !</h4>
        </div>";
        }
        ?>
    </div>

</body>
</html>
