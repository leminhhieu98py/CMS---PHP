<div class="col-md-4" style="margin-top: 100px;">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" name="submit" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Lead to Login action -->
    <div class="well">
        <h4>Login form</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">
                        <span class="">Submit</span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    $query = "SELECT * FROM categories";
                    $select_all_from_categories = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($select_all_from_categories)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                    ?>
                        <li><a href="index.php?cat_id=<?= $cat_id ?>"><?= $cat_title ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>