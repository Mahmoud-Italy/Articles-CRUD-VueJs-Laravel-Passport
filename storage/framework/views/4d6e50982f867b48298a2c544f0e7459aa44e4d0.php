<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <script>window.Laravel = { csrfToken: '<?php echo e(csrf_token()); ?>' }</script>
        <title>Articles</title>
        <link href="https://fonts.googleapis.com/css?family=Grand+Hotel" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans:100,200,300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo e(url('frontend/assets/css/animate.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('frontend/assets/css/icomoon.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('frontend/assets/css/bootstrap.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('frontend/assets/css/magnific-popup.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('frontend/assets/css/flexslider.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('frontend/assets/css/owl.carousel.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('frontend/assets/css/owl.theme.default.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('frontend/assets/fonts/flaticon/font/flaticon.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(url('frontend/assets/css/style.css')); ?>">
        
        <!-- Modernizr JS -->
        <script src="<?php echo e(url('frontend/assets/js/modernizr-2.6.2.min.js')); ?>"></script>
    </head>
    <body>
        
        <div id="app">
            <navbar></navbar>
            <div>
                <router-view></router-view>
            </div>
        </div>

        <script src="<?php echo e(url('frontend/assets/js/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    </body>
</html>
<?php /**PATH /Users/apple/Sites/ideas/aqarmap_articles/resources/views/welcome.blade.php ENDPATH**/ ?>