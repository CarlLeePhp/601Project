<div id="app">    
<div style="height: 50px;"></div>

<h2 class="text-center"><?php echo $title; ?></h2>
<hr />
<!-- <p>Welcome back, <?php echo $firstName; ?>!</p>
<p>Your cannot see this page without login.</p> -->
<?php if(strlen($message)>1):?>
   
<?php endif;?>
<div class="container mb-5 p-5">
<?php if($userType == 'admin'):?>
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active text-dark font-weight-bold" id="addStaff-tab" data-toggle="tab" href="#addStaff" role="tab" aria-controls="addStaff" aria-selected="true"> Add Staff</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark font-weight-bold" id="changeStaffPassword-tab" data-toggle="tab" href="#changeStaffPassword" role="tab" aria-controls="changeStaffPassword" aria-selected="false">Change staff's password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark font-weight-bold" id="removeStaff-tab" data-toggle="tab" href="#removeStaff" role="tab" aria-controls="removeStaff" aria-selected="false">Remove Staff</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="addStaff" role="tabpanel" aria-labelledby="addStaff-tab">
        <?php 
        $this->load->view('staffManager/addStaff',$message) ;?>
        </div>
        <div class="tab-pane fade" id="changeStaffPassword" role="tabpanel" aria-labelledby="changeStaffPassword-tab">
        <?php
        $this->load->view('staffManager/changeStaffPassword'); ?>
        </div>
        <div class="tab-pane fade" id="removeStaff" role="tabpanel" aria-labelledby="removeStaff-tab">
        <?php 
        $this->load->view('staffManager/removeStaff') ?>
        </div>
        </div>

    </div>
    <div class="container">
    
    </div>
<?php endif; ?>

<?php if($userType == 'staff' || $userType == 'candidate'): {
    redirect('/');
}?>
<?php endif; ?>


</div>


</div>