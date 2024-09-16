

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/privacypolicy_termsandaggreement.css')); ?>" />
    <div class="container"
        style="height: 80%; display: block; justify-content: center; align-items: center; margin: 0 auto;">
        <div class="row justify-content-center  mt-4">
            <div class="card pt-4 shadow lg">

                <form method="POST" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="card-body emailcard">
                        <div class="row justify-content-center">
                            <img class="logoimg" src="<?php echo e(asset('/images/logo.png')); ?>" alt="logo">
                            <h2 class="loginlbl fs-5">Sign-up Here</h2>

                            <div class="row flex justify-content-center mt-2">
                                <label for="email" class="label2"><?php echo e(__('Email Address')); ?></label>
                                <input id="email" type="email"
                                    class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                    value="<?php echo e(old('email')); ?>" required autocomplete="email">
                                <?php $__errorArgs = ['email'];
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


                            <div class="row flex justify-content-center mt-3">
                                <button id="hideButton1" type="button" class="btn btn-primary loginbtn">
                                    <?php echo e(__('Next')); ?>

                                </button>
                            </div>
                            <div class="row flex justify-content-center labelreglink">
                                <p class="labelreglink mt-1">Already have an account? <a class="btn registerlink"
                                        href="<?php echo e(route('login')); ?>"> Login</a>
                            </div>

                        </div>
                    </div>


                    <div class="card-body namecard">
                        <button id="back1" class="back1">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>

                        <div class="row justify-content-center">
                            <img class="logoimg" src="<?php echo e(asset('/images/logo.png')); ?>" alt="logo">
                            <h2 class="loginlbl fs-5">Sign-up Here</h2>
                        </div>
                        <div class="row flex justify-content-center">
                            <label for="firstname" class="label"><?php echo e(__('Firstname')); ?></label>
                            <input name="firstname" id="firstname" type="text"
                                class="form-control <?php $__errorArgs = ['firstname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('firstname')); ?>" required autocomplete="firstname" autofocus>

                            <?php $__errorArgs = ['firstname'];
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


                        <div class="row flex justify-content-center mt-4">
                            <label for="lastname" class="label"><?php echo e(__('Lastname')); ?></label>

                            <input name="lastname" id="lastname" type="text"
                                class="form-control <?php $__errorArgs = ['lastname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('lastname')); ?>"
                                required autocomplete="lastname" autofocus>

                            <?php $__errorArgs = ['lastname'];
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

                        <div class="row flex justify-content-center">
                            <button id="hideButton2" type="button" class="btn btn-primary loginbtn">
                                <?php echo e(__('Next')); ?>

                            </button>
                        </div>
                        <div class="row flex justify-content-center labelreglink">
                            <p class="labelreglink mt-1">Already have an account? <a class="btn registerlink"
                                    href="<?php echo e(route('login')); ?>"> Login</a>
                        </div>

                    </div>

                    

                    <div class="card-body passwordcard">
                        <button id="back2" class="back1">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <div class="row justify-content-center">
                            <img class="logoimg" src="<?php echo e(asset('/images/logo.png')); ?>" alt="logo">
                            <h2 class="loginlbl fs-5">Sign-up Here</h2>
                        </div>

                        <div class="row flex justify-content-center">
                            <label for="password" class="label"><?php echo e(__('Password')); ?></label>
                            <input name="password" id="password" type="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required
                                autocomplete="new-password">

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

                        <div class="row flex justify-content-center mt-4">
                            <label style="margin-left: -13.5rem" for="password-confirm"
                                class="label"><?php echo e(__('Confirm Password')); ?></label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>

                        <div class="container d-flex justify-content-center pb-2">
                            <div class="form-check mt-1 d-flex justify-content-center">
                                <input class="form-check-input ms-2" type="checkbox" value=""
                                    id="flexCheckDefault" required>
                                <label class="form-check-label labelreglink"
                                    for="flexCheckDefault">
                                    <span style="font-weight: 300; ">By signing up, I agree to the <a type="button"
                                            id="TCButton"><i>Terms &
                                                Conditions</i></a> and <a type="button" id="PPButton"><i>Privacy
                                                Policy.</i></a></span>
                                </label>
                            </div>
                        </div>

                        <div class="row flex justify-content-center ">
                            <button type="submit" class="btn btn-primary loginbtn">
                                <?php echo e(__('Register')); ?>

                            </button>
                        </div>
                        <div class="row flex justify-content-center labelreglink">
                            <p class="labelreglink mt-1">Already have an account? <a class="btn registerlink"
                                    href="<?php echo e(route('login')); ?>"> Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function() {
            $("#TCButton").on("click", function(e) {
                e.preventDefault();
                window.open('/terms-and-conditions', '_blank');
            })

            $("#PPButton").on("click", function(e) {
                e.preventDefault();
                window.open('/privacy-policy', '_blank');
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\iot-app\resources\views/auth/register.blade.php ENDPATH**/ ?>