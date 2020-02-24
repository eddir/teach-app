<?php

include_once '../../app/init.php';

if (isset($_POST['passphrase'])) {
    auth_phrase(trim($_POST['passphrase']));
} else {
    header('Location: /');
}