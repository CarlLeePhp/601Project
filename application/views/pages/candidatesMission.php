<div class="container mb-5" id="app">
    <div class="row">
        <div class="nav flex-column nav-pills mt-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="text-dark nav-link customPane border-top border-dark <?php echo $active1 ?>"
                style="border-radius:0px;" id="v-pills-cmission-tab" data-toggle="pill" href="#v-pills-cmission"
                role="tab" aria-controls="v-pills-cmission" aria-selected="">Our Mission</a>

            <a class="text-dark nav-link customPane border-top border-bottom border-dark <?php echo $active2 ?>"
                style="border-radius:0px;" id="v-pills-submitApplication-tab" data-toggle="pill"
                href="#v-pills-submitApplication" role="tab" aria-controls="v-pills-submitApplication"
                aria-selected="">Submit Application</a>
        </div>
        <div class="col tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show <?php echo $active1?>" id="v-pills-cmission" role="tabpanel"
                aria-labelledby="v-pills-cmission-tab">

                <div class="container m-md-5">
                    <span class="display-4">Job Seekers</span>
                    <hr>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-8">

                                <p>
                                    We will endeavour to find you the job you want, not push you towards the first
                                    available vacancy.</p>
                                <p>
                                    We will search for a role to suit your skills, experience, and ambition.

                                    Maximise your chance of success! We can help with interview tips, CV advise,
                                    presentation. We offer general help and suggestions on getting through the
                                    employment process. Talk to us about where the opportunities are, and where they are
                                    not!
                                </p>



                                <h3 class="text-warning font-weight-bold ">Tradespeople </h3>
                                <ul class="mt-2">
                                    <li> Looking for a change?</li>
                                    <li> Looking to relocate?</li>
                                    <li> Looking to change direction? Perhaps use your existing skills to cross over to
                                        another industry?</li>
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
                        </p>
                    </div>

                    <div class="text-center">
                        <a href="<?php base_url()?>CandidateMission/index/active/">
                            <input type="button" class="btn btn-warning" value="Submit your application" />
                        </a>
                    </div>
                </div>
                <!--end of container-->
            </div>
            <!--endOfPane-->
            <!-- startOfPane SubmitApp -->
            <div class="tab-pane fade show <?php echo $active2?>" id="v-pills-submitApplication" role="tabpanel"
                aria-labelledby="v-pills-submitApplication-tab">
                <div class="container m-md-5">
                    <br>
                    <span class="display-4 ">Submit Application</span>
                    <hr>
                    <!-- CheckSession User == "" -->
                    <?php if($userType != 'anyone') { 
                        $this->load->view('pages/candidateApplicationForm');
                    } else { ?>
                    <div>
                        <p>You have to Login first before submitting your application form,
                            by logging in it will help you tracking your application, and updating your own data.</p>
                        <a href="<?php echo base_url() ?>index.php/Register" class="font-weight-bold">Register here</a>
                        Or
                        <a href="<?php echo base_url() ?>index.php/Login" class="font-weight-bold">Login</a>
                        if you already have an account.
                    </div>
                    <?php } ?>

                </div>
            </div>
            <!--endOfPane-->
        </div>
    </div>
    <!-- A Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ messages }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <!-- A Modal End -->
</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
var app = new Vue({
    el: '#app',
    data: {
        messages: "",
        jobInterest : "",
        jobType : "",
        transportation : "",
        licenseNumber : "",
        classLicense : "",
        endorsement : "",
        citizenship : "",
        nationality : "",
        passportCountry : "",
        passportNumber : "",
        compensationInjury : "",
        compensationDateFrom : "",
        compensationDateTo : "",
        asthma : false,
        blackOut : false,
        diabetes : false,
        bronchitis : false,
        backInjury : false,
        deafness : false,
        dermatitis : false,
        skinInfection : false,
        allergies : false,
        hernia : false,
        highBloodPressure : false,
        heartProblems : false,
        usingDrugs : false,
        usingContactLenses : false,
        RSI : false,
        dependants : false,
        smoke : false,
        conviction : false,
        convictionDetails : "",
        confirm: false
    },
    methods: {
        submitJob: function(){
            // insert data to database
            console.log("you clicked me")
            var formData = new FormData()

            formData.append('jobInterest', this.jobInterest);
            formData.append('jobType', this.jobType);
            formData.append('transportation', this.transportation);
            formData.append('licenseNumber', this.licenseNumber);
            formData.append('classLicense', this.classLicense);
            formData.append('endorsement', this.endorsement);
            formData.append('citizenship', this.citizenship);
            formData.append('nationality', this.nationality);
            formData.append('passportCountry', this.passportCountry);
            formData.append('passportNumber', this.passportNumber);
            formData.append('compensationInjury', this.compensationInjury);
            formData.append('compensationDateFrom', this.compensationDateFrom);
            formData.append('compensationDateTo', this.compensationDateTo);
            formData.append('asthma', this.asthma);
            formData.append('blackOut', this.blackOut);
            formData.append('diabetes', this.diabetes);
            formData.append('bronchitis', this.bronchitis);
            formData.append('backInjury', this.backInjury);
            formData.append('deafness', this.deafness);
            formData.append('dermatitis', this.dermatitis);
            formData.append('skinInfection', this.skinInfection);
            formData.append('allergies', this.allergies);
            formData.append('hernia', this.hernia);
            formData.append('highBloodPressure', this.highBloodPressure);
            formData.append('heartProblems', this.heartProblems);
            formData.append('usingDrugs', this.usingDrugs);
            formData.append('usingContactLenses', this.usingContactLenses);
            formData.append('RSI', this.RSI);
            formData.append('dependants', this.dependants);
            formData.append('smoke', this.smoke);
            formData.append('conviction', this.conviction);
            formData.append('convictionDetails', this.convictionDetails);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/CandidateMission/applyJob/'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body
                
                
            }, res => {
                // error callback
                this.messages="Submition was failed, please try it later.";
                $('#myModal').modal('show');
            })

            // upload the cv
            var candidateCV = document.getElementById("JobCVID");

            var formData = new FormData()

            formData.append('jobCV', candidateCV.files[0]);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/CandidateMission/uploadCV/'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body
                this.messages="Job was applied successfully.";
                $('#myModal').modal('show');
                
            }, res => {
                // error callback
                this.messages="CV upload was failed, please try it later.";
                $('#myModal').modal('show');
            })

        },
        testCV: function(){
            console.log("you got me")
            var candidateCV = document.getElementById("JobCVID");

            var formData = new FormData()

            formData.append('jobCV', candidateCV.files[0]);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/CandidateMission/uploadCV/'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body
                console.log(result)
                
            }, res => {
                // error callback
                console.log('past failed')
            })
        }
        
    }
});
        
</script>