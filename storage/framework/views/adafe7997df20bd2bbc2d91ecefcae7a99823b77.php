
<?php $__env->startSection('content'); ?>
    <div class="page_layout m-0 p-0">
        <div class="main mt-0">
            <div class="container">
                <p class="startlabel"> Start Your Training Now!</p>

            </div>
            <p class="courseslabel">Courses</p>
            <div class="course_list ms-0 mb-3">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 m-0" style="padding-bottom: 5rem">
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card ms-2 me-2" id="course_card" style="box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.08);">
                            <div class="course_img">
                                <img class="course_poster pb-0" src="<?php echo e($course->course_poster); ?>" alt="...">
                            </div>
                            <div class="card-body ps-0 pe-0 " id="courseDescription">
                                <p class="course_code mb-0 mt-0"> <?php echo e($course->course_code); ?></p>
                                <h5 class="card-title mb-1"><?php echo e($course->course_title); ?></h5>
                                <p class="card-text overflow-y-scroll"
                                    style="line-height: 1rem; text-align: justify; height:100%;">
                                    <?php echo e($course->course_description); ?></p>
                            </div>

                            <a href="<?php echo e(route('course.show', ['id' => $course->id])); ?>" class="viewcourse"
                                style="z-index: 2">View</a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->role === 'admin'): ?>
                            <div class="card addcoursecard ms-2 me-2" id="course_card">
                                <a class="m-0"
                                    style="text-decoration: none; text-align:center; background: transparent; color: #fff"
                                    href="<?php echo e('/addcourse'); ?>">
                                    
                                    <i class="fa-solid fa-plus d-flex justify-content-center"
                                        style="font-size: 5rem; font-weight:400; color: #ffffff"></i>
                                    <p>Add Course</p>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <style>
        .viewcourse {
            padding: .3rem;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            margin-bottom: 1rem;
            font-family: "Inter", sans-serif;
            background-color: #40afff;
        }

        .viewcourse:hover {
            margin-bottom: 1rem;
            font-family: "Inter", sans-serif;
            background-color: #33a7f9;
        }
    </style>
    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Auth::check() ? 'layouts.homelayout' : 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\iot-app\resources\views/pages/home.blade.php ENDPATH**/ ?>