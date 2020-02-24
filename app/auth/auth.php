<?php

session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    //header("Location: " . ROOT_URL . "/login.php");
}

function auth_social($source, $email, $access_token, $first_name, $last_name) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $stmt = $pdo->prepare("SELECT id FROM users_social WHERE parent = ? AND source = ?");
        $stmt->execute([$user['id'], $source]);
        $social = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($social) {
            $pdo->prepare("UPDATE users_social SET access_token = ? WHERE id = ?")->execute([$access_token, $social['id']]);
        } else {
            $pdo->prepare("INSERT INTO users_social (parent, access_token, source) VALUES (?, ?, ?)")->
            execute([$user['id'], $access_token, $source]);
        }
        $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?")->execute([$user['id']]);
    } else {
        $pdo->prepare("INSERT INTO users (email, first_name, last_name) VALUES (?, ?, ?)")->
        execute([$email, $first_name, $last_name]);
        $pdo->prepare("INSERT INTO users_social (parent, source, access_token) VALUES (?, ?, ?)")->
        execute([$pdo->lastInsertId(), $source, $access_token]);
    }

    auth($user['id']);
}

function auth_phrase($passphrase) {

}

function auth($user_id) {
    $_SESSION['user_id'] = $user_id;
    header('Location: /?fromLogin');
}