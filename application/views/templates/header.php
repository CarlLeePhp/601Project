<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url()?>lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>lib/main.css">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <title>Document</title>
</head>

<body>
    <!-- start TopHeaderNav -->
    <nav>
        <div class="d-flex flex-column flex-sm-row align-items-center p-1 bg-light border-bottom shadow-sm">
            <!--Logo  -->
            <div class="nav-brand col-md-3 d-flex mx-1 justify-content-center justify-content-md-start">
                <a href="<?php echo base_url()?>index.php/home" style="text-decoration: none; color:black">
                    <img class="image-fluid" style="width:150px;height:75px"
                        src="<?php echo base_url()?>lib/images/leeRecruitmentLogo.gif" alt="company logo" />
                </a>
            </div>
            <!-- space -->
            <div class="col-md-5"></div>
            <!-- topmost Right nav -->
            <nav class="col-md-4 navbar navbar-expand-sm justify-content-around">
                <?php if($userType == 'anyone'): ?>
                <a class="nav-link text-dark mx-4" href="<?php echo base_url() ?>index.php/login">Login</a>
                <a class="nav-link text-dark mx-4" href="<?php echo base_url() ?>index.php/Register">Register</a>
                <?php else: ?>
                <a class="nav-link text-dark mx-4" href="<?php echo base_url() ?>index.php/personcenter">Personal Center</a>
                <a class="nav-link text-dark mx-4" href="<?php echo base_url() ?>index.php/login/logout">Logout</a>
                <?php endif; ?>
            </nav>
        </div>
    </nav>

    <!--BottomHeaderNav-->
    <nav class="navbar navbar-expand-sm py-3 justify-content-around border-bottom shadow-sm"
        style="background-color:#ff9900;">
        <a class="nav-link text-dark" href="<?php echo base_url() ?>">Home</a>
        <a class="nav-link text-dark" href="<?php echo base_url() ?>index.php/Jobs">Jobs</a>
        <div class="dropdown">
            <button class="dropbtn text-dark dropdown-toggle">Candidates</button>
            <div class="dropdown-content">
                <a href="<?php echo base_url() ?>index.php/CandidateMission">Our mission</a>
                <a href="<?php echo base_url() ?>index.php/CandidateMission/index/active/">Apply Jobs</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn text-dark dropdown-toggle">Employers</button>
            <div class="dropdown-content">
                <a href="<?php echo base_url() ?>index.php/EmployerMission">Our mission</a>
                <a href="<?php echo base_url() ?>index.php/EmployerMission/index/2">Associated Service</a>
                <a href="<?php echo base_url() ?>index.php/EmployerMission/index/3">Submit Vacancy</a>
            </div>
        </div>
        <a class="nav-link text-dark" href="<?php echo base_url()?>index.php/AboutUS">About Us</a>
        <a class="nav-link text-dark" href="<?php echo base_url()?>index.php/ContactUs">Contact Us</a>
    </nav>