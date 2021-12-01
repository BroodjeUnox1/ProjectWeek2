<?php
session_start();
require "./database.php";

$db = new Database;
$action = $_POST['action'] ?? NULL;

switch($action) {
    case "register":
        if(!does_exist_username($_POST['username'])) {
            if(!does_exist_email($_POST['email'])) {
                register($_POST['username'], $_POST['password'], $_POST['email']);
            }
            else {
                $_SESSION['loggedin'] = FALSE;
                $_SESSION['err'] = "Email already used!";
            }
        }
        else {
            $_SESSION['loggedin'] = FALSE;
            $_SESSION['err'] = "Username already used!";
        }
        header("Location: ../../index.php");
        break;

    case "login":
        login($_POST['username'], $_POST['password']);
        header("Location: ../../index.php");
        break;
}

function login($username, $password) {
    $user = find_user_login($username);
    if(!$user) {
        $_SESSION['loggedin'] = FALSE;
        $_SESSION['err'] = "Username not found";
    } 
    else {
        if(password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['admin'] = $user['admin'];
            $_SESSION['err'] = NULL;
            
        } 
        else {
            $_SESSION['loggedin'] = FALSE;
            $_SESSION['err'] = "Passwords do not match";
        }
    }
}

function find_user_login($username) {
    global $db;
    $db->prepare("SELECT username, password, admin FROM users WHERE username = :username");
    $db->bind("username", $username);
    return $db->fetch();
}

function does_exist_email($email) {
    global $db;
    $db->prepare("SELECT email FROM users WHERE email  = :email");
    $db->bind("email", $email);
    $response = $db->fetch();
    if($response) {
       return TRUE;
   } else {
       return FALSE;
   }
}

function does_exist_username($username) {
     global $db;
     $db->prepare("SELECT username FROM users WHERE username = :username");
     $db->bind("username", $username);
     $response = $db->fetch();
     if($response) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function register($username, $password, $email) {
    global $db;
    $db->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
    $db->bind("username", $username);
    $db->bind("password", password_hash($password, PASSWORD_DEFAULT));
    $db->bind("email", $email);
    $db->execute();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['err'] = NULL;
}
?>