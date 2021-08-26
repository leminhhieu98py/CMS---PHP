<?php
include "includes/head.php";
?>

<body>

    <div id="wrapper">
        <?php include "includes/layout.php" ?>

        <!-- Content -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Comments management
                        </h1>
                    </div>
                    <div class="col-xs-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In response to</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM comments";
                                $select_all_comments = mysqli_query($connection, $query);
                                $key = 1;
                                while ($row = mysqli_fetch_assoc($select_all_comments)) {
                                    $id = $row['comment_id'];
                                    $author = $row['comment_author'];
                                    $comment = $row['comment_content'];
                                    $email = $row['comment_email'];
                                    $status = $row['comment_status'];
                                    $responseTo = 'later';
                                    $date = $row['comment_date'];
                                    $deleteLink = "comments.php?source=viewcomment&&delete=" . $id;
                                ?>
                                    <tr>
                                        <td><?= $key ?></td>
                                        <td><?= $author ?></td>
                                        <td><?= $comment ?></td>
                                        <td><?= $email ?></td>
                                        <td><?= $status ?></td>
                                        <td><?= $responseTo ?></td>
                                        <td><?= $date ?></td>
                                        <td><a href=<?= $deleteLink ?>>Delete</a> | <a href="">Approve</a> | <a href="">Unapprove</a></td>
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
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>