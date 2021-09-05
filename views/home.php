<?php include __DIR__.'/components/top.php'; ?>

</head>
<body>

<!-- Pre-loader start -->
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            

        <?php include __DIR__.'/components/navbar.php'; ?>
    
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                <?php include __DIR__.'/components/sidebar.php'; ?>
                    
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Dashboard</h5>
                                            <p class="m-b-0">Home</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="<?php url('/'); ?>"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="<?php url('/'); ?>">Home</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                        
                                            <div class="col-xl-3 col-md-6">
                                                <a href="<?php url('pessoas'); ?>">
                                                    <div class="card">
                                                        <div class="card-block">
                                                            <div class="row align-items-center">
                                                                <div class="col-8">
                                                                    <h4 class="text-c-blue"><?php echo count($customers->items); ?></h4>
                                                                    <h6 class="text-muted m-b-0"><?php echo count($customers->items) == 0 || count($customers->items) > 1 ? ' Pessoas' : ' Pessoa'; ?></h6>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    <i class="ti-user f-28"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer bg-c-blue">
                                                            <div class="row align-items-center">
                                                                <div class="col-9">
                                                                    <p class="text-white m-b-0"><?php echo count($customers->items) . (count($customers->items) == 0 || count($customers->items) > 1 ? ' pessoas cadastradas' : ' pessoa cadastrada'); ?></p>
                                                                </div>
                                                                <div class="col-3 text-right">
                                                                    <!--a href="<?php url('pessoas'); ?>">
                                                                        <i class="ti-share text-white f-16"></i>
                                                                    </a-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                                <div id="styleSelector"> </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include __DIR__.'/components/scripts.php'; ?>

<?php include __DIR__.'/components/footer.php'; ?>
