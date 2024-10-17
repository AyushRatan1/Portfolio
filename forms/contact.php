<?php
/**
 * Requires the "PHP Email Form" library
 * The "PHP Email Form" library is available only in the pro version of the template
 * The library should be uploaded to: vendor/php-email-form/php-email-form.php
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */

// Replace this email address with Dr. Prabhat Kumar Sinha's real receiving email address
$receiving_email_address = 'sinhapk359@gmail.com';

// Check if the PHP Email Form library exists
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

// Set the recipient email address and other details
$contact->to = $receiving_email_address;
$contact->from_name = htmlspecialchars(strip_tags($_POST['name']));
$contact->from_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$contact->subject = htmlspecialchars(strip_tags($_POST['subject']));

// Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
/*
$contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
);
*/

// Add messages with sanitization for security
$contact->add_message($contact->from_name, 'From');
$contact->add_message($contact->from_email, 'Email');
$contact->add_message(htmlspecialchars(strip_tags($_POST['message'])), 'Message', 10);

// Send the email and output the result
echo $contact->send();
?>
