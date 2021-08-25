<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM posts";
        $select_all_posts = mysqli_query($connection, $query);
        $key = 1;
        while ($row = mysqli_fetch_assoc($select_all_posts)) {
            $id = $row['post_id'];
            $title = $row['post_title'];
            $author = $row['post_author'];
            $category = $row['post_category_id'];
            $status = $row['post_status'];
            $image = $row['post_image'];
            $tags = $row['post_tags'];
            $comments = $row['post_comment_count'];
            $date = $row['post_date'];
            $deleteLink = "posts.php?source=viewpost&&delete=" . $id;
            $editLink = "posts.php?source=editpost&&edit=" . $id;
        ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= $title ?></td>
                <td><?= $author ?></td>
                <?php
                $query = "SELECT * FROM categories WHERE cat_id = {$category}";
                $selected_category = mysqli_query($connection, $query);
                if (!$selected_category) {
                    die("Query failed! " . mysqli_error($connection));
                } else {
                    while ($row = mysqli_fetch_assoc($selected_category)) {
                        $cat_title = $row['cat_title'];
                ?>
                        <td><?= $cat_title ?></td>
                <?php
                    }
                }
                ?>
                <td><?= $status ?></td>
                <td><img src='../images/<?= $image ?>' alt="img" class="img-responsive" style="width: 150px;"></td>
                <td><?= $tags ?></td>
                <td><?= $comments ?></td>
                <td><?= $date ?></td>
                <td><a href=<?= $deleteLink ?>>Delete</a> <a href=<?= $editLink ?>>Edit</a></td>
            </tr>
        <?php
            $key++;
        }
        ?>

        <!-- delete post handle -->
        <?php
        if (isset($_GET['delete'])) {
            $post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$post_id}";
            $delete_post = mysqli_query($connection, $query);
            if (!$delete_post) {
                die("Query failed " . mysqli_error($connection));
            } else {
                header("Location: posts.php?source=viewpost");
            }
        }
        ?>
    </tbody>
</table>