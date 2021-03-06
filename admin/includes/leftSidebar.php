<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Profile</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="posts_dropdown" class="collapse">
                <li>
                    <a href="posts.php?source=viewpost">View all posts</a>
                </li>
                <li>
                    <a href="posts.php?source=addpost">Add posts</a>
                </li>
            </ul>
        </li>
        <li class="active">
            <a href="categories.php"><i class="fa fa-fw fa-desktop"></i> Categories</a>
        </li>
        <li>
            <a href="comments.php"><i class="fa fa-fw fa-wrench"></i> Comments</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="users.php?source=viewuser">View all users</a>
                </li>
                <li>
                    <a href="users.php?source=adduser">Add users</a>
                </li>
            </ul>
        </li>
    </ul>
</div>