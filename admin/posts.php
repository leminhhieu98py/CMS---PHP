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
                            Posts management
                        </h1>
                    </div>
                    <div class="col-xs-12">
                        <?php
                        if (isset($_GET['source']) && $_GET['source'] == 'viewpost') {
                            include "includes/view_all_posts.php";
                        } else if (isset($_GET['source']) && $_GET['source'] == 'addpost') {
                            include "includes/add_post.php";
                        }
                        ?>
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