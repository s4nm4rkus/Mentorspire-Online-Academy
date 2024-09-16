
<?php $__env->startSection('content'); ?>
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">
    <div class="container" style=" display: block; justify-content: center; align-items: center; margin: 0 auto;">
        <div class="row justify-content-center  mt-4 logincss">

            <div class="card pt-4 shadow-lg">

                <style>
                    .card {
                        width: 30rem;
                    }

                    @media only screen and (max-width: 768px) {
                        .card {
                            width: 100%;
                        }
                    }
                </style>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <img class="logoimg" src="<?php echo e(asset('/images/logo.png')); ?>" alt="logo">
                        <h2 class="loginlbl fs-5">Log-in Here</h2>
                        <label for="email" class="labelemail"><?php echo e(__('Email Address')); ?></label>
                        <div class="d-flex justify-content-center">
                            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span style="position:absolute; margin-top: 3rem; font-size: 12px;" class="invalid-feedback"
                                    role="alert">
                                    <?php echo e($message); ?>

                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <label for="password" class="label mt-4"><?php echo e(__('Password')); ?></label>
                        <div class="d-flex justify-content-center">
                            <input id="password" type="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required
                                autocomplete="current-password">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <?php if(Route::has('password.request')): ?>
                            <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                <?php echo e(__('Forgot Password?')); ?>

                            </a>
                        <?php endif; ?>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary loginbtn">
                                <?php echo e(__('Login')); ?>

                            </button>
                        </div>

                        <p class="labelreglink mt-1">Don’t have an account yet?<a class="btn registerlink"
                                href="<?php echo e(route('register')); ?>">Register</a>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\iot-app\resources\views/auth/login.blade.php ENDPATH**/ ?>