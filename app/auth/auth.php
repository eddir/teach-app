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

    auth($user['id'], $user['authority']);
}

function auth_phrase($passphrase) {
    global $pdo;

    $stmt = $pdo->prepare('SELECT id, authority FROM users WHERE passphrase = ?');
    $stmt->execute([$passphrase]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        auth($user['id'], $user['authority']);
    } else {
        header('Location: /login/?failed');
    }
}

function auth($user_id, $authority) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['authority'] = $authority;
    header('Location: /?fromLogin');
}

function checkPermission($authorities) {
    isset($_SESSION['authority']) ? $group = $_SESSION['authority'] : $group = 'anonymous';
    return in_array($group, $authorities);
}

function needPermission($authorities, $ajax = false) {
    if (!checkPermission($authorities)) {
        if ($ajax) {
            exit('401: доступ запрещён');
        } else {
            header('Location: /login');
        }
    }
    return true;
}

function getGroup() {
    return isset($_POST['authority']) ? $_POST['authority'] : 'guest';
}