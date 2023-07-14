<?php
// Définition des constantes de configuration
define('TOKEN_EXPIRATION', 3600); // Durée de validité du jeton CSRF en secondes
define('TOKEN_COOKIE_NAME', 'csrf_token'); // Nom du cookie CSRF

session_start();

function generateRandomKey($length = 32)
{
    $key = bin2hex(random_bytes($length));
    return $key;
}

$tokenSecretKey = generateRandomKey();
define('TOKEN_SECRET_KEY', $tokenSecretKey); // Clé secrète pour signer le jeton CSRF

function generate_csrf_token() {
    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;
    setcookie(TOKEN_COOKIE_NAME, $token, time() + TOKEN_EXPIRATION, '/', null, true, true);
}

function verify_csrf_token() {
    if (isset($_COOKIE[TOKEN_COOKIE_NAME], $_SESSION['token'])) {
        $cookie_token = $_COOKIE[TOKEN_COOKIE_NAME];
        $signature = hash_hmac('sha256', $cookie_token, TOKEN_SECRET_KEY);
        return hash_equals($signature, $_SESSION['token']);
    }
    return false;
}

function remove_expired_csrf_cookie() {
    if (isset($_COOKIE[TOKEN_COOKIE_NAME], $_SESSION['token'])) {
        $cookie_token = $_COOKIE[TOKEN_COOKIE_NAME];
        $signature = hash_hmac('sha256', $cookie_token, TOKEN_SECRET_KEY);
        if (!hash_equals($signature, $_SESSION['token'])) {
            unset($_COOKIE[TOKEN_COOKIE_NAME]);
            setcookie(TOKEN_COOKIE_NAME, null, -1, '/');
        }
    }
}

// Vérification du jeton CSRF
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !verify_csrf_token()) {
    die('Jeton CSRF invalide.');
}

// Traitement du formulaire
if (isset($_POST['submit'])) {
    // Faire quelque chose avec les données soumises
    // ...
    echo 'Formulaire soumis avec succès.';
}

// Génération d'un nouveau jeton CSRF
generate_csrf_token();

// Suppression du cookie CSRF expiré
remove_expired_csrf_cookie();
?>

<!-- Formulaire HTML avec jeton CSRF -->
<form method="post">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
    <input type="text" name="input1">
    <input type="text" name="input2">
    <input type="submit" name="submit" value="Soumettre">
</form>
