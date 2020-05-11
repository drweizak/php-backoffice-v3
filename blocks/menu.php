<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= $path;?>dashboard">Ninpo Toronto Ninjutsu</a>
    </div>
    <ul class="nav navbar-right top-nav">
    	<li><a href="/" target="new"><i class="fa fa-eye"></i> Check Website</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $_SESSION['name']?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="<?= $path;?>users/view?id=<?= $_SESSION['user_id']?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?= $path;?>logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li <?php if($page=='dashboard'){echo 'class="active"';}?>>
                <a href="<?= $path;?>dashboard"><i class="fa fa-fw fa-home"></i> Dashboard</a>
            </li>
            <li<?php if($page=='news'){echo 'class="active"';}?>>
                <a href="<?= $path;?>news"><i class="fa fa-fw fa-newspaper-o"></i> News</a>
            </li>
            <li<?php if($page=='pages'){echo 'class="active"';}?>>
                <a href="javascript:;" data-toggle="collapse" data-target="#pages"><i class="fa fa-fw fa-file-text"></i> Pages <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="pages" class="collapse">
                    <li>
                        <a href="<?= $path;?>pages/view?id=4">Home</a>
                    </li>
                    <li>
                        <a href="<?= $path;?>pages/view?id=1">About</a>
                    </li>
                    <li>
                        <a href="<?= $path;?>pages/view?id=2">Classes</a>
                    </li>
                    <li>
                        <a href="<?= $path;?>instructors">Instructors</a>
                    </li>
                    <li>
                        <a href="<?= $path;?>pages/view?id=3">Contacts</a>
                    </li>
                </ul>
            </li>
            <li<?php if($page=='slides'){echo 'class="active"';}?>>
                <a href="<?= $path;?>slides"><i class="fa fa-fw fa-picture-o"></i> Slides</a>
            </li>
            <li <?php if($page=='users'){echo 'class="active"';}?>>
                <a href="<?= $path;?>users"><i class="fa fa-fw fa-users"></i> Users</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>