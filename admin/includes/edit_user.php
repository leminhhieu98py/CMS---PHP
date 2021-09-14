<?php
// handle submit form update
if (isset($_POST['edit_user'])) {
    $id = $_GET['edit'];
    $username = $_POST['username'];
    $firstname = $_POST['user_firstname'];
    $lastname = $_POST['user_lastname'];
    $email = $_POST['user_email'];
    $role = $_POST['user_role'];
    $image = $_FILES['user_image']['name'];
    $tmp_image = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($tmp_image, "../images/$image");
    $query = "UPDATE users SET ";
    $query .= "username = '{$username}',";
    $query .= "user_firstname = '{$firstname}',";
    $query .= "user_lastname = '{$lastname}',";
    $query .= "user_email = '{$email}',";
    $query .= "user_role = '{$role}',";
    $query .= "user_image = '{$image}' ";
    $query .= "WHERE user_id = '{$id}'";

    $update_this_user = mysqli_query($connection, $query);
    if (!$update_this_user) {
        die("Query failed! " . mysqli_error($connection));
    } else {
        header("Location: users.php?source=viewuser");
    }
}

?>


<?php
// get data for this user
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "SELECT * FROM users WHERE user_id = {$id}";
    $selected_post = mysqli_query($connection, $query);
    if (!$selected_post) {
        die("Query failed! " . mysqli_error($connection));
    } else {
        while ($row = mysqli_fetch_assoc($selected_post)) {
            $username = $row['username'];
            $firstname = $row['user_firstname'];
            $lastname = $row['user_lastname'];
            $email = $row['user_email'];
            $role = $row['user_role'];
?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?= $username ?>">
                </div>
                <div class="form-group">
                    <label for="user_firstname">Firstname</label>
                    <input type="text" class="form-control" name="user_firstname" value="<?= $firstname ?>">
                </div>
                <div class="form-group">
                    <label for="user_lastname">Lastname</label>
                    <input type="text" class="form-control" name="user_lastname" value="<?= $lastname ?>">
                </div>
                <div class="form-group">
                    <label for="user_image">Avatar</label>
                    <input type="file" class="form-control" name="user_image">
                </div>
                <div class="form-group">
                    <label for="user_email">Email</label>
                    <input type="text" class="form-control" name="user_email" value="<?= $email ?>">
                </div>
                <div class="form-group">
                    <label for="user_role">Role</label>
                    <input type="text" class="form-control" name="user_role" value="<?= $role ?>">
                </div>
                <button class="btn btn-primary" type="submit" name="edit_user">Update this user</button>
            </form>
<?php
        }
    }
}
?>