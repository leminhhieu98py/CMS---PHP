<?php
include 'includes/db.php';
include 'includes/head.php';
?>

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
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- Blog Posts -->
                <?php

                $query = 'SELECT * FROM posts';
                if (isset($_POST['submit'])) {
                    $search = (isset($_POST['search'])) ? $_POST['search'] : '';
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                    // $select_search_posts = mysqli_query($connection, $query);
                    // $count = mysqli_num_rows($select_search_posts);
                }
                $select_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_posts)) {
                    $title = $row['post_title'];
                    $author = $row['post_author'];
                    $createdAt = $row['post_date'];
                    $img_url = $row['post_image'];
                    $content = $row['post_content'];
                ?>
                    <h2 style="margin-top: 100px;"><a href='#'><?= $title ?></a></h2>
                    <p class='lead'>by <a href='index.php'><?= $author ?></a></p>
                    <p><span class='glyphicon glyphicon-time'></span> Posted on <?= $createdAt ?></p>
                    <hr>
                    <img class='img-responsive' src='<?= $img_url ?>' alt='cannot find img' style="height: 400px; overflow-x: hidden;">
                    <hr>
                    <p><?= $content ?></p>
                    <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                <?php
                }
                ?>
            </div>


            <hr>
            <!-- Blog Sidebar Widgets Column -->
            <?php
            include 'includes/right_sidebar.php';
            ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php
        include 'includes/footer.php';
        ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>