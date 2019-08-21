<div class="container my-5">

<h3 class="text-secondary ml-0 my-3">Candidate's Personal Information</h3>
<hr/>
<form action="<?php echo base_url()?>index.php/CandidateMission/applyJob" method="post">
        <div class="col-12">
        
            <div class="row">
                
                <div class="col-md-4 pr-md-3 p-0">
                    <label for="firstNameID" class="font-weight-bold">First Name:</label>
                    <input type="text" class="form-control" placeholder="Enter firstName" name="firstName"
                        id="firstNameID" required />
                </div>

                <div class="col-md-4 pr-md-3 p-0">
                    <label for="lastNameID" class="font-weight-bold">Last Name:</label>
                    <input type="text" placeholder="Enter lastName" class="form-control" name="lastName" id="lastNameID"
                        required>
                </div>
                
            </div>
            <div class="row mt-md-3">
                <div class="col-md-4 pr-md-3 p-0 mt-2 mt-md-0">
                    <label for="AddressID" class="font-weight-bold">Address and street number:</label>
                    <input type="text" placeholder="Enter Address" class="form-control" name="Address" id="AddressID"
                        required />
                </div>
                <div class="col-md-3  col-9 p-0 mt-2 mt-md-0 pr-2">
                    <label for="CityID" class="font-weight-bold">City:</label>
                    <select class="form-control" type="text" name="City" id="CityID" required >
                    <option selected>Enter City</option>
                    <?php foreach($cities as $city): ?>
                    <option value="<?php echo $city['CityName']; ?>"><?php echo $city['CityName']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-1 pr-md-3 p-0 mt-2 mt-md-0 col-3">
                    <label for="ZipCodeID" class="font-weight-bold">ZipCode</label>
                    <input type="text" placeholder="ZIP" class="form-control" name="ZipCode" id="ZipCodeID" />
                </div>
                <div class="col-md-4 px-md-3 p-0 mt-2 mt-md-0">
                    <label for="SuburbID" class="font-weight-bold">Suburb:</label>
                    <input type="text" placeholder="Enter Suburb" class="form-control" name="Suburb" id="SuburbID" />
                </div>
            </div>
            <div class="row mt-md-3">
                <div class="col-md-4 pr-md-3 p-0 mt-2 mt-md-0">
                    <label for="PhoneNumberID" class="font-weight-bold">PhoneNumber:</label>
                    <input type="text" placeholder="Enter PhoneNumber" class="form-control" name="PhoneNumber"
                        id="PhoneNumberID"/>
                </div>
                <div class="col-md-4 pr-md-3 p-0">
                    <label for="emailID" class="font-weight-bold">Email:</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email"
                        id="emailID"/>
                </div>
                <div class="col-md-3 px-md-3 p-0 mt-2 mt-md-0 ">
                    <div class="row mx-1">
                        <label for="SexID" class="font-weight-bold">Sex:</label>
                    </div>
                    <div class="row">
                        <div class="col-4 col-md-6">
                            <input type="radio" name="gender"
                                <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female"
                                checked>Female</div>
                        <div class="col">
                            <input type="radio" name="gender"
                                <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male</div>
                    </div>
                </div>
            </div>
            

        </div>
        <h3 class="text-secondary mt-3"> Interest </h3>
        <hr />
        <div class="row">
            
            <div class="col-md-4">
                <label for="jobInterestID" class="font-weight-bold">Job interested in:</label>
                <input type="text" class="form-control" name="jobInterest" placeholder="interest" id="jobInterestID" />
            </div>
            <div class="col-md-4">
                <label for="jobTypeID" class="font-weight-bold">Job Type:</label>
                <select class="form-control p-2" type="text" name="jobType" id="jobTypeID">
                    <option selected></option>
                    <option value="FullTime">Full Time</option>
                    <option value="PartTime">Part Time</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="JobCVID" class="font-weight-bold">Candidate's CV if available:</label>
                <input type="file" id="JobCVID" name="jobCV">
            </div>
        </div>
        <label for="candidateNotesID" class="mt-3 font-weight-bold">Notes for this candidate:</label>
        <textarea class="form-control rounded" placeholder="Enter notes" rows="3" id="candidateNotesID" name="candidateNotes"></textarea>
        <h3 class="text-secondary mt-3"> Transportation </h3>
        <hr />
        <div class="row">
            <div class="col-md-4">
                <label for="transportationID" class="font-weight-bold">Transportation to work:</label>
                <input type="text" class="form-control" name="transportation" placeholder="Transportation to work"
                    id="transportationID">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="licenseNumberID" class="font-weight-bold mt-2">NZ License Number:</label>
                <input type="text" class="form-control" name="LicenseNumber" placeholder="NZ License Number"
                    id="licenseNumberID">
            </div>
            <div class="col-md-4">
                <label for="classLicenseID" class="font-weight-bold mt-2">Class of license:</label>
                <select class="form-control" id="classLicenseID" v-model="classLicense" name="classLicense">
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
                <input type="text" class="form-control" placeholder="Endorsement" name="endorsement" id="endorsementID">
            </div>
        </div>
        <h3 class="text-secondary mt-3">Citizenship</h3>
        <hr />
        <div class="row">

            <div class="col-md-3">
                <label for="citizenshipID" class="font-weight-bold"> Citizenship:</label>
                <select class="form-control" id="citizenshipID" name="citizenship" required>
                    <option value="" selected></option>
                    <?php foreach($citizenships as $citizenship): ?>
                    <option value="<?php echo $citizenship['Citizenship']; ?>"><?php echo $citizenship['Citizenship']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label for="nationalityID" class="font-weight-bold"> Nationality:</label>
                <input type="text" class="form-control" placeholder="Enter Nationality" name="nationality"
                    id="nationalityID" />
            </div>
            <div class="col-md-3">
                <label for="passportCountryID" class="font-weight-bold">Passport issuing country:</label>
                <input type="text" class="form-control" placeholder="Passport Issuing Country" name="passportCountry"
                    id="passportCountryID" />

            </div>
            <div class="col-md-3">
                <label for="passportNumberID" class="font-weight-bold">Passport Number:</label>
                <input type="text" class="form-control" placeholder="Passport Number" name="passportNumber"
                    id="passportNumberID" />
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <label for="workPermitNumberID" class="font-weight-bold">Work permit number:</label>
                <input type="text" class="form-control" placeholder="Work Permit Number" name="workPermitNumber"
                    id="workPermitNumberID" />
            </div>
            <div class="col-md-4">
                <label for="workPermitExpiryID" class="font-weight-bold">Work permit expiry date:</label>
                <input type="date" class="form-control" placeholder="Work Permit Expiry Date" name="workPermitExpiry"
                    id="workPermitExpiryID" />
            </div>
        </div>
        <h3 class="text-secondary mt-3">Health Conditions</h3>
        <hr />
        <div class="container p-0 m-0">
            <div class="row">
                <div class="col-md-9">
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="asthma">Asthma
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="blackOut">BlackOut / Seizures
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline"  name="diabetes">Diabetes
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline"  name="bronchitis">Bronchitis
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="backInjury">Back Injury / strain

                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="deafness">Deafness
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="dermatitis">Dermatitis/Eczema
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="skinInfection">Skin infection
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="allergies">Allergies
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="hernia">Hernia
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="highBloodPressure">High blood
                            pressure
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="heartProblems">Heart Problems
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="usingDrugs">taking Drugs / Medicine

                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="usingContactLenses">Wearing contact
                            lenses/ glasses

                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-inline" name="RSI">Occupational Overuse Syndrome /
                            R.S.I

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <label for="compensationInjuryID" class="font-weight-bold">Compensation of any injury by
                            ACC</label>
                        <select class="form-control p-2" type="text" name="compensationInjury"
                            id="compensationInjuryID">
                            <option selected>-</option>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                    <div class="row mt-2">
                        <label for="compensationDateFromID" class="font-weight-bold">Dates From</label>
                        <input type="date" name="compensationDateFrom" id="compensationDateFromID" class="form-control">


                        <label for="compensationDateToID" class="font-weight-bold mt-2">Dates To</label>
                        <input type="date" name="compensationDateTo" id="compensationDateToID" class="form-control">

                    </div>
                </div>
            </div>
        </div>
        <h3 class="text-secondary mt-3">Other Details</h3>
        <hr />
        <div class="container">
            <input type="checkbox" class="form-check-inline" name="dependants"> Candidate having dependants <br>

            <input type="checkbox" class="form-check-inline" name="smoke"> Candidate is a smoker<br>

            <input type="checkbox" class="form-check-inline" name="conviction"> Candidate having conviction against law<br>
            <label for="convictionDetailsID" class="mt-3">Details if <b>"yes"</b> </label>
            <textarea class="form-control rounded-0" id="convictionDetailsID" rows="5"
            name="convictionDetails"></textarea>

        </div>
        
        <div class="row justify-content-center mt-3">
                <button class="btn btn-warning font-weight-bold col-md-3 col-9">Register New Candidate</button>
        </div>
</form>
</div>