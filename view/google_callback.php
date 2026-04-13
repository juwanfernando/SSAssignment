<?php
include_once "../model/connect.php";
include_once "../model/google_oauth.php";

$connect = connectServer("localhost", "root", "", 3306);
$connect->select_db("library");

if (
    empty($_GET['state']) ||
    empty($_SESSION['oauth_state']) ||
    !hash_equals($_SESSION['oauth_state'], $_GET['state'])
) {
    unset($_SESSION['oauth_state']);
    header("Location: login.php?error=invalid_state");
    exit;
}
unset($_SESSION['oauth_state']);

if (!empty($_GET['error'])) {
    header("Location: login.php?error=" . urlencode($_GET['error']));
    exit;
}

if (empty($_GET['code'])) {
    header("Location: login.php?error=missing_code");
    exit;
}

// Exchange authorization code for access token
$tokenData = exchangeCodeForToken($_GET['code']);
if (!$tokenData || empty($tokenData['access_token'])) {
    header("Location: login.php?error=token_exchange_failed");
    exit;
}

//  Fetch user profile from Google
$userInfo = getGoogleUserInfo($tokenData['access_token']);
if (!$userInfo || empty($userInfo['sub'])) {
    header("Location: login.php?error=userinfo_failed");
    exit;
}

//  Find or create the user in oauth_users table 
$user = findOrCreateOAuthUser(
    $userInfo['sub'],
    $userInfo['email'] ?? '',
    $userInfo['name']  ?? $userInfo['email'] ?? 'Google User',
    $connect
);

if (!$user) {
    header("Location: login.php?error=db_error");
    exit;
}

//  Set session and redirect 
setOAuthSession($user);
header("Location: searchBookView.php");
exit;
