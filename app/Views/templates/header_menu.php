<header class="header clearfix d-flex">
    <button type="button" class="menu-open menu-btn d-block d-xl-none align-self-center"><span class="sr-only">MENU</span></button>

    <div class="logo"><a href="<?php echo base_url('dashboard'); ?>"><img src="<?php echo base_url('assets/images/admin-logo.png'); ?>" alt=""></a></div>

    <h5 class="align-self-center"><?php echo $_SESSION['loginUserType']; ?></h5>

    <div class="user-info ml-auto d-none d-lg-block align-self-center mr-3">
        <h4>Welcome back <strong><strong><?php echo $_SESSION['firstName']; ?> <?php echo $_SESSION['lastName']; ?></strong></h4>
        <?php 
        if(!empty($_SESSION['lastLogin'])){ ?>
            <p>Last Logged In:<?php echo $_SESSION['lastLogin']; ?></p>
        <?php 
        } ?>
    </div>
    <div class="h-100 d-flex align-items-center mr-3">
        <a href="<?php echo base_url('logout'); ?>" class="logout align-self-center"><i class="fas fa-power-off"></i></a>
    </div>
</header>