<?php
// handle submit form update
if (isset($_POST['edit_post'])) {
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
                    <select class="form-control" name="post_category_id" id="post_category_id">
                        <?php
                        $query = "SELECT * FROM categories";
                        $all_categories = mysqli_query($connection, $query);
                        if (!$all_categories) {
                            die("Query failed! " . mysqli_error($connection));
                        } else {
                            while ($row = mysqli_fetch_assoc($all_categories)) {
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                        ?>
                                <option value="<?= $cat_id ?>" <?= ($category == $cat_id) ? 'selected' : '' ?>><?= $cat_title ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post_author">Post Author</label>
                    <input type="text" class="form-control" name="post_author" value="<?= $author ?>">
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
                <button class="btn btn-primary" type="submit" name="edit_post">Update this post</button>
            </form>
<?php
        }
    }
}
?>