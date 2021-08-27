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

                                <!-- handle delete comments -->
                                <?php
                                if (isset($_GET['delete']) && isset($_GET['p_id'])) {
                                    $comment_id_to_delete = $_GET['delete'];
                                    $id = $_GET['p_id'];
                                    $query_delete_comment = "DELETE FROM comments WHERE comment_id = {$comment_id_to_delete}";
                                    $comment_to_delete = mysqli_query($connection, $query_delete_comment);
                                    if (!$comment_to_delete) {
                                        die("Query failed!" . mysqli_error($connection));
                                    } else {
                                        $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = {$id}";
                                        $create_comment = mysqli_query($connection, $query);
                                        if (!$create_comment) {
                                            die("Query failed! " . mysqli_error($connection));
                                        }
                                        header("Location: comments.php");
                                    }
                                }
                                ?>


                                <!-- handle approve comments -->
                                <?php
                                if (isset($_GET['approve'])) {
                                    $comment_id_to_approve = $_GET['approve'];
                                    $query_approve_comment = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$comment_id_to_approve}";
                                    $comment_to_approve = mysqli_query($connection, $query_approve_comment);
                                    if (!$comment_to_approve) {
                                        die("Query failed!" . mysqli_error($connection));
                                    } else {
                                        header("Location: comments.php");
                                    }
                                }
                                ?>


                                <!-- handle unapprove comments -->
                                <?php
                                if (isset($_GET['unapprove'])) {
                                    $comment_id_to_unapprove = $_GET['unapprove'];
                                    $query_unapprove_comment = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$comment_id_to_unapprove}";
                                    $comment_to_unapprove = mysqli_query($connection, $query_unapprove_comment);
                                    if (!$comment_to_unapprove) {
                                        die("Query failed!" . mysqli_error($connection));
                                    } else {
                                        header("Location: comments.php");
                                    }
                                }
                                ?>

                                <!-- display comments -->
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
                                    $date = $row['comment_date'];
                                    $post_id = $row['comment_post_id'];
                                    $deleteLink = "comments.php?delete=" . $id . "&&p_id=" . $post_id;
                                    $approveLink = "comments.php?approve=" . $id;
                                    $unapproveLink = "comments.php?unapprove=" . $id;
                                    $post_id_query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                                    $post_id_commented = mysqli_query($connection, $post_id_query);
                                    if (!$post_id_commented) {
                                        die("Query failed!" . mysqli_error($connection));
                                    } else {
                                        while ($row_in_post = mysqli_fetch_assoc($post_id_commented)) {
                                            $responseTo = $row_in_post['post_title'];
                                        }
                                    }
                                ?>
                                    <tr>
                                        <td><?= $key ?></td>
                                        <td><?= $author ?></td>
                                        <td><?= $comment ?></td>
                                        <td><?= $email ?></td>
                                        <td><?= $status ?></td>
                                        <td><a href="../post.php?p_id=<?= $post_id ?>"><?= $responseTo ?></a></td>
                                        <td><?= $date ?></td>
                                        <td><a href=<?= $deleteLink ?>>Delete</a> | <a href="<?= $approveLink ?>">Approve</a> | <a href="<?= $unapproveLink ?>">Unapprove</a></td>
                                    </tr>
                                <?php
                                    $key++;
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