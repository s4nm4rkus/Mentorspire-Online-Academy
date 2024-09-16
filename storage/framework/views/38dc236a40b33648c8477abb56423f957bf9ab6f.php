<link rel="stylesheet" href="<?php echo e(asset('css/footer.css')); ?>" />
<div class="foot_container">
    <div class="col text-center">
        <span class="d-block py-2 m-0">
            <strong>Copyright © 2024 &nbsp;<span class="vl"></span></strong> &nbsp;&nbsp;&nbsp;<a type="button"
                id="TCButton">mentorspireitservices@gmail.com</a>
        </span>
    </div>
</div>

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
<?php /**PATH C:\laragon\www\iot-app\resources\views/partials/footer.blade.php ENDPATH**/ ?>