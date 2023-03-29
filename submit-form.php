<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    
    // Google reCAPTCHA validation
    $secretKey = "6LeXATglAAAAAKUCEAxF8rfJn7ZUTx__y0M9MM7O";
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $response = json_decode($response);
    if (!$response->success) {
        echo "Sorry, there was an error with the reCAPTCHA verification. Please try again.";
        exit;
    }

    // Set the recipient email address
    $to = "recipient@example.com";

    // Set the email subject
    $subject = "New message from " . $name;

    // Set the email message
    $message = "Name: " . $name . "\nEmail: " . $email . "\nMessage: " . $message;

    // Set the email headers
    $headers = "From: " . $email;

    // Send the email using the mail() function
    if (mail($to, $subject, $message, $headers)) {
        echo "Your message has been sent successfully.";
    } else {
        echo "Sorry, there was a problem sending your message. Please try again.";
    }
}
?>
