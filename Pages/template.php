<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Mail</title>
</head>
<body>
<h1>Candidature de <?php echo $post->civilite ?> <?php echo $post->nom ?> <?php echo $post->prenom ?></h1>
<ul>
    <li>telephone : <?php echo $post->telephone ?></li>
    <li>e-mail : <?php echo $post->email ?></li>
    <li>adresse : <?php echo $post->adresse ?></li>
    <li>code-postal : <?php echo $post->codepostal ?></li>
    <li>ville : <?php echo $post->ville ?></li>
</ul>
<div>
    <h2>Lettre de Movativation</h2>
    <p><?php echo nl2br($post->remarque) ?></p>
</div>
</body>
</html>