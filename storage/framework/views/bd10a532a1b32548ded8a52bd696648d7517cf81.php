<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'TulogKalinga')); ?></title>

    <!-- Fonts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/083ba5d621.js" crossorigin="anonymous"></script>

    <style>
        body {
            background: #fff;
            color: #000;
            font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
            font-size: 16px;
            line-height: 28px;
            margin: 0
        }

        h1,h2,h3,h4,h5,h6,li,p {
            margin: 0 0 16px
        }

        h1 {
            font-size: 40px;
            line-height: 60px
        }

        h1,h2 {
            font-weight: 700
        }

        h2 {
            font-size: 32px;
            line-height: 48px
        }

        h3 {
            font-size: 24px;
            line-height: 36px
        }

        h3,h4 {
            font-weight: 700
        }

        h4 {
            font-size: 20px;
            line-height: 30px
        }

        h5,h6 {
            font-size: 16px;
            line-height: 24px;
            font-weight: 700
        }

        a {
            text-decoration: none;
            cursor: pointer;
            color: #000
        }

        a:hover,a[rel~=nofollow] {
            text-decoration: underline
        }

        a[rel~=nofollow] {
            color: #553df4
        }

        a[rel~=nofollow]:hover {
            text-decoration: none
        }

        .visible {
            display: block
        }

        .hidden {
            display: none
        }

        .page {
            width: 100%
        }

        .container {
            position: relative;
            width: 90%;
            max-width: 1024px;
            margin: 0 auto
        }

        .header {
            padding: 16px 0
        }

        .header .title {
            font-size: 40px;
            line-height: 60px;
            font-weight: 700;
            margin: 0
        }

        .translations-list-container {
            padding-bottom: 8px;
            margin: 0 0 16px
        }

        .translations-list-container .translations-list {
            margin: 0;
            padding: 0;
            list-style: none
        }

        .translations-list-container .translations-list .translations-list-item {
            display: inline-block;
            padding: 0;
            margin: 0 8px 8px 0;
            font-weight: 700;
            color: #553df4
        }

        .translations-list-container .translations-list .translations-list-item a {
            display: inline-block;
            color: #553df4;
            border: 1px solid #553df4;
            border-radius: 32px;
            padding: 4px 16px
        }

        .translations-content-container {
            padding-top: 16px;
            border-top: 1px solid #eee
        }

        .footer {
            border-top: 1px solid #eee;
            margin: 32px 0 0;
            padding: 16px 0
        }

        
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <div class="container">
                <p class="title">Terms & Conditions</p>
            </div>
        </div>
        <div class="translations-content-container">
            <div class="container">
                <div>
                    <p>
                        Welcome to TulogKalinga's online platform. By accessing our website and 
                        using our services, you agree to comply with and be bound by the following 
                        terms and conditions. Please read these terms carefully before using our website.
                    </p>
                    <span>1. <b>User Responsibilities:</b></span>
                    <ul style="list-style-type:disc;">
                        <li>
                            Users are responsible for the accuracy of the information provided during registration.
                        </li>
                        <li>
                            Users must comply with all applicable laws and regulations.
                        </li>
                    </ul>
                    <span>2. <b>Intellectual Property:</b></span>
                    <ul style="list-style-type:disc;">
                        <li>
                            All content on the Tulog Kalinga website, including text, graphics, logos, and images, 
                            is the property of TulogKalinga and is protected by intellectual property laws.
                        </li>
                    </ul>
                    <span>3. <b>Data Privacy:</b></span>
                    <ul style="list-style-type:disc;">
                        <li>
                            Users' personal and sleep data will be handled in accordance with our Privacy Policy.
                        </li>
                        <li>
                            TulogKalinga reserves the right to use aggregated and anonymized data for research 
                            and improvement purposes.
                        </li>
                    </ul>
                    <span>4. <b>Security:</b></span>
                    <ul style="list-style-type:disc;">
                        <li>
                            Users are responsible for maintaining the confidentiality of their login credentials.
                        </li>
                        <li>
                            Unauthorized access attempts or any form of cyber attack will be subject to legal action.
                        </li>
                    </ul>
                    <span>5. <b>Limitation of Liability:</b></span>
                    <ul style="list-style-type:disc;">
                        <li>
                            TulogKalinga is not liable for any direct, indirect, incidental, consequential, or punitive 
                            damages arising from the use of our website or devices.
                        </li>
                    </ul>
                    <span>6. <b>Modifications:</b></span>
                    <ul style="list-style-type:disc;">
                        <li>
                            TulogKalinga reserves the right to modify or update these terms and conditions at any time. 
                            Users are encouraged to review the terms periodically.
                        </li>
                    </ul>
                    <p>
                        By using Tulogkalinga's website and services, you agree to these terms and conditions. 
                        If you do not agree with any part of these terms, please refrain from using our platform.
                    </p>
                </div>
            </div>
        </div>
    </div>
<!-- Scripts -->
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html><?php /**PATH C:\laragon\www\iot-app\resources\views/pages/terms_and_conditions.blade.php ENDPATH**/ ?>