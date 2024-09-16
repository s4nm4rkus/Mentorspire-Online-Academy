
<?php $__env->startSection('content'); ?>
    <link href="<?php echo e(asset('css/createcourses.css')); ?>" rel="stylesheet">
    <div class="page_layout">
        <div class="main  p-4">
            <div class=" d-flex pt-2">
                <div class="d-flex pt-2">
                    <a href="<?php echo e(url()->previous()); ?> " class="backtocoursebtn">
                        <p style="text-decoration: none; color: #111; font-size: 1rem; margin-top: -2rem"><i
                                class="fa-solid fa-arrow-left backicon"></i> Activities</p>
                    </a>
                    
                </div>
            </div>


            <div class="ms-3" style="width: 80%;">
                <?php if($activities): ?>
                    <h5 class="card-title mt-2 fs-3 " style="color: #01a345; font-weight:bold;">Activity
                        <?php echo e($activities->activity_number); ?>

                    </h5>

                    <h5 class="card-title mt-3 fs-5 " style="color: #000000; font-weight:600;">
                        <?php echo e($activities->activity_title); ?>

                    </h5>
                    <p class="course_description  mt-1" style="color: rgb(20, 20, 20); text-align:justify;">
                        <?php echo e($activities->activity_description); ?></p>
                <?php else: ?>
                    <p>No course found.</p>
                <?php endif; ?>
            </div>


            <div class="m-0" style="background-color: transparent; text-align: center; padding:0;">
                <div style="text-align: center; margin-bottom: 1rem;">
                    <h5 class="card-title ms-0 mt-2  " style="color:#18527B; font-weight:500; font-size: 1rem;">
                        Activity attachments
                    </h5>
                    <hr class="hrview ms-4 mb-3" style="border-color: black;">
                </div>

                
            </div>

            <div class="pc-tab pctab2  mt-3">
                <input checked="checked" id="tab4" type="radio" name="pct" />
                <input id="tab5" type="radio" name="pct" />
                <input id="tab6" type="radio" name="pct" />
                <nav>
                    <ul>
                        <li class="tab4">
                            <label for="tab4"><i class="fa-solid fa-file-lines fs-2"></i></label>

                        </li>
                        <li class="tab5">
                            <label for="tab5"><i class="fa-solid fa-image fs-2"></i></label>
                        </li>
                        <li class="tab6">
                            <label for="tab6"><i class="fa-solid fa-film fs-2"></i></label>
                        </li>
                    </ul>
                </nav>
                <section class="" style="box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.08);">
                    <div class="tab4 myDiv mb-3 mt-0 pt-5 pb-5">

                        <?php if($activityfiles->isEmpty()): ?>
                            <p style="margin-left: 43%;">No attatchments found.</p>
                        <?php else: ?>
                            <?php $__currentLoopData = $activityfiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activityfile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="pt-2 pb-2 ps-2 pe-3 ms-5 me-5 mb-2 d-flex"
                                    style="box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.08);">
                                    <?php if($activityfile->activity_doc): ?>
                                        <a style="text-decoration: none; background-color: white;"
                                            href="<?php echo e($activityfile->activity_doc); ?>" target="_blank">
                                            <!-- Display a file icon instead of an image -->
                                            <img src="<?php echo e(asset('/images/file.png')); ?>" class="m-0 pe-3"
                                                style="width: auto; height: 5rem; border-right: solid 1px; border-color: #ccc; padding: 0; ">
                                        </a>
                                        <div class="ms-3 mt-0 pt-0">
                                            
                                            <p class="course_description mt-0 pt-0"
                                                style="color: rgb(20, 20, 20); text-align:justify;">
                                                <?php echo e($activityfile->activity_doc_name); ?>

                                            </p>
                                            <?php if(auth()->guard()->check()): ?>
                                                <?php if(auth()->user()->role === 'user'): ?>
                                                    <form action="<?php echo e(route('download.activity.file.doc', $activityfile->id)); ?>"
                                                        method="GET">
                                                        <?php echo csrf_field(); ?>
                                                        <button class=" actvityfileDL" type="submit" style="font-size:13px; margin-top: .6rem; ">
                                                            Save <i style="text-decoration: underline 2px"
                                                            class="fas fa-arrow-down ms-1"></i>
                                                        </button>
                                                    </form>    
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>    
                                    <?php else: ?>
                                        <i class="fas fa-file-alt" style="font-size: 5rem; color: #ccc;"></i>
                                    <?php endif; ?>

                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if(auth()->user()->role === 'admin'): ?>
                                            <form action="<?php echo e(route('delete.activity.file', $activityfile->id)); ?>"
                                                method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="delvid"
                                                    style="position:absolute; margin-top: 1.7rem; right: 4.5rem;  border: none; "><i
                                                        style="font-size: 1.2rem;" class="fa-solid fa-trash "></i></button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>



                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>

                    <div class="tab5 myDiv mb-3 mt-0 pt-5 pb-5">
                        <?php if($activityfilesimages->isEmpty()): ?>
                            <p style="margin-left: 43%;"> No attatchments found.</p>
                        <?php else: ?>
                            <?php $__currentLoopData = $activityfilesimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activityfile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="pt-2 pb-2 ps-2 pe-3 ms-5 me-5 mb-2 d-flex"
                                    style="box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.08);">

                                    <div class="course_img p-0 pe-3 d-flex justify-content-center"
                                        style = "height: 5rem; width: 10rem; border-right: solid 1px; border-color: #ccc; padding: 0;">

                                        <img class="course_poster p-0" src="<?php echo e($activityfile->activity_image); ?>"
                                            alt="...">
                                    </div>
                                  
                                    <div class="ms-3 mt-0 pt-0">
                                        <p class="course_description mt-0 pt-0"
                                            style="color: rgb(20, 20, 20); text-align:justify;">
                                            <?php echo e($activityfile->activity_image_name); ?>

                                        </p>

                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(auth()->user()->role === 'user'): ?>
                                                <form action="<?php echo e(route('download.activity.file.image', $activityfile->id)); ?>"
                                                    method="GET">
                                                    <?php echo csrf_field(); ?>
                                                    <button class=" actvityfileDL" type="submit" style="font-size:13px; margin-top: .6rem; ">
                                                        Save <i style="text-decoration: underline 2px"
                                                        class="fas fa-arrow-down ms-1"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>


                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if(auth()->user()->role === 'admin'): ?>
                                            <form action="<?php echo e(route('delete.activity.file_image', $activityfile->id)); ?>"
                                                method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="delvid"
                                                    style="position:absolute; margin-top:1.7rem; right: 4.5rem;  border: none; "><i
                                                        style="font-size: 1.2rem;" class="fa-solid fa-trash "></i></button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </div>

                    <div class="tab6 myDiv mb-3 mt-0 pt-5 pb-5">
                        <?php if($activityfilesvideos->isEmpty()): ?>
                            <p style="margin-left: 43%;"> No attatchments found.</p>
                        <?php else: ?>
                            <?php $__currentLoopData = $activityfilesvideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activityfile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="pt-2 ps-2 pe-3 ms-5 me-5 mb-2 d-flex"
                                    style="box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.08);">
                                    <video class="pe-3 m-0"
                                        style="height: 5rem; width: auto; border-right: solid 1px; border-color: #ccc;"
                                        class="course_poster" controls>
                                        <source src="<?php echo e($activityfile->activity_video); ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    
                                    <div class="ms-3 mt-0 pt-0">
                                        <p class="course_description mt-0 pt-0"
                                            style="color: rgb(20, 20, 20); text-align:justify;">
                                            <?php echo e($activityfile->activity_video_name); ?>

                                        </p>
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(auth()->user()->role === 'user'): ?>
                                                <form action="<?php echo e(route('download.activity.file.image', $activityfile->id)); ?>"
                                                    method="GET">
                                                    <?php echo csrf_field(); ?>
                                                    <button class="actvityfileDL mb-0" type="submit" style="font-size:13px; margin-top: .6rem; ">
                                                        Save <i style="text-decoration: underline 2px"
                                                        class="fas fa-arrow-down ms-1"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        <?php endif; ?>    
                                    </div>

                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if(auth()->user()->role === 'admin'): ?>
                                            <form action="<?php echo e(route('delete.activity.file_video', $activityfile->id)); ?>"
                                                method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="delvid"
                                                    style="position: absolute; margin-top: 1.7rem; right: 4.5rem;  border: none; "><i
                                                        style="font-size: 1.2rem;" class="fa-solid fa-trash "></i></button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </div>
                </section>
            </div>


            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->role === 'admin'): ?>
                    <div style="text-align: center; margin-bottom: 1rem;">
                        <h5 class="card-title ms-2 mt-5  " style="color:#18527B; font-weight:500; font-size: 1rem;">
                            Upload attachments
                        </h5>
                        <hr class="hrview ms-4 mb-3" style="border-color: black;">
                    </div>
                    <div class="inputuploads pb-4">
                        <form action="<?php echo e(route('activityfile.upload')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="uploadfiles">
                                <div class="m-3">
                                    <label for="handout_file_title" class="form-label-1">Document:</label>
                                    <input required name="activity_doc_name" type="text" class="form-control"
                                        id="course_title" placeholder="Add file name">
                                    <div name="activity_doc" id="dropzone4" class="dropzone"
                                        style="height: 140px; overflow: auto; text-align: center;">
                                        <label class="fs-6" id="uploadLabel4" style="color: #a1a1a1">
                                            <p class="p-0 m-0"><i class="fa-solid fa-file-circle-plus"
                                                    style="font-size: 2.5rem; margin-top: 2rem;"></i></p>
                                            <div style="text-align: center; width:200px;">Drag and drop files here or
                                                click to upload
                                            </div>
                                        </label>
                                        <input name="activity_doc" type="file" id="fileInput4">
                                        <div id="fileList4" class="file-list"></div>
                                    </div>

                                    <?php if($activity_id): ?>
                                        <input type="hidden" name="activity_id" value="<?php echo e($activity_id); ?>">
                                    <?php else: ?>
                                        <p>No activity found.</p>
                                    <?php endif; ?>
                                    <div style="">
                                        <button type="submit" class="btn btn-primary mt-0">Upload
                                            document</button>
                                    </div>
                                </div>
                        </form>

                        <form action="<?php echo e(route('activityfile.upload.image')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="m-3">
                                <label for="handout_image_title" class="form-label-1">Image:</label>
                                <input required name="activity_image_name" type="text" class="form-control"
                                    id="course_title" placeholder="Add file name">
                                <div name="activity_image" id="dropzone5" class="dropzone"
                                    style="height: 140px; overflow: auto; text-align: center">
                                    <label class="fs-6" id="uploadLabel5" style="color: #a1a1a1;">
                                        <p class="p-0 m-0"><i class="fa-solid fa-images"
                                                style="font-size: 2.5rem; margin-top: 2rem;"></i></p>
                                        <div style="text-align: center; width:200px;">Drag and drop files here or
                                            click to upload
                                        </div>
                                    </label>
                                    <input name="activity_image" type="file" id="fileInput5">
                                    <div id="fileList5" class="file-list"></div>
                                </div>
                            </div>
                            <?php if($activity_id): ?>
                                <input type="hidden" name="activity_id" value="<?php echo e($activity_id); ?>">
                            <?php else: ?>
                                <p>No activity found.</p>
                            <?php endif; ?>
                            <div style="margin-top: -6px">
                                <button type="submit" class="btn btn-primary ms-3 mt-0">Upload
                                    image</button>
                            </div>

                        </form>

                        <form action="<?php echo e(route('activityfile.upload.video')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="m-3">
                                <label for="handout_video_title" class="form-label-1">Video:</label>
                                <input required name="activity_video_name" type="text" class="form-control"
                                    id="course_title" placeholder="Add file name">
                                <div name="activity_video" id="dropzone6" class="dropzone"
                                    style="height: 140px; overflow: auto; text-align: center">
                                    <label class="fs-6" id="uploadLabel6" style="color: #a1a1a1">
                                        <p class="p-0 m-0"><i class="fa-solid fa-file-video"
                                                style="font-size: 2.5rem; margin-top: 2rem;"></i></p>
                                        <div style="text-align: center; width:200px;">Drag and drop files here or
                                            click to upload
                                        </div>
                                    </label>
                                    <input name="activity_video" type="file" id="fileInput6">
                                    <div id="fileList6" class="file-list"></div>
                                </div>
                            </div>
                            <?php if($activity_id): ?>
                                <input type="hidden" name="activity_id" value="<?php echo e($activity_id); ?>">
                            <?php else: ?>
                                <p>No activity found.</p>
                            <?php endif; ?>
                            <div style="margin-top: -6px">
                                <button type="submit" class="btn btn-primary ms-3 mt-0">Upload
                                    video</button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endif; ?>


        </div>
    </div>

    <style>
        .actvityfileDL{
            border-radius: 5px;
            border: none;
            background-color: #2c96e1; 
            color: white;
            transition: background-color 0.5s ease;
            padding: 3px 8px 3px 8px;
        }

        .actvityfileDL:hover{
            border-radius: 5px;
            border: none;
            background-color: #2876ad;             
            color: white;
            padding: 3px 8px 3px 8px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.homelayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\iot-app\resources\views/pages/viewactivity.blade.php ENDPATH**/ ?>