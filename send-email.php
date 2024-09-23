<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = strip_tags(trim($_POST["firstname"]));
    $lastName = strip_tags(trim($_POST["lastname"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));

    // Check if data is valid
    if (empty($firstName) || empty($lastName) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        echo "Please complete the form and try again.";
        exit;
    }

    // Email settings
    $to = "startups@digitalassetstudios.xyz";  // Your email address
    $emailSubject = !empty($subject) ? $subject : "New Contact Form Submission";
    $emailContent = "Name: $firstName $lastName\n";
    $emailContent .= "Email: $email\n\n";
    $emailContent .= "Message:\n$message\n";

    // Email headers
    $headers = "From: $firstName $lastName <$email>";

    // Send the email
    if (mail($to, $emailSubject, $emailContent, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
} else {
    echo "There was a problem with your submission, please try again.";
}
?>
