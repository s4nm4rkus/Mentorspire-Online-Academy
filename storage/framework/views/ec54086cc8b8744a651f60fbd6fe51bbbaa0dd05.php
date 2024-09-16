<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('images/titlelogo2.ico')); ?>">

    <title><?php echo e(config('app.name', 'Mentorspire IOT')); ?>

    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>



    <!-- Scripts -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap/app.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>" />

</head>

<body>
    <div id="app">
        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/register.js')); ?>"></script>


</body>

</html>
<?php /**PATH C:\laragon\www\iot-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>