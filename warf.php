<?php
// Définition des constantes de configuration
define('TOKEN_EXPIRATION', 3600); // Durée de validité du jeton CSRF en secondes
define('TOKEN_COOKIE_NAME', 'csrf_token'); // Nom du cookie CSRF
define('TOKEN_SECRET_KEY', 'my_secret_key'); // Clé secrète pour signer le jeton CSRF

// Vérification du jeton CSRF
session_start();
if ($_POST['token'] !== $_SESSION['token']) {
    die('Jeton CSRF invalide.');
}

// Traitement du formulaire
if ($_POST['submit']) {
    // Faire quelque chose avec les données soumises
    // ...
    echo 'Formulaire soumis avec succès.';
}

// Génération d'un nouveau jeton CSRF
$token = bin2hex(random_bytes(32));
$_SESSION['token'] = $token;

// Stockage du jeton CSRF dans un cookie sécurisé
setcookie(TOKEN_COOKIE_NAME, $token, time() + TOKEN_EXPIRATION, '/', null, true, true);

// Vérification du jeton CSRF à partir du cookie sécurisé
if (!empty($_COOKIE[TOKEN_COOKIE_NAME])) {
    $cookie_token = $_COOKIE[TOKEN_COOKIE_NAME];
    $signature = hash_hmac('sha256', $cookie_token, TOKEN_SECRET_KEY);
    if (hash_equals($signature, $_SESSION['token'])) {
        // Le jeton CSRF est valide
    } else {
        // Le jeton CSRF est invalide
    }
}

// Suppression du cookie CSRF expiré
if (!empty($_COOKIE[TOKEN_COOKIE_NAME])) {
    $cookie_token = $_COOKIE[TOKEN_COOKIE_NAME];
    $signature = hash_hmac('sha256', $cookie_token, TOKEN_SECRET_KEY);
    if (!hash_equals($signature, $_SESSION['token'])) {
        unset($_COOKIE[TOKEN_COOKIE_NAME]);
        setcookie(TOKEN_COOKIE_NAME, null, -1, '/');
    }
}
?>

<!-- Formulaire HTML avec jeton CSRF -->
<form method="post">
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input type="text" name="input1">
    <input type="text" name="input2">
    <input type="submit" name="submit" value="Soumettre">
</form>
