<!-- 
jobCV--

compensationInjury 
compensationDateFrom compensationDateTo asthma blackOut diabetes
bronchitis backInjury deafness dermatitis skinInfection allergies
hernia highBloodPressure heartProblems usingDrugs usingContactLenses
RSI dependants smoke conviction convictionDetails CandidateNotes -->
<div id="app" class="container mt-5">
    
        <h1 class="text-dark mt-3 text-center"> Candidate Detailed Information </h3>
        <hr />
        <div class="row">
            <div class="col-md-4">
                <label for="firstNameID" class="font-weight-bold mt-2">Candidate First Name:</label>
                <input type="text" class="form-control border-0" id="firstNameID" readonly value="<?php echo $candidate['FirstName'];?>">
            </div>
            <div class="col-md-4">
                <label for="lastNameID" class="font-weight-bold mt-2">Candidate Last Name:</label>
                <input type="text" class="form-control border-0" id="lastNameID" readonly value="<?php echo $candidate['LastName'];?>">
            </div>
            <div class="col-md-4">
                <div class="row ml-1"><label for="candidateCVID" class="font-weight-bold mt-2">Candidate's CV:</label></div>
                <div class="row ml-1"><a href="<?php echo base_url() . 'candidatesCV/' . $candidate['candidateCV'];?>" id="candidateCVID" class="btn btn-primary">CandidateCV</a> </div>   
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <label for="phoneNumberID" class="font-weight-bold mt-2">Phone Number:</label>
                <input type="text" class="form-control border-0" id="phoneNumberID" readonly value="<?php echo $candidate['PhoneNumber'];?>">
            </div>
            <div class="col-md-4">
                <label for="EmailID" class="font-weight-bold mt-2">Email:</label>
                <input type="text" class="form-control border-0" id="EmailID" readonly value="<?php echo $candidate['Email'];?>">
            </div>
            
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <label for="GenderID" class="font-weight-bold mt-2">Gender:</label>
                <input type="text" class="form-control border-0" id="GenderID" readonly value="<?php echo $candidate['Gender'];?>">
            </div>
            <div class="col-md-4">
                <label for="DOBID" class="font-weight-bold mt-2">Date Of Birth:</label>
                <input type="text" class="form-control border-0" id="DOBID" readonly value="<?php echo $candidate['DOB'];?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-3">
                <label for="citizenshipID" class="font-weight-bold mt-2">Citizenship:</label>
                <input type="text" class="form-control border-0" id="citizenshipID" readonly value="<?php echo $candidate['citizenship'];?>">
            </div>
            <div class="col-md-3">
                <label for="nationalityID" class="font-weight-bold mt-2">Nationality:</label>
                <input type="text" class="form-control border-0" id="nationalityID" readonly value="<?php echo $candidate['nationality'];?>">
            </div>
            <div class="col-md-3">
                <label for="passportCountryID" class="font-weight-bold mt-2">Passport Issued Country:</label>
                <input type="text" class="form-control border-0" id="passportCountryID" readonly value="<?php echo $candidate['passportCountry'];?>">
            </div>
            <div class="col-md-3">
                <label for="passportNumberID" class="font-weight-bold mt-2">Passport Number:</label>
                <input type="text" class="form-control border-0" id="passportNumberID" readonly value="<?php echo $candidate['passportNumber'];?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-3">
                <label for="workPermitNumberID" class="font-weight-bold mt-2">Work Permit Number:</label>
                <input type="text" class="form-control border-0" id="workPermitNumberID" readonly value="<?php echo $candidate['workPermitNumber'];?>">
            </div>
            <div class="col-md-3">
                <label for="workPermitExpiryID" class="font-weight-bold mt-2">Work Permit Expiry Date:</label>
                <input type="text" class="form-control border-0" id="workPermitExpiryID" readonly value="<?php echo $candidate['workPermitExpiry'];?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <label for="CityID" class="font-weight-bold mt-2">City:</label>
                <input type="text" class="form-control border-0" id="CityID" readonly value="<?php echo $candidate['City'];?>">
            </div>
            <div class="col-md-4">
                <label for="SuburbID" class="font-weight-bold mt-2">Suburb:</label>
                <input type="text" class="form-control border-0" id="SuburbID" readonly value="<?php echo $candidate['Suburb'];?>">
            </div>
            <div class="col-md-1">
                <label for="ZipCodeID" class="font-weight-bold mt-2">ZipCode:</label>
                <input type="text" class="form-control border-0" id="ZipCodeID" readonly value="<?php echo $candidate['ZipCode'];?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-8">
                <label for="AddressID" class="font-weight-bold mt-2">Address:</label>
                <input type="text" class="form-control border-0" id="AddressID" readonly value="<?php echo $candidate['Address'];?>">
            </div>
        </div>
        
        <h3 class="text-warning mt-3"> Interest </h3>
        <div class="row">
            <div class="col-md-4">
                <label for="jobInterestID" class="font-weight-bold mt-2">Job Interest:</label>
                <input type="text" class="form-control border-0" id="jobInterestID" readonly value="<?php echo $candidate['jobInterest'];?>">
            </div>
            <div class="col-md-4">
                <label for="jobTypeID" class="font-weight-bold mt-2">Job Type:</label>
                <input type="text" class="form-control border-0" id="jobTypeID" readonly value="<?php echo $candidate['jobType'];?>">
            </div>
        </div>
        <h3 class="text-warning mt-3"> Transportation </h3>
        <hr />
        <div class="row">
            <div class="col-md-4">
                <label for="transportationID" class="font-weight-bold mt-2">Transportation:</label>
                <input type="text" class="form-control border-0" id="transportationID" readonly value="<?php echo $candidate['transportation'];?>">
            </div>
        </div>
        <div class="row">
        <div class="col-md-4">
                <label for="LicenseNumberID" class="font-weight-bold mt-2">NZ License Number:</label>
                <input type="text" class="form-control border-0" id="LicenseNumberID" readonly value="<?php echo $candidate['LicenseNumber'];?>">
            </div>
            <div class="col-md-4">
                <label for="classLicenseID" class="font-weight-bold mt-2">Class License:</label>
                <input type="text" class="form-control border-0" id="classLicenseID" readonly value="<?php echo $candidate['classLicense'];?>">
            </div>
            <div class="col-md-4">
                <label for="endorsementID" class="font-weight-bold mt-2">Endorsement:</label>
                <input type="text" class="form-control border-0" id="endorsementID" readonly value="<?php echo $candidate['endorsement'];?>">
            </div>
        </div>
        
        <h3 class="text-warning mt-3">Health</h3>
        <hr />
        <div class="container p-0 m-0">
            <div class="row">
                <div class="col-md-9">
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline"  <?php if($candidate['asthma'] == "true") { echo "checked";} ; ?> disabled>Asthma
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline"  <?php if($candidate['blackOut'] == "true") { echo "checked";} ;?> disabled>BlackOut / Seizures
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline"  <?php if($candidate['diabetes'] == "true") { echo "checked";} ;?> disabled>Diabetes
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline"  <?php if($candidate['bronchitis'] == "true"){ echo "checked";} ;?> disabled>Bronchitis
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline"  <?php if($candidate['backInjury'] == "true"){ echo "checked";} ;?> disabled>Back Injury / strain

                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" <?php if($candidate['deafness'] == "true"){ echo "checked";} ;?> disabled>Deafness
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" <?php if($candidate['dermatitis'] == "true"){ echo "checked";} ;?> disabled>Dermatitis/Eczema
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" <?php if($candidate['skinInfection'] == "true"){ echo "checked";} ;?> disabled>Skin infection
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" <?php if($candidate['allergies'] == "true"){ echo "checked";} ;?> disabled>Allergies
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" <?php if($candidate['hernia'] == "true"){ echo "checked";} ;?> disabled>Hernia
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" <?php if($candidate['highBloodPressure'] == "true"){ echo "checked";} ;?> disabled>High blood
                            pressure
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" <?php if($candidate['heartProblems'] == "true"){ echo "checked";} ;?> disabled>Heart Problems
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline"  <?php if($candidate['usingDrugs'] == "true"){ echo "checked";} ;?> disabled>taking Drugs / Medicine

                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline"  <?php if($candidate['usingContactLenses'] == "true"){ echo "checked";} ;?> disabled>Wearing contact
                            lenses/ glasses

                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline"  <?php if($candidate['RSI'] == "true"){ echo "checked";} ;?> disabled>Occupational Overuse Syndrome /
                            R.S.I

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <label for="compensationInjuryID" class="font-weight-bold">
                            Compensation of any injury by ACC
                        </label>
                        <input type="text" class="form-control border-0" id="compensationInjuryID" readonly value="<?php echo $candidate['compensationInjury'];?>">
                    </div>
                    <div class="row mt-2">
                        <label for="compensationDateFromID" class="font-weight-bold">Dates From</label>
                        <input type="date" name="compensationDateFrom" id="compensationDateFromID" readonly value="<?php echo $candidate['compensationDateFrom'];?>" class="form-control">


                        <label for="compensationDateToID" class="font-weight-bold mt-2">Dates To</label>
                        <input type="date" name="compensationDateTo" readonly value="<?php echo $candidate['compensationDateTo'];?>" id="compensationDateToID" class="form-control">

                    </div>
                </div>
            </div>
        </div>
        <h3 class="text-warning mt-3">Other Details</h3>
        <hr />
        <div class="container mb-5">
            <input type="checkbox" class="form-check-inline" <?php if($candidate['dependants'] == "true"){ echo "checked";} ;?> disabled name="dependants"> Having dependants <br>

            <input type="checkbox" class="form-check-inline" <?php if($candidate['smoke'] == "true"){ echo "checked";} ;?> disabled name="smoke"> Smoking<br>

            <input type="checkbox" class="form-check-inline" <?php if($candidate['conviction'] == "true"){ echo "checked";} ;?> disabled name="conviction"> Having conviction against the law<br>
            <label for="convictionDetailsID" class="mt-3">Details of convictions </label>
            <textarea class="form-control rounded-0" id="convictionDetailsID" rows="5" readonly  name="convictionDetails">
            <?php echo $candidate['convictionDetails'];?>
            </textarea>

        </div>
       
       
</div>

