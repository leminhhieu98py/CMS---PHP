<?php
// handle submit form update
if (isset($_POST['Edit_post'])) {
    $title = $_POST['post_title'];
    $author = $_POST['post_author'];
    $category = $_POST['post_category_id'];
    $status = $_POST['post_status'];
    $image = $_FILES['post_image']['name'];
    $tmp_image = $_FILES['post_image']['tmp_name'];
    $tags = $_POST['post_tags'];
    $comments = 0;
    // $date = date('y-m-d');
    $content = $_POST['post_content'];
    move_uploaded_file($tmp_image, "../images/$image");
    $query = "INSERT INTO posts(post_title,post_author,post_category_id,post_status,post_image,post_tags,post_comment_count,post_date,post_content) ";
    $query .= "VALUES('{$title}', '{$author}', '{$category}','{$status}','{$image}','{$tags}','{$comments}',now(),'{$content}')";
    $add_new_post = mysqli_query($connection, $query);
    if (!$add_new_post) {
        die("Query failed! " . mysqli_error($connection));
    } else {
        header("Location: posts.php?source=viewpost");
    }
}

?>


<?php
// get data for this post
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "SELECT * FROM posts WHERE post_id = {$id}";
    $selected_post = mysqli_query($connection, $query);
    if (!$selected_post) {
        die("Query failed! " . mysqli_error($connection));
    } else {
        while ($row = mysqli_fetch_assoc($selected_post)) {
            $title = $row['post_title'];
            $author = $row['post_author'];
            $category = $row['post_category_id'];
            $status = $row['post_status'];
            $image = $row['post_image'];
            $tags = $row['post_tags'];
            $content = $row['post_content'];
?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="post_title">Post Title</label>
                    <input type="text" class="form-control" name="post_title" value="<?= $title ?>">
                </div>
                <div class="form-group">
                    <label for="post_category_id">Post Category Id</label>
                    <input type="text" class="form-control" name="post_category_id" value="<?= $author ?>">
                </div>
                <div class="form-group">
                    <label for="post_author">Post Author</label>
                    <input type="text" class="form-control" name="post_author" value="<?= $category ?>">
                </div>
                <div class="form-group">
                    <label for="post_status">Post Status</label>
                    <input type="text" class="form-control" name="post_status" value="<?= $status ?>">
                </div>
                <div class="form-group">
                    <label for="post_image">Post Image</label>
                    <input type="file" class="form-control" name="post_image">
                </div>
                <div class="form-group">
                    <label for="post_tags">Post Tags</label>
                    <input type="text" class="form-control" name="post_tags" value="<?= $tags ?>">
                </div>
                <div class="form-group">
                    <label for="post_content">Post Content</label>
                    <textarea type="text" class="form-control" name="post_content"><?= $content ?></textarea>
                </div>
                <button class="btn btn-primary" type="submit" name="Edit_post">Update this post</button>
            </form>
<?php
        }
    }
}
?>