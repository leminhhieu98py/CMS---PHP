<?php include 'includes/db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <?php
    include 'includes/navigation.php';
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- Blog Posts -->
                <?php
                if (isset($_GET['p_id'])) {
                    $id = $_GET['p_id'];
                    $query = "SELECT * FROM posts WHERE post_id = {$id}";
                    if (isset($_POST['submit'])) {
                        $search = (isset($_POST['search'])) ? $_POST['search'] : '';
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                    }
                    if (isset($_GET['cat_id'])) {
                        $cat_id = $_GET['cat_id'];
                        $query = "SELECT * FROM posts WHERE post_category_id = {$cat_id} ";
                    }
                    $select_posts = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($select_posts)) {
                        $title = $row['post_title'];
                        $author = $row['post_author'];
                        $createdAt = $row['post_date'];
                        $img_url = $row['post_image'];
                        $content = $row['post_content'];
                ?>
                        <h2 style="margin-top: 100px;"><a href='post.php?p_id=<?= $id ?>'><?= $title ?></a></h2>
                        <p class='lead'>by <a href=''><?= $author ?></a></p>
                        <p><span class='glyphicon glyphicon-time'></span> Posted on <?= $createdAt ?></p>
                        <hr>
                        <img class='img-responsive' src='./images/<?= $img_url ?>' alt='cannot find img' style="height: 400px; overflow-x: hidden;">
                        <hr>
                        <p><?= $content ?></p>
                <?php
                    }
                }
                ?>

                <!-- Blog Comments -->


                <!-- Handle create comments -->'
                <?php
                if (isset($_POST['create_comment'])) {
                    $id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    $query = "INSERT INTO comments (`comment_post_id`, `comment_author`, `comment_email`, `comment_status`, `comment_content`, `comment_date`) ";
                    $query .= "VALUES('{$id}', '{$comment_author}', '{$comment_email}', 'unpublished', '{$comment_content}', now())";
                    $create_comment = mysqli_query($connection, $query);

                    if (!$create_comment) {
                        die("Query failed! " . mysqli_error($connection));
                    } else {
                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$id}";
                        $create_comment = mysqli_query($connection, $query);
                        if (!$create_comment) {
                            die("Query failed! " . mysqli_error($connection));
                        }
                    }
                }
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form method="POST">
                        <div class="form-group">
                            <label for="">Your name</label>
                            <input class="form-control" type="text" name="comment_author" placeholder="Enter your name" require>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input class="form-control" type="email" name="comment_email" placeholder="Enter your email" require>
                        </div>
                        <div class="form-group">
                            <label for="">Comment</label>
                            <textarea class="form-control" name="comment_content" placeholder="Leave your comment here <3" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php
                if (isset($_GET['p_id'])) {
                    $id = $_GET['p_id'];
                    $query = "SELECT * FROM comments WHERE comment_status = 'approved' AND comment_post_id = {$id}";
                    $approved_comments = mysqli_query($connection, $query);
                    if (!$approved_comments) {
                        die("Query failed!" . mysqli_error($connection));
                    } else {
                        while ($row = mysqli_fetch_assoc($approved_comments)) {
                            $author = $row['comment_author'];
                            $date = $row['comment_date'];
                            $content = $row['comment_content'];
                ?>
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?= $author ?>
                                        <small><?= $date ?></small>
                                    </h4>
                                    <?= $content ?>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>

            </div>

            <!-- Blog Sidebar Column -->
            <?php include "./includes/right_sidebar.php"; ?>
        </div>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
        <!-- /.row -->
    </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>