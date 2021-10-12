<?php
include("db.php");
session_start();

if (isset($_POST['login'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' AND user_password = '{$password}'";
    $user = mysqli_query($connection, $query);

    if (!$user) {
        die("Query failed" . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($user)) {
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_role = $row['user_role'];
    }

    if ($username === $db_username && $password === $db_password) {
        $_SESSION['username'] = $db_username;
        $_SESSION['password'] = $db_password;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['role'] = $db_role;
        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }
}
