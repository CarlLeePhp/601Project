<div class="container mb-5">
<div class="row">
<div class="nav flex-column nav-pills mt-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="text-dark nav-link customPane border-top border-dark <?php echo $active1 ?>" style="border-radius:0px;" 
    id="v-pills-cmission-tab" data-toggle="pill" href="#v-pills-cmission" role="tab"
     aria-controls="v-pills-cmission" aria-selected="">Our Mission</a>

  <a class="text-dark nav-link customPane border-top border-bottom border-dark <?php echo $active2 ?>" 
    style="border-radius:0px;" id="v-pills-submitApplication-tab" data-toggle="pill" 
    href="#v-pills-submitApplication" role="tab" aria-controls="v-pills-submitApplication" 
    aria-selected="">Submit Application</a>
  </div>
    <div class="col tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show <?php echo $active1?>" id="v-pills-cmission" role="tabpanel" aria-labelledby="v-pills-cmission-tab">
 
        <div class="container m-md-5">
            <span class="display-4">Job Seekers</span>
            <hr>
            <div class="col-12">
            <div class="row">
            <div class="col-md-8">
            
            <p>
           We will endeavour to find you the job you want, not push you towards the first available vacancy.</p>
            <p>
            We will search for a role to suit your skills, experience, and ambition. 
            
            Maximise your chance of success! We can help with interview tips, CV advise, presentation. We offer general help and suggestions on getting through the employment process. Talk to us about where the opportunities are, and where they are not! 
            </p>
            
              

            <h3 class="text-warning font-weight-bold ">Tradespeople </h3>
            <ul class="mt-2">
                <li> Looking for a change?</li>
                <li> Looking to relocate?</li>
                <li> Looking to change direction? Perhaps use your existing skills to cross over to another industry?</li>
            </ul>
        </div>
        <div class="col-md-4 p-0">
        <a href="https://www.facebook.com/LeeRecruitment" class="text-justify text-dark">
            <img src="<?php echo base_url()?>lib/images/facebook.jpg" alt="ourFacebookPage">
            Follow us on facebook and be reminded
        each time a new job is posted.</a>
        </div>
        </div>
            
        
            </div>
            <div class="mt-2">
            <p>
            At Lee Recruitment we specialise in working with tradespeople. Have a confidential 
            talk to us about who you are and where you want to go. 
            We will discuss with you the various options to suit your goals and ambitions. </p>
            
            <p>
                You are in control of the process and we will only 
                proceed with what you are comfortable doing. 
            </p></div>

            <div class="text-center">
        <a href="<?php base_url()?>CandidateMission/index/active/">
        <input type="button" class="btn btn-warning" value="Submit your application"/>
        </a>
            </div>
    </div> <!--end of container-->
    </div> <!--endOfPane-->
    <!-- startOfPane SubmitApp -->
    <div class="tab-pane fade show <?php echo $active2?>" id="v-pills-submitApplication" role="tabpanel" aria-labelledby="v-pills-submitApplication-tab">
    <div class="container m-md-5">
        <br>
            <span class="display-4 ">Submit Application</span>
            <hr>
            <!-- CheckSession User == "" -->
            <p>You have to Login first before submitting your application form,
            by logging in it will help you tracking your application, and updating your own data.</p>
            <a href="<?php echo base_url() ?>index.php/Register"><p>Register here</p></a>
    </div>
       
    
    </div> <!--endOfPane-->
</div>
</div>
    
</div>
</div>
