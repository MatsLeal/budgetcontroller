<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Budget !')); ?></title>
<link rel="stylesheet" href="https://unpkg.com/bulmaswatch/flatly/bulmaswatch.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>

    <!-- Styles -->
</head>
<body>
    <div id="app">
        
        <?php echo $__env->make('layouts.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Scripts -->

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="<?php echo e(asset('js/master.js')); ?>"></script>
</body>
</html>
