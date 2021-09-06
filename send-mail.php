<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require 'vendor/autoload.php';
$CSVfp = fopen("name.csv", "r");
 if($CSVfp !== FALSE) {
   $cnt=0;
  while(! feof($CSVfp)) {
   $data = fgetcsv($CSVfp, 1000, ",");

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
$sender = 'kimberly.kubosiak@aic.edu';
$senderName = 'Mahir Shahriar';

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
$recipient = $data[0];

// Replace smtp_username with your Amazon SES SMTP user name.
$usernameSmtp = 'kimberly.kubosiak@aic.edu';

// Replace smtp_password with your Amazon SES SMTP password.
$passwordSmtp = 'FestiveandLiza1';

// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
// $configurationSet = 'ConfigSet';

// If you're using Amazon SES in a region other than US West (Oregon),
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
// endpoint in the appropriate region.
$host = 'smtp.office365.com';
$port = 587;

// The subject line of the email
$subject = 'Higgsino Bio Camp';

// The plain-text body of the email
$bodyText =  "Higgsino Bio Camp registration going on";

// The HTML-formatted body of the email
$bodyHtml = '
<h1>Higgsino Biology Camp</h1>


<p>As curious as you are about this mysterious creature? Want to be the best at the Biology Olympiad? What if the key to being the best can be taken from the best?</p>


 
<p>The Higgsino Science Society is going to organize a colorful 15-day "Higgsino Bio-Camp". Bringing medals for the country in the International Olympiad, Master Camper of Bangladesh Biology Olympiad, renowned and experienced teachers with campers are staying at Higgsino Bio Camp!It\'s like learning from the best! Don\'t miss out on the opportunity to learn from the best. The Higgins Biology Camp will cover basic to advanced topics. There will be 6 separate sessions on Theory and Problem Solving Learn advanced things and make a bet in Biology Olympiad!<p>
<ul>
<li>15 days long bio camp</li>
<li>there are more than 20 sessions</li>
<li>different sessions according to topics</li>
<li>extra problem solving sessions</li>
<li>a lots of resources & notes</li>
<li>guideline for biology olympiad</li>
<li>gifts for the winners of the camp test</li>
<li>registratiom fee only 250 taka</li>
</ul>
﻿

﻿

Last date of registration is 
15 September 2021
﻿

﻿
<br>
<a href="https://hssbd.org/bio-camp">tap here for registration</a>'; 

$mail = new PHPMailer(true);

try {
    // Specify the SMTP settings.
    $mail->isSMTP();
    $mail->setFrom($sender, $senderName);
    $mail->Username   = $usernameSmtp;
    $mail->Password   = $passwordSmtp;
    $mail->Host       = $host;
    $mail->Port       = $port;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'tls';
    $cnt+=1;
    // $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

    // Specify the message recipients.
    $mail->addAddress($recipient);
    // You can also add CC, BCC, and additional To recipients here.

    // Specify the content of the message.
    $mail->isHTML(true);
    $mail->Subject    = $subject;
    $mail->Body       = $bodyHtml;
    $mail->AltBody    = $bodyText;
    $mail->Send();
    echo "{$cnt} Email sent to {$recipient}" , PHP_EOL;
} catch (phpmailerException $e) {
    echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
} catch (Exception $e) {
    echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
}
}
}
fclose($CSVfp);
?>

