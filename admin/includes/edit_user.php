<?php
// handle submit form update
if (isset($_POST['edit_user'])) {
    $id = $_GET['edit'];
    $title = $_POST['post_title'];
    $author = $_POST['post_author'];
    $category = $_POST['post_category_id'];
    $status = $_POST['post_status'];
    $image = $_FILES['post_image']['name'];
    $tmp_image = $_FILES['post_image']['tmp_name'];
    $tags = $_POST['post_tags'];
    $content = $_POST['post_content'];
    move_uploaded_file($tmp_image, "../images/$image");
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$title}',";
    $query .= "post_author = '{$author}',";
    $query .= "post_category_id = '{$category}',";
    $query .= "post_status = '{$status}',";
    $query .= "post_image = '{$image}',";
    $query .= "post_tags = '{$tags}',";
    $query .= "post_content = '{$content}' ";
    $query .= "WHERE post_id = '{$id}'";

    $add_new_post = mysqli_query($connection, $query);
    if (!$add_new_post) {
        die("Query failed! " . mysqli_error($connection));
    } else {
        header("Location: posts.php?source=viewpost");
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
            $image = $row['user_image'];
            $email = $row['user_email'];
            $role = $row['user_role'];
?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?= $aaa ?>">
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="text" class="form-control" name="user_password" value="<?= $aaa ?>">
                </div>
                <div class="form-group">
                    <label for="user_firstname">Firstname</label>
                    <input type="text" class="form-control" name="user_firstname" value="<?= $aaa ?>">
                </div>
                <div class="form-group">
                    <label for="user_lastname">Lastname</label>
                    <input type="text" class="form-control" name="user_lastname" value="<?= $aaa ?>">
                </div>
                <div class="form-group">
                    <label for="user_image">Avatar</label>
                    <input type="file" class="form-control" name="user_image">
                </div>
                <div class="form-group">
                    <label for="user_email">Email</label>
                    <input type="text" class="form-control" name="user_email" value="<?= $aaa ?>">
                </div>
                <div class="form-group">
                    <label for="user_role">Role</label>
                    <input type="text" class="form-control" name="user_role" value="<?= $aaa ?>">
                </div>
                <button class="btn btn-primary" type="submit" name="edit_user">Update this user</button>
            </form>
<?php
        }
    }
}
?>