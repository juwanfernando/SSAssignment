<?php
include_once __DIR__ . "/oauth_config.php";

function getGoogleAuthUrl() {
    $state = bin2hex(random_bytes(16));
    $_SESSION['oauth_state'] = $state;

    $params = http_build_query([
        'client_id'     => GOOGLE_CLIENT_ID,
        'redirect_uri'  => GOOGLE_REDIRECT_URI,
        'response_type' => 'code',
        'scope'         => 'openid email profile',
        'state'         => $state,
        'access_type'   => 'online',
    ]);

    return GOOGLE_AUTH_URL . '?' . $params;
}

function exchangeCodeForToken($code) {
    $postFields = http_build_query([
        'code'          => $code,
        'client_id'     => GOOGLE_CLIENT_ID,
        'client_secret' => GOOGLE_CLIENT_SECRET,
        'redirect_uri'  => GOOGLE_REDIRECT_URI,
        'grant_type'    => 'authorization_code',
    ]);

    $ch = curl_init(GOOGLE_TOKEN_URL);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $postFields,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) return false;
    return json_decode($response, true);
}

function getGoogleUserInfo($accessToken) {
    $ch = curl_init(GOOGLE_USERINFO_URL);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $accessToken],
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) return false;
    return json_decode($response, true);
}

function findOrCreateOAuthUser($googleId, $email, $name, mysqli $connect) {
    $googleId = $connect->real_escape_string($googleId);
    $email    = $connect->real_escape_string($email);
    $name     = $connect->real_escape_string($name);

    $result = $connect->query(
        "SELECT * FROM oauth_users WHERE google_id = '$googleId' LIMIT 1"
    );

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    // New user — insert into oauth_users
    $connect->query(
        "INSERT INTO oauth_users (google_id, email, name)
         VALUES ('$googleId', '$email', '$name')"
    );

    $result = $connect->query(
        "SELECT * FROM oauth_users WHERE google_id = '$googleId' LIMIT 1"
    );
    return $result->fetch_assoc();
}

function setOAuthSession($user) {
    $_SESSION['student']['id']       = 'oauth_' . $user['id'];
    $_SESSION['student']['name']     = $user['name'];
    $_SESSION['student']['email']    = $user['email'];
    $_SESSION['student']['oauth']    = true;
    // Placeholders for fields the app may reference
    $_SESSION['student']['birthday'] = '';
    $_SESSION['student']['faculty']  = '';
    $_SESSION['student']['class']    = '';
    $_SESSION['student']['password'] = '';
}
