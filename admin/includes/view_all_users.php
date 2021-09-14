<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Avatar</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $select_all_posts = mysqli_query($connection, $query);
        $key = 1;
        while ($row = mysqli_fetch_assoc($select_all_posts)) {
            $id = $row['user_id'];
            $username = $row['username'];
            $firstname = $row['user_firstname'];
            $lastname = $row['user_lastname'];
            $image = $row['user_image'];
            $email = $row['user_email'];
            $role = $row['user_role'];
            $date = $row['user_date'];
            $deleteLink = "users.php?source=viewuser&&delete=" . $id;
            $editLink = "users.php?source=edituser&&edit=" . $id;
        ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= $username ?></td>
                <td><?= $firstname ?></td>
                <td><?= $lastname ?></td>
                <td><img src="<?= (isset($image) ? '../images/' . $image : '') ?>" alt="img" class="img-responsive" style="width: 150px;"></td>
                <td><?= $email ?></td>
                <td><?= $role ?></td>
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