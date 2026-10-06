<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $to      = "admin@meridianbettips.com";
    $name    = htmlspecialchars(strip_tags($_POST["name"]));
    $email   = htmlspecialchars(strip_tags($_POST["email"]));
    $subject = htmlspecialchars(strip_tags($_POST["subject"]));
    $message = htmlspecialchars(strip_tags($_POST["message"]));

    $full_subject = "Ujumbe Mpya: " . $subject . " - kutoka " . $name;

    $body = "Jina: " . $name . "\n";
    $body .= "Barua Pepe: " . $email . "\n";
    $body .= "Mada: " . $subject . "\n\n";
    $body .= "Ujumbe:\n" . $message;

    $headers  = "From: noreply@meridianbettips.com\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $full_subject, $body, $headers)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }

} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
