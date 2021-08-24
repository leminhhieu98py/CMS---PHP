<?php

if (isset($_POST['create_post'])) {
    global $connection;
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
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Category Id</label>
        <input type="text" class="form-control" name="post_category_id">
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" class="form-control" name="post_content"></textarea>
    </div>
    <button class="btn btn-primary" type="submit" name="create_post">Create a post</button>
</form>