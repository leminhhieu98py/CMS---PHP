<?php
include "includes/head.php";
include "includes/functions.php";
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
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <div class="col-xs-6">
                            <!-- Add form -->
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title"></label>
                                    <input type="text" id="cat-title" name="cat_title" placeholder="Enter a new category name" class="form-control">
                                    <!-- Add new category to the database -->
                                    <?php
                                    create_category();
                                    ?>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" name="submit" value="">Add category</button>
                                </div>
                            </form>

                            <?php
                            edit_category();
                            ?>
                        </div>

                        <!-- Display categories -->
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Category Title</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- display all -->
                                    <?php
                                    load_category();
                                    ?>
                                    <!-- delete category -->
                                    <?php
                                    delete_category();
                                    ?>
                                </tbody>
                            </table>
                        </div>

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