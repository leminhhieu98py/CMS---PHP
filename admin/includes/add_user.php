<?php

// add user to db after clicking submit button
if (isset($_POST['create_user'])) {
    global $connection;
    $username = $_POST['username'];
    $password = $_POST['user_password'];
    $firstname = $_POST['user_firstname'];
    $lastname = $_POST['user_lastname'];
    $email = $_POST['user_email'];
    $role = $_POST['user_role'];
    $image = $_FILES['user_image']['name'];
    $tmp_image = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($tmp_image, "../images/$image");
    $query = "INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_role,user_image,user_date) ";
    $query .= "VALUES('{$username}', '{$password}', '{$firstname}','{$lastname}','{$email}','{$role}','{$image}',now())";
    $add_new_user = mysqli_query($connection, $query);
    if (!$add_new_user) {
        die("Query failed! " . mysqli_error($connection));
    } else {
        header("Location: users.php?source=viewuser");
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="text" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="user_image">Avatar</label>
        <input type="file" class="form-control" name="user_image">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <input type="text" class="form-control" name="user_role">
    </div>
    <button class="btn btn-primary" type="submit" name="create_user">Create a user</button>
</form>