

<?php $__env->startSection('content'); ?>


<div class="container d-flex">
    <p class="startlabel"> Testing Page</p>
</div> 

<div class="main-content">
    <main class="">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(Auth::check() ? 'layouts.homelayout' : 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\iot-app\resources\views/pages/admin/testingpage.blade.php ENDPATH**/ ?>