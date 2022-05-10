<nav class="navbar navbar-expand-lg py-3 fixed-top navbar-dark bg-primary">
    <div class="container">

        <?php 
    // get URL
      $host = 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

      // If the user is on the register pages
        if($host == URLROOT . 'users/register' || $host == URLROOT . 'users/registerbusiness' || $host == URLROOT . 'users/verify' || $host == URLROOT . '/users/registerbusiness' || $host == URLROOT . '/users/verify' ) : ?>

        <a class="navbar-brand" href="<?php echo URLROOT; ?>"><i class="bi bi-house-fill">
            </i><?php echo SITENAME; ?></a>
        <button class="btn navbar-toggler" id="toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span></button>
        </button>

        <div id="navmenu" class="collapse navbar-collapse text-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>pages#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>pages#faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>pages#contact">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="<?php echo URLROOT; ?>users/register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>users/login">Login</a>
                </li>
            </ul>
        </div>

        <?php // When the user logs in
    elseif(isset($_SESSION['user_email'])) : ?>
        <a class="navbar-brand" href="<?php echo URLROOT; ?>dashboard"><i class="bi bi-house-fill">
            </i><?php echo SITENAME; ?></a>
        <button class="btn navbar-toggler" id="toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span></button>
        </button>

        <div id="navmenu" class="collapse navbar-collapse text-light">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="<?php echo URLROOT; ?>dashboard/editAccount">Edit Account <i
                            class="fa fa-gear"></i></a>
                </li>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="<?php echo URLROOT; ?>users/logout">Logout <i
                            class="fa fa-power-off"></i></a>
                </li>
            </ul>
        </div>

        <?php // When the admin logs in
    elseif(isset($_SESSION['username'])) : ?>
        <a class="navbar-brand" href="<?php echo URLROOT; ?>admins/dashboard">
            <i class="bi bi-house-fill"></i>
            <?php echo SITENAME; ?>
        </a>
        <button class="btn navbar-toggler" id="toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span></button>
        </button>

        <div id="navmenu" class="collapse navbar-collapse text-light">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="<?php echo URLROOT; ?>admins">
                        Home
                    </a>
                </li>
                <!-- dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Site Data
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>admins/properties">
                                Properties
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>admins/companies">
                                Companies
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>admins/users">
                                Users
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>admins/universities">
                                Universities
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="<?php echo URLROOT; ?>admins/messages">
                        Messages
                    </a>
                </li>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="<?php echo URLROOT; ?>admins/logout">
                        Logout
                        <i class="fa fa-power-off"></i></a>
                </li>
            </ul>
        </div>

        <?php // All other pages
    else : ?>
        <a class="navbar-brand" href="<?php echo URLROOT; ?>"><i class="bi bi-house-fill">
            </i><?php echo SITENAME; ?></a>
        <button class="btn navbar-toggler" id="toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span></button>
        </button>

        <div id="navmenu" class="collapse navbar-collapse text-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>pages#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>pages#faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>pages#contact">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="<?php echo URLROOT; ?>users/register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>users/login">Login</a>
                </li>
            </ul>
        </div>

        <?php endif; ?>

    </div>
</nav>