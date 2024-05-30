<?php
 
if($_POST) {
    $visitor_name = "";
    $visitor_email = "";
    $visitor_subject = "";
    $visitor_message = "";
     
    if(isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
         
    }
     
    if(isset($_POST['visitor_subject'])) {
        $visitor_subject = filter_var($_POST['visitor_subject'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
    }
 
 
    $recipient = "inspirasinyataku@gmail.com";
     
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $visitor_email . "\r\n";
 
    $email_content = "<html><body>";
    $email_content .= "<table style='font-family: Arial;'><tbody><tr><td style='background: #eee; padding: 10px;'>Nama : </td><td style='background: #fda; padding: 10px;'>$visitor_name</td></tr>";
    $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Email : </td><td style='background: #fda; padding: 10px;'>$visitor_email</td></tr>";
    $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Subject : </td><td style='background: #fda; padding: 10px;'>$visitor_subject</td></tr>"; 
    $email_content .= "<p style='font-family: Arial; font-size: 1.25rem;'><strong>Isi Pesan : </strong><i> $visitor_message</i>.</p>";
    $email_content .= '</body></html>';
 
    echo $email_content;
     
    if(mail($recipient, "Hotel Room Reservation Confirmation", $email_content, $headers)) {
        echo '<p>Pesan Anda sudah terkirim. Terima kasih.</p>';
    } else {
        echo '<p>Pesan Anda tidak terkirim. Mohon dicoba kembali.</p>';
    }
     
} else {
    echo '<p>Mungkin ada kolom yang masih kosong.</p>';
}
 
?>