<?php
ini_set('default_charset', 'utf-8');
ini_set('SMTP', 'smtp.second-job.fr');
ini_set('sendmail_from', 'snitransport77@gmail.com');

$post = (object) $_POST;

foreach($post as $value)
{
    if(empty($value))
    {
        exit('Tous les champs ne sont pas remplis');
    }
}

if(!filter_var($post->email, FILTER_VALIDATE_EMAIL))
{
    exit("Le mail n'est pas valide" );
}

$email         = ini_get('sendmail_from');
$subject     = "Candidature de $post->civilite $post->nom $post->prenom";

ob_start();
require 'template.php';

$html = ob_get_clean();

$boundary = '-----=' . md5(uniqid(rand()));

$head[]        = "Reply-to: {$post->email}";
$head[]        = "Form: {$email}";
$head[]     = "MIME-Version: 1.0";
$head[]     = "Content-Type: multipart/related; boundary=\"$boundary\"";
$head[]     = '';

$msg[]        = "--$boundary";
$msg[]         = "Content-Type: text/html; charset=\"utf-8\"";
$msg[]         = "Content-Transfer-Encoding:8bit";
$msg[]         = '';
$msg[]        = $html;
$msg[]        = '';

if(isset($_FILES))
{
    $file             = current($_FILES);

    if($file['error'] == 0)
    {
        $attachment     = chunk_split(base64_encode(file_get_contents($file['tmp_name'])));
        unlink($file['tmp_name']);

        $msg[]         = "--$boundary";
        $msg[]         = "Content-Type: application/octet-stream; name=\"{$file['name']}\"";
        $msg[]        = "Content-Transfer-Encoding: base64";
        $msg[]        = "Content-Disposition: attachment; filename=\"{$file['name']}\"";
        $msg[]        = '';
        $msg[]        = $attachment;
        $msg[]        = '';
    }
}

$msg[]         = "--$boundary--";
$msg[]        = '';

$header        = implode(PHP_EOL, $head);
$message    = implode(PHP_EOL, $msg);

$mail = mail($email, $subject, $message, $header);

if($mail)
{
    echo 'Candidature envoyé';
}
else
{
    echo 'Pas envoyé';
}