
<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('css/ContactUs.css')); ?>" rel="stylesheet">

<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h2 class="card-title"
                    style="font-weight: bold; font-family: Arial, Helvetica, sans-serif; color: #0C517B !important">
                    About Mentorspire Online Academy
                </h2>
                <p class="mt-3" style="font-size: 16px; color: #0C517B !important">
                    <strong class="font-weight-bold fs-4"> Mentorspire Online Academy </strong> is committed to empowering individuals, students, and professionals through high-quality, online training and mentorship in technology and design. Our academy offers a wide range of courses in app and software development, graphic design, UI/UX design, project management, and programming—designed to equip learners with the practical skills needed to excel in the ever-changing digital world.
                </p>
                
                <div class="content">
                   
                    <h4 class="card-title mt-4">
                        What awaits you in this journey?
                    </h4>

                    <p class="mt-3" style="font-size: 16px; color: #0C517B !important">
                        <strong class="font-weight-bold"> Our mission </strong>is to bridge the gap between traditional learning and real-world application by providing a flexible, online learning experience. Through comprehensive video lessons, downloadable handouts, and guided tutorials, we offer students and aspiring professionals the tools they need to master programming, information technology, and more.
                    </p>

                    <p class="mt-3" style="font-size: 16px; color: #0C517B !important">
                        Whether you’re a student preparing to enter the tech industry, an IT enthusiast, or a professional aiming to enhance your skills, Mentorspire offers an engaging online learning environment where you can study at your own pace, anytime and anywhere. Each course is designed with hands-on experience in mind, led by industry experts who are passionate about helping you succeed.
                        Join us at Mentorspire Online Academy, where learning, innovation, and opportunity come together. Let’s shape the future of technology—together.
                    </p>
                    

                    <h4 class="card-title mt-4">
                        Why Choose Mentorspire?
                    </h4>
                    <div class="why-choose-mentorspire">
                        <ul class="mt-3">
                            <li>
                                <strong>
                                    Expert-Led Instruction:
                                </strong>
                                Learn from seasoned professionals who are passionate about IoT and dedicated to your success.
                            </li>

                            <li>
                                <strong>
                                    Project-Based Learning:
                                </strong>
                                Theory is valuable, but practical application is key. <br>Our project-centric approach ensures you develop skills that are relevant and in-demand.
                            </li>
                        </ul>
                    </div>
                </div>




            <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->user()->role === 'user'): ?>
                
                <button class="modalbtn" id="openModalBtn"><i class="fas fa-pencil-alt"></i>
                Message Us
                </button>
                <div id="modal" class="modal">
                    <div class="modal-content">
                        <div class="uppermodal">
                            <span class="close"><i class="fa-solid fa-chevron-left"></i></span>
                            <img class="logo" src="<?php echo e(asset('/images/pfp.png')); ?>" alt="logo">
                            <h2 class="mentor-name">Mentorspire Information Technology</h2>
                        </div>
                        <p class="message-intro">Compose message:</p>
                        <div class="message-content">
                            <textarea id="message" class="message" placeholder="Type your message here..."></textarea>
                            <button class="sendmessagebtn" onclick="sendEmail()"><i class="fas fa-paper-plane"></i> Send</button>
                          </div>
                          
        
                        <p>or</p>
                        <div class="social-item">
                            <div class="icon-container">
                                <button class="button facebook-icon iconbtn" onclick="openLink('https://www.facebook.com/mentorspire')">
                                    <i class="fab fa-facebook-f"></i>
                                    <p>Facebook</p>
                                </button>
                            </div>
                            <div class="icon-container">
                                <button class="button gmail-icon" onclick="openLink('mailto:mentorspireitservices@gmail.com')">
                                    <i class="far fa-envelope"></i>
                                    <p>Email</p>
                                </button>
                            </div>
                        </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php endif; ?>                        
                </div>   
            </div>            
        </div>
    </div>
</div>

<?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Auth::check() ? 'layouts.homelayout' : 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\iot-app\resources\views/pages/about.blade.php ENDPATH**/ ?>