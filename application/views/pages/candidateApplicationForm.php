<div class="container mt-5">
    <!-- CandidateMission/applyJob/ -->
    <b style="font-size:18px;">All applications are treated in the strictest confidence.</b><br>

        <h3 class="text-warning mt-3"> Interest </h3>
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
                <label for="JobCVID" class="font-weight-bold">Drop your CV here:</label>
                <input type="file" id="JobCVID" name="jobCV">
            </div>
        </div>
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
                <select class="form-control" id="classLicenseID" v-model="classLicense" name="classLicense" required>
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
        <h3 class="text-warning mt-3">Other Details</h3>
        <hr />
        <div class="container">
            <input type="checkbox" class="form-check-inline" v-model="dependants" name="dependants"> Having dependants <br>

            <input type="checkbox" class="form-check-inline" v-model="smoke" name="smoke"> Do you smoke?<br>

            <input type="checkbox" class="form-check-inline" v-model="conviction" name="conviction"> Having conviction against the law?<br>
            <label for="convictionDetailsID" class="mt-3">Details if <b>"yes"</b> </label>
            <textarea class="form-control rounded-0" id="convictionDetailsID" rows="5"
            v-model="convictionDetails"  name="convictionDetails"></textarea>

        </div>
        <h3 class="text-warning mt-3">Declaration and Authorisation To Lee Recruitment</h3>
        <hr />
        <div class="container font-weight-bold" style="overflow-y:scroll; height:400px;">
            <p>I CERTIFY that all information that I have provided to you is true, accurate and complete. </p>
            <p>
                I UNDERSTAND that all information provided about me to you will be held by you and used for the purpose
                of evaluating my qualifications, experience and suitability for permanent and /or temporary employment
                with you or with any other employer.
            </p>
            <p>I AUTHORISE you to contact any person and seek further information from them which may be relevant to my
                application for employment. Without limiting the generality of this authorisation, I authorise you to
                obtain any information about me held by credit reference agencies.
            </p>
            <p>I UNDERSTAND that if I, or if any other person, withholds relevant information about me, my application
                may not be further considered. I also understand that my employment may be terminated if, after
                investigation, an employer discovers that any information which I have provided, or which has been
                provided about me is false or misleading.</p>
            <p>I AUTHORISE you to retain any information about me until I advise you that I no longer wish to seek
                employment opportunities through you. I understand that you might retain non-active information about me
                on your system. </p>

        </div>
        <input type="checkbox" v-model="confirm" class="form-check-inline ml-md-1 mt-3" required> Please tick this box to confirm the
        above statements.<br>
        <div class="mt-3">
            <button class="btn btn-warning" :disabled="! confirm" @click="submitJob">Register</button>
        </div>
</div>