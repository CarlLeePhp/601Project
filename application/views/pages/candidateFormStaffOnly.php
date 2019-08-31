<div class="container my-5" id="app">

    <h3 class="text-secondary ml-0 my-3">Candidate's Personal Information</h3>
    <hr />

    <div class="col-12">

        <div class="row">

            <div class="col-md-4 pr-md-3 p-0">
                <label for="firstNameID" class="font-weight-bold">First Name:</label>
                <input type="text" class="form-control" placeholder="Enter firstName" name="firstName" id="firstNameID"
                    required v-model="firstName" />
            </div>
            <div class="col-md-4 pr-md-3 p-0">
                <label for="lastNameID" class="font-weight-bold">Last Name:</label>
                <input type="text" placeholder="Enter lastName" class="form-control" name="lastName" id="lastNameID"
                    required v-model="lastName" />
            </div>
        </div>
        <div class="row mt-md-3">
            <div class="col-md-4 pr-md-3 p-0 mt-2 mt-md-0">
                <label for="AddressID" class="font-weight-bold">Address and street number:</label>
                <input type="text" placeholder="Enter Address" class="form-control" name="Address" id="AddressID"
                    required v-model="userAddress" />
            </div>
            <div class="col-md-3  col-9 p-0 mt-2 mt-md-0 pr-2">
                <label for="CityID" class="font-weight-bold">City:</label>
                <select class="form-control" type="text" name="City" id="CityID" required v-model="city" >
                    <option selected>Enter City</option>
                    <?php foreach($cities as $city): ?>
                    <option value="<?php echo $city['CityName']; ?>"><?php echo $city['CityName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-1 pr-md-3 p-0 mt-2 mt-md-0 col-3">
                <label for="ZipCodeID" class="font-weight-bold">ZipCode</label>
                <input type="text" placeholder="ZIP" class="form-control" name="ZipCode" id="ZipCodeID" v-model="zipCode"/>
            </div>
            <div class="col-md-4 px-md-3 p-0 mt-2 mt-md-0">
                <label for="SuburbID" class="font-weight-bold">Suburb:</label>
                <input type="text" placeholder="Enter Suburb" class="form-control" name="Suburb" id="SuburbID" v-model="suburb" />
            </div>
        </div>
        <div class="row mt-md-3">
            <div class="col-md-4 pr-md-3 p-0 mt-2 mt-md-0">
                <label for="PhoneNumberID" class="font-weight-bold">PhoneNumber:</label>
                <input type="text" placeholder="Enter PhoneNumber" class="form-control" name="PhoneNumber"
                    id="PhoneNumberID" v-model="phoneNumber"/>
            </div>
            <div class="col-md-4 pr-md-3 p-0">
                <label for="emailID" class="font-weight-bold">Email:</label>
                <input type="email" class="form-control" placeholder="Enter email" name="email" id="emailID" v-model="userEmail"/>
            </div>
            <div class="col-md-3 px-md-3 p-0 mt-2 mt-md-0 ">
                <div class="row mx-1">
                    <label for="SexID" class="font-weight-bold">Sex:</label>
                </div>
                <div class="row">
                    <div class="col-4 col-md-6">
                        <input type="radio" name="gender"
                            <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female"
                            checked v-model="gender">Female</div>
                    <div class="col">
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>
                            value="male" v-model="gender">Male</div>
                </div>
            </div>
        </div>


    </div>
    <h3 class="text-secondary mt-3"> Interest </h3>
    <hr />
    <div class="row">
            
        <div class="col-md-4">
            <label for="jobInterestID" class="font-weight-bold">Job interested in:</label>
            <input type="text" class="form-control" v-model="jobInterest" name="jobInterest" placeholder="interest" id="jobInterestID" />
        </div>
        <div class="col-md-4">
            <label for="jobTypeID" class="font-weight-bold">Job Type:</label>
            <select class="form-control p-2" type="text"  v-model="jobType" name="jobType" id="jobTypeID">
                <option selected></option>
                <option value="FullTime">Full Time</option>
                <option value="PartTime">Part Time</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="font-weight-bold">Drop your CV here:</label>
            <input type="file" id="JobCVID" name="jobCV">
        </div>
    </div>
    <label for="candidateNotesID" class="mt-3 font-weight-bold">Notes for this candidate:</label>
    <textarea v-model="candidateNotes" class="form-control rounded" placeholder="Enter notes" rows="3" id="candidateNotesID"
        name="candidateNotes"></textarea>
    <h3 class="text-warning mt-3"> Transportation </h3>
    <hr />
    <div class="row">
        <div class="col-md-4">
            <label for="transportationID" class="font-weight-bold">Transportation to work:</label>
            <input type="text" class="form-control" v-model="transportation" name="transportation" placeholder="Transportation to work"
                id="transportationID">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="licenseNumberID" class="font-weight-bold mt-2">NZ License Number:</label>
            <input type="text" class="form-control" v-model="licenseNumber" name="LicenseNumber" placeholder="NZ License Number"
                id="licenseNumberID">
        </div>
        <div class="col-md-4">
            <label for="classLicenseID" class="font-weight-bold mt-2">Class of license:</label>
            <select class="form-control" id="classLicenseID" v-model="classLicense" name="classLicense" >
                <option value="" selected></option>
                <option value="Class1 Learner">Class 1 - Car license (Learner or Restricted) </option>
                <option value="Class1 Restricted">Class 1 - Car license (Restricted) </option>
                <option value="Class1 Full">Class 1 - Car license (Full) </option>
                <option value="Class2 MediumRigidVehicleLearner">Class 2 - Medium rigid vehicle (Learner or Restricted) </option>
                <option value="Class2 MediumRigidVehicleFull">Class 2 - Medium rigid vehicle (Full) </option>
                <option value="Class3 MediumCombination">Class 3 - Medium combination (Learner or Full) </option>
                <option value="Class4 HeavyRigid">Class 4 - Heavy rigid (Learner or Full) </option>
                <option value="Class5 HeavyCombination">Class 5 - Heavy combination (Learner or Full) </option>
                <option value="Class6 Motorcycle">Class 6 - Motorcycle license </option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="endorsementID" class="font-weight-bold mt-2">Endorsements:</label>
            <input type="text" class="form-control" v-model="endorsement" placeholder="Endorsement" name="endorsement" id="endorsementID">
        </div>
    </div>
    <h3 class="text-warning mt-3">Citizenship</h3>
    <hr />
    <div class="row">

        <div class="col-md-3">
            <label for="citizenshipID" class="font-weight-bold"> Citizenship:</label>
            <select class="form-control" id="citizenshipID" v-model="citizenship" name="citizenship" required>
                <option value="" selected></option>
                <?php foreach($citizenships as $citizenship): ?>
                <option value="<?php echo $citizenship['Citizenship']; ?>"><?php echo $citizenship['Citizenship']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-3">
            <label for="nationalityID" class="font-weight-bold"> Nationality:</label>
            <input type="text" class="form-control" v-model="nationality" placeholder="Enter Nationality" name="nationality"
                id="nationalityID" />
        </div>
        <div class="col-md-3">
            <label for="passportCountryID" class="font-weight-bold">Passport issuing country:</label>
            <input type="text" class="form-control" v-model="passportCountry" placeholder="Passport Issuing Country" name="passportCountry"
                id="passportCountryID" />

        </div>
        <div class="col-md-3">
            <label for="passportNumberID" class="font-weight-bold">Passport Number:</label>
            <input type="text" class="form-control" v-model="passportNumber" placeholder="Passport Number" name="passportNumber"
                id="passportNumberID" />
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <label for="workPermitNumberID" class="font-weight-bold">Work permit number:</label>
            <input type="text" class="form-control" v-model="workPermitNumber" placeholder="Work Permit Number" name="workPermitNumber"
                id="workPermitNumberID" />
        </div>
        <div class="col-md-4">
            <label for="workPermitExpiryID" class="font-weight-bold">Work permit expiry date:</label>
            <input type="date" class="form-control" v-model="workPermitExpiry" placeholder="Work Permit Expiry Date" name="workPermitExpiry"
                id="workPermitExpiryID" />
        </div>
    </div>
    <h3 class="text-warning mt-3">Health</h3>
    <hr />
    <small>Check the box if you have these conditions<br></small>
    <div class="container p-0 m-0">
        <div class="row">
            <div class="col-md-9">
                <div class="row mt-3">
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="asthma" name="asthma">Asthma
                    </div>
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="blackOut" name="blackOut">BlackOut / Seizures
                    </div>
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="diabetes" name="diabetes">Diabetes
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="bronchitis" name="bronchitis">Bronchitis
                    </div>
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="backInjury" name="backInjury">Back Injury / strain

                    </div>
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="deafness" name="deafness">Deafness
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="dermatitis" name="dermatitis">Dermatitis/Eczema
                    </div>
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="skinInfection" name="skinInfection">Skin infection
                    </div>
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="allergies" name="allergies">Allergies
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="hernia" name="hernia">Hernia
                    </div>
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="highBloodPressure" name="highBloodPressure">High blood
                        pressure
                    </div>
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="heartProblems" name="heartProblems">Heart Problems
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="usingDrugs" name="usingDrugs">taking Drugs / Medicine

                    </div>
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="usingContactLenses" name="usingContactLenses">Wearing contact
                        lenses/ glasses

                    </div>
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-inline" v-model="RSI" name="RSI">Occupational Overuse Syndrome /
                        R.S.I

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <label for="compensationInjuryID" class="font-weight-bold">Compensation of any injury by
                        ACC</label>
                    <select class="form-control p-2" type="text" v-model="compensationInjury" name="compensationInjury"
                        id="compensationInjuryID">
                        <option selected>-</option>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>
                <div class="row mt-2">
                    <label for="compensationDateFromID" class="font-weight-bold">Dates From</label>
                    <input type="date" v-model="compensationDateFrom" name="compensationDateFrom" id="compensationDateFromID" class="form-control">


                    <label for="compensationDateToID" class="font-weight-bold mt-2">Dates To</label>
                    <input type="date" v-model="compensationDateTo" name="compensationDateTo" id="compensationDateToID" class="form-control">

                </div>
            </div>
        </div>
    </div>
    <h3 class="text-secondary mt-3">Other Details</h3>
    <hr />
    <div class="container">
        <input type="checkbox" class="form-check-inline" v-model="dependants" name="dependants"> Having dependants <br>

        <input type="checkbox" class="form-check-inline" v-model="smoke" name="smoke"> Do you smoke?<br>

        <input type="checkbox" class="form-check-inline" v-model="conviction" name="conviction"> Having conviction against the law?<br>
        <label for="convictionDetailsID" class="mt-3">Details if <b>"yes"</b> </label>
        <textarea class="form-control rounded-0" id="convictionDetailsID" rows="5"
        v-model="convictionDetails"  name="convictionDetails"></textarea>

    </div>

    <div class="row justify-content-center mt-3">
        <button @click="newCandidate" class="btn btn-warning font-weight-bold col-md-3 col-9">Register New Candidate</button>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Action</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ message }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal END -->

</div> <!-- app -->


<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
var app = new Vue ({
    el: '#app',
    data: {
        message: "",
        // User
        firstName: "",
        lastName: "",
        userAddress: "",
        city: "",
        zipCode: "",
        suburb: "",
        phoneNumber: "",
        userEmail: "",
        gender: "",

        // condidate
        jobInterest : "",
        jobType : "",
        candidateNotes: "",
        transportation : "",
        licenseNumber : "",
        classLicense : "",
        endorsement : "",
        citizenship : "",
        nationality : "",
        passportCountry : "",
        passportNumber : "",
        workPermitNumber: "",
        workPermitExpiry: "",
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
        
    },
    methods: {
        newCandidate: function(){
            // Add a user
            var formData = new FormData()
            formData.append('firstName', this.firstName);
            formData.append('lastName', this.lastName);
            formData.append('userAddress', this.userAddress);
            formData.append('city', this.city);
            formData.append('zipCode', this.zipCode);
            formData.append('suburb', this.suburb);
            formData.append('phoneNumber', this.phoneNumber);
            formData.append('userEmail', this.userEmail);
            formData.append('gender', this.gender);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/CandidateMission/addUserByStaff/'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body
                
            }, res => {
                // error callback
                this.message="Cannot add a user, please try it later.";
                $('#myModal').modal('show');
            });

            // Add a candidate
            var formData = new FormData()
            // firstName and lastName for getting the user ID
            formData.append('firstName', this.firstName);
            formData.append('lastName', this.lastName);
            // one more thing is candidateNotes
            formData.append('candidateNotes', this.candidateNotes);
            // Below are the same as apply job form
            formData.append('JobInterest', this.jobInterest);
            formData.append('JobType', this.jobType);
            formData.append('Transportation', this.transportation);
            formData.append('LicenseNumber', this.licenseNumber);
            formData.append('ClassLicense', this.classLicense);
            formData.append('Endorsement', this.endorsement);
            formData.append('Citizenship', this.citizenship);
            formData.append('Nationality', this.nationality);
            formData.append('PassportCountry', this.passportCountry);
            formData.append('PassportNumber', this.passportNumber);
            formData.append('WorkPermitExpiry', this.workPermitExpiry);
            formData.append('WorkPermitNumber', this.workPermitNumber);
            formData.append('CompensationInjury', this.compensationInjury);
            formData.append('CompensationDateFrom', this.compensationDateFrom);
            formData.append('CompensationDateTo', this.compensationDateTo);
            formData.append('Asthma', this.asthma);
            formData.append('BlackOut', this.blackOut);
            formData.append('Diabetes', this.diabetes);
            formData.append('Bronchitis', this.bronchitis);
            formData.append('BackInjury', this.backInjury);
            formData.append('Deafness', this.deafness);
            formData.append('Dermatitis', this.dermatitis);
            formData.append('SkinInfection', this.skinInfection);
            formData.append('Allergies', this.allergies);
            formData.append('Hernia', this.hernia);
            formData.append('HighBloodPressure', this.highBloodPressure);
            formData.append('HeartProblems', this.heartProblems);
            formData.append('UsingDrugs', this.usingDrugs);
            formData.append('UsingContactLenses', this.usingContactLenses);
            formData.append('RSI', this.RSI);
            formData.append('Dependants', this.dependants);
            formData.append('Smoke', this.smoke);
            formData.append('Conviction', this.conviction);
            formData.append('ConvictionDetails', this.convictionDetails);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/CandidateMission/applyJob/'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body;
            }, res => {
                // error callback
                this.message=this.message + " Submition was failed, please try it later.";
                $('#myModal').modal('show');
            });
            
            // upload CV
            var candidateCV = document.getElementById("JobCVID");
            if(candidateCV.files.length > 0){
                var candidateCV = document.getElementById("JobCVID");
                
                var formData = new FormData()
                // firstName and lastName for getting the user ID
                formData.append('firstName', this.firstName);
                formData.append('lastName', this.lastName);
                formData.append('JobCV', candidateCV.files[0]);
                var urllink = "<?php echo base_Url(); ?>" + 'index.php/CandidateMission/uploadCV/'
                this.$http.post(urllink, formData).then(res => {
                    var result = res.body
                    this.message=result;
                    $('#myModal').modal('show');
                    
                }, res => {
                    // error callback
                    this.message="CV upload was failed, please try it later.";
                    $('#myModal').modal('show');
                })
            } else {
                this.message="No file";
                $('#myModal').modal('show');
            }
            

        },
        
        
    }
});
</script>