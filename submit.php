<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate form data
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (empty($message)) {
        $errors[] = "Message is required";
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    } else {
        // Send email
        $to = "alberttadjei@gmail.com";
        $subject = "New message from $name";
        $body = "Name: $name\n";
        $body .= "Email: $email\n";
        $body .= "Message:\n$message";

        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            echo "<p>Message sent successfully!</p>";
        } else {
            echo "<p>Failed to send message. Please try again later.</p>";
        }
    }
} else {
    // Redirect to the form page if accessed directly
    header("Location: contact.html");
    exit;
}
?>

