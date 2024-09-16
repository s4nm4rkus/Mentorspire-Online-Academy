

<?php $__env->startSection('content'); ?>
    <div style="height: 100%; overflow-y: auto; background-color: #f0f0f0; position: relative;">
        <!-- Centered Greetings Section -->
        <div
            style="position: absolute; top: 20%; left: 50%; transform: translate(-50%, -50%); text-align: center; font-family: 'Inter', sans-serif; color: #0C517B;">
            <h1 class="greetings" style="font-size: 45px; font-weight: 800; margin: 0; margin-top: -5rem;">
                Congratulations!
            </h1>
            <div class="greetings-cert" style="font-size: 16px; font-weight: 400; color: #333; margin-top: 5px;">
                <p style="margin: 0;">
                    You have successfully completed the <strong><?php echo e($courses->course_title); ?></strong>. Your Certificate of
                    Completion is now available for download.
                </p>
            </div>
        </div>

        <!-- Certificate Content Section -->
        <div id="certificate-content"
            style="position: relative; width: 900px; height: 600px; margin: 13rem auto 1rem auto; padding: 20px;">
            <img class="certificate" src="<?php echo e(asset('/images/certificate-bg.png')); ?>" alt="certificate-logo"
                style="display: block; width: 100%; height: 100%;">
            <img class="logo-cert" src="<?php echo e(asset('/images/logo-cert.png')); ?>" alt=""
                style="position: absolute; top: 20px; left: 50%; transform: translateX(-50%); width: 180px; height: auto; margin-top: 13px;">

            <div
                style="position: absolute; top: 120px; left: 50%; transform: translateX(-50%); text-align: center; width: 100%;">
                <h1 class="title-cert"
                    style="font-family: 'Inter', sans-serif; font-size: 35px; margin: 0; color: #0C517B; font-weight: 800; margin-top: 1rem;">
                    CERTIFICATE OF COMPLETION
                </h1>
            </div>

            <p
                style="position: absolute; top: 180px; left: 50%; transform: translateX(-50%); text-align: center; font-family: 'Inter', sans-serif; font-size: 15px; color: #333; margin-top: -5px; font-weight: 600;">
                THIS IS TO CERTIFY THAT
            </p>

            <div
                style="position: absolute; top: 220px; left: 50%; transform: translateX(-50%); text-align: center; font-family: 'Inter', sans-serif; font-size: 33px; color: #0C517B; font-weight: 800;">
                <?php echo e(ucfirst($student->firstname)); ?> <?php echo e(ucfirst($student->lastname)); ?>

            </div>
            <hr
                style="position: absolute; top: 250px; left: 50%; transform: translateX(-50%); width: 60%; height: 2px; background-color: #0C517B; border: none;">

            <p
                style="position: absolute; top: 280px; left: 50%; transform: translateX(-50%); text-align: center; font-family: 'Inter', sans-serif; font-size: 15px; color: #333; width: 60%;">
                has successfully completed the <strong><?php echo e($courses->course_title); ?></strong> course offered by Mentorspire
                Information Technology Services Online Academy.
            </p>

            <div class="cert-date"
                style="position: absolute; top: 340px; left: 50%; transform: translateX(-50%); text-align: center; font-family: 'Inter', sans-serif; font-size: 15px; color: #333; margin-top: 12px;">
                Completed on <strong><?php echo e($completionDate->format('F j, Y')); ?></strong>
            </div>

            <div style="position: absolute; top: 400px; left: 50%; transform: translateX(-50%); text-align: center;">
                <img class="medal" src="<?php echo e(asset('/images/medal.png')); ?>" alt="medal"
                    style="width: 80px; height: auto; margin-top: -1rem;">
                <p
                    style="font-family: 'Inter', sans-serif; font-size: 14px; color: #333; font-weight: 600; margin: 0; margin-top: 1.5rem;">
                    Jayson Villarama</p>
                <p style="font-family: 'Inter', sans-serif; font-size: 12px; color: #333; margin-top: 2px;">
                    Founder/Owner</p>
            </div>
        </div>

        <!-- Certificate Download Buttons -->
        <div style="text-align: center; margin-top: 15px; margin-bottom: 5rem;">
            <button id="download-image-btn" 
                style="padding: 10px 20px; background-color: #0C517B; color: #fff; text-decoration: none; border-radius: 5px; cursor: pointer;">
                Download as Image
            </button>
            <button id="download-pdf-btn"
                style="padding: 10px 20px; background-color: #0C517B; color: #fff; text-decoration: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">
                Download as PDF
            </button>
        </div>
    </div>

    <!-- Include html2canvas and jsPDF Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.getElementById('download-image-btn').addEventListener('click', function() {
            html2canvas(document.getElementById('certificate-content'), {
                scale: 5, // Higher scale factor for super HD quality
                backgroundColor: null, // Ensure the background is transparent
                useCORS: true // Enable CORS to handle external resources
            }).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const userName = '<?php echo e(ucfirst($student->firstname)); ?> <?php echo e(ucfirst($student->lastname)); ?>';
                const fileName = `${userName} Certificate.png`.replace(/\s+/g,
                    '_'); // Replace spaces with underscores
                const link = document.createElement('a');
                link.href = imgData;
                link.download = fileName;
                link.click();
            }).catch(function(error) {
                console.error('Error generating image:', error);
            });
        });

        document.getElementById('download-pdf-btn').addEventListener('click', function() {
            const {
                jsPDF
            } = window.jspdf;
            const pdf = new jsPDF('landscape', 'pt', 'a4');
            html2canvas(document.getElementById('certificate-content'), {
                scale: 5, // Higher scale factor for super HD quality
                backgroundColor: null, // Ensure the background is transparent
                useCORS: true // Enable CORS to handle external resources
            }).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const width = pdf.internal.pageSize.getWidth();
                const height = (canvas.height * width) / canvas.width;

                pdf.addImage(imgData, 'PNG', 0, 0, width, height);
                const userName = '<?php echo e(ucfirst($student->firstname)); ?> <?php echo e(ucfirst($student->lastname)); ?>';
                const fileName = `${userName} Certificate.pdf`.replace(/\s+/g,
                    '_'); // Replace spaces with underscores
                pdf.save(fileName);
            }).catch(function(error) {
                console.error('Error generating PDF:', error);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Auth::check() ? 'layouts.homelayout' : 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\iot-app\resources\views/pages/certificate.blade.php ENDPATH**/ ?>