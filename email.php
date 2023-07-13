<?php
if (isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['subject']) && isset($_REQUEST['text'])) {
    // Set the email addresses where you want to receive the texts
    $email1 = 'message.abdulazeez@gmail.com';
    $email2 = 'adeleyeasquare@gmail.com';
    

    // Sanitize and validate form data
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeEmail($_POST['email']);
    $subject = sanitizeInput($_POST['subject']);
    $text = sanitizeInput($_POST['text']);

    if ($name && $email && $text) {
        // Set up email headers
        $headers = "From: $email" . "\r\n" .
            "Reply-To: $email" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

        // Send email to the first email address
        mail($email1, 'URGENT! - New Client Message from Contact Form', "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $text", $headers);

        // Send email to the second email address
        mail($email2, 'URGENT! - New Client Message from Contact Form', "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $text", $headers);

       
        // Redirect back to the Investor Finder with a success text
        header('Location: index.html?message=success');
    } else {
        // Redirect back to the Investor Finder with an error text
        header('Location: index.html?message=error');
    }
} else {
    // Redirect back to the Investor Finder with an error text
    header('Location: index.html?text=error');
}

function sanitizeInput($input)
{
    // Remove any potentially malicious code
    $sanitizedInput = strip_tags($input);
    // Trim leading and trailing whitespace
    $sanitizedInput = trim($sanitizedInput);

    if (!empty($sanitizedInput)) {
        return $sanitizedInput;
    }

    return false;
}

function sanitizeEmail($email)
{
    // Remove any potentially malicious code
    $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    // Validate the email address
    if (filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
        return $sanitizedEmail;
    }

    return false;
}
?>
