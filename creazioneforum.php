<?php

require_once "function.php";

$email = $_SESSION['email'] ?? null;

if($email === null) {
    header('Location: login.php');
    exit;
}

