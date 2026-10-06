<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $to      = "admin@meridianbettips.com";
    $name    = htmlspecialchars(strip_tags($_POST["name"]));
    $email   = htmlspecialchars(strip_tags($_POST["email"]));
    $subject = htmlspecialchars(strip_tags($_POST["subject"]));
    $message = htmlspecialchars(strip_tags($_POST["message"]));

    $full_subject = "Ujumbe Mpya: " . $subject . " - kutoka " . $name;

    $body  = "Jina: " . $name . "\n";
    $body .= "Barua Pepe: " . $email . "\n";
    $body .= "Mada: " . $subject . "\n\n";
    $body .= "Ujumbe:\n" . $message;

    // Use admin email as sender — avoids spam filters
    $headers  = "From: admin@meridianbettips.com\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $full_subject, $body, $headers)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }

} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
