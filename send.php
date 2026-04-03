<?php
// تأكد أن تضع مكتبة PHPMailer التي تم تنزيلها من:
// https://github.com/PHPMailer/PHPMailer/archive/refs/heads/master.zip
// ثم أفك الضغط في: c:\xampp\htdocs\protfil\PHPMailer

$phar = __DIR__ . '/PHPMailer-master/src';
$autoload = __DIR__ . '/vendor/autoload.php';

if (file_exists($autoload)) {
    require $autoload;
} elseif (file_exists($phar . '/Exception.php') && file_exists($phar . '/PHPMailer.php') && file_exists($phar . '/SMTP.php')) {
    require $phar . '/Exception.php';
    require $phar . '/PHPMailer.php';
    require $phar . '/SMTP.php';
} else {
    die("PHPMailer not found. Place PHPMailer files in c:\\xampp\\htdocs\\protfil\\PHPMailer-master\\src or run 'composer require phpmailer/phpmailer'.");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function safe($v) {
    return htmlspecialchars(trim($v), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

$name = safe($_POST['name'] ?? '');
$email = safe($_POST['email'] ?? '');
$message = safe($_POST['message'] ?? '');

$errors = [];

if (strlen($name) < 2) {
    $errors[] = 'Name is too short.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email.';
}
if (strlen($message) < 5) {
    $errors[] = 'Message is too short.';
}

if (empty($errors)) {
    $subject = 'New message from website form';
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ninoa8011@gmail.com'; // غيّر إلى بريدك
        $mail->Password = 'cjkh dcad rzvg tfuh'; // استخدم App Password من جوجل
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('ninoa8011@gmail.com', 'Website Contact');
        $mail->addAddress('ninoa8011@gmail.com', 'مستلم الرسائل');
        $mail->addReplyTo($email, $name);

        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        $success = true;
    } catch (Exception $e) {
        $errors[] = 'Unable to send email. Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Contact sent</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
      body { font-family: Arial, sans-serif; padding: 2rem; text-align: center; }
      .box { max-width: 500px; margin: auto; border: 1px solid #ddd; padding: 1.5rem; }
      .success { color: green; }
      .errors { color: red; text-align: left; margin-top: 1rem; }
      a { display: inline-block; margin-top: 1rem; color: #2d7df6; }
    </style>
  </head>
  <body>
    <div class="box">
      <?php if (!empty($success)): ?>
        <h1 class="success">Message sent!</h1>
        <p>Thank you, <?= $name ?>. We received your message and will reply soon.</p>
      <?php else: ?>
        <h1 class="errors">Something went wrong</h1>
        <div class="errors">
          <ul>
            <?php foreach ($errors as $error): ?>
              <li><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      <a href="index.html">Back to site</a>
    </div>
  </body>
</html>
