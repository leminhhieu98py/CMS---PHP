<?php

function load_category()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $select_all_from_categories = mysqli_query($connection, $query);
    $key = 1;
    while ($row = mysqli_fetch_assoc($select_all_from_categories)) {
        $id = $row["cat_id"];
        $cat_title = $row["cat_title"];
        $deleteLink = "categories.php?delete=" . $id;
        $editLink = "categories.php?edit=" . $id;
?>
        <tr>
            <td><?= $key ?></td>
            <td><?= $cat_title ?></td>
            <td><a href=<?= $deleteLink ?>>Delete</a> <a href=<?= $editLink ?>>Edit</a></td>
        </tr>
    <?php
        $key++;
    }
}

function create_category()
{
    if (isset($_POST['submit'])) {
        global $connection;
        if ($_POST['cat_title'] == "" || empty($_POST['cat_title'])) {
            echo "This field should not be empty";
        } else {
            $cat_title = $_POST['cat_title'];
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}')";
            $add_category = mysqli_query($connection, $query);
            if (!$add_category) {
                die("Query failed " . mysqli_error($connection));
            } else {
                header("Location: categories.php");
            }
        }
    }
}

function edit_category()
{
    if (isset($_GET['edit'])) {
        global $connection;
        $cat_id = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
        $select_all_from_categories = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_all_from_categories)) {
            $cat_title = $row["cat_title"];
        }
    ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="cat-title"></label>
                <input type="text" id="cat-title" name="cat_title" placeholder="Choose a category to edit" class="form-control" value="<?= isset($cat_title) ? $cat_title : '' ?>">
                <input type="hidden" name="cat_id" value="<?= isset($cat_id) ? $cat_id : '' ?>">

                <!-- Update category to the database -->
                <?php
                if (isset($_POST['update'])) {
                    if ($_POST['cat_title'] == "" || empty($_POST['cat_title'])) {
                        echo "This field should not be empty";
                    } else {
                        $cat_title = $_POST['cat_title'];
                        $cat_id = $_POST['cat_id'];
                        $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id}";
                        $update_category = mysqli_query($connection, $query);
                        if (!$update_category) {
                            die("Query failed " . mysqli_error($connection));
                        } else {
                            header("Location: categories.php");
                        }
                    }
                }
                ?>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="update" value="" <?= (isset($_GET['edit'])) ? '' : 'disabled' ?>>Update category</button>
            </div>
        </form>
<?php
    }
}

function delete_category()
{
    if (isset($_GET['delete'])) {
        global $connection;
        $cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
        $delete_category = mysqli_query($connection, $query);
        if (!$delete_category) {
            die("Query failed " . mysqli_error($connection));
        } else {
            header("Location: categories.php");
        }
    }
}
