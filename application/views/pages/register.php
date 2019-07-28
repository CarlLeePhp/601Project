<div class="container m-md-5">
            <span class="display-4">Register a new account</span>
            <hr>
            <h3 class="text-warning ml-md-2 ml-0"> Log-in Information</h3>
           
            
            <form action="<?php echo base_url()?>index.php/Register/newUser/" class="m-md-5" method="POST">
            <div class="col-12 mb-5">
            <div class="row">
                <div class="col-md-4 p-0">
                <label for="EmailID" class="font-weight-bold">E-mail</label>
                <input type="email" class="form-control" placeholder="Enter Email" name="Email" id="EmailID"/>
                </div>
                
            </div>
            <div class="row mt-3">
                <div class="col-md-4 px-1 p-0">
                <label for="passwordID" class="font-weight-bold">Password:</label>
                <input type="password" placeholder="Enter Password" class="form-control" name="password" id="passwordID" >
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 px-1 p-0">
                <label for="confirmPasswordID" class="font-weight-bold">Confirm Password:</label>
                <input type="password" placeholder="Re-Enter password" class="form-control" name="confirmPassword" id="confirmpasswordID" >
                </div>
            </div>
            
            </div>
            <hr/>
            
            <div class="col-12">
            <div class="row">
                <div class="col-md-4 pr-md-3 p-0">
                <label for="firstNameID" class="font-weight-bold">First Name:</label>
                <input type="text" class="form-control" placeholder="Enter firstName" name="firstName" id="firstNameID"/>
                </div>
              
                <div class="col-md-4 px-md-3 p-0">
                <label for="lastNameID" class="font-weight-bold">Last Name:</label>
                <input type="text" placeholder="Enter lastName" class="form-control" name="lastName" id="lastNameID" >
                </div>
                <div class="col-md-4 px-md-3 p-0">
                <label for="DOBID" class="font-weight-bold">Date of Birth:</label>
                <input type="date" placeholder="Enter DOB" class="form-control" name="DOB" id="DOBID" >
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 pr-md-3 p-0">
                <label for="AddressID" class="font-weight-bold">Address and street number:</label>
                <input type="text" placeholder="Enter Address" class="form-control" name="Address" id="AddressID" >
                </div>
                <div class="col-md-3 px-md-3 col-9 p-0 pr-2">
                <label for="CityID" class="font-weight-bold">City:</label>
                <select class="form-control" type="text" name="City" id="CityID" >
                    <option selected>-</option>
                    <option value="1">Dunedin</option>
                    <option value="2">Otago</option>
                    <option value="3">Invercargill</option>
                </select> 
                </div>
                <div class="col-md-1 pr-md-3 p-0 col-3">
                <label for="ZipCodeID" class="font-weight-bold">ZipCode</label>
                <input type="text" placeholder="ZIP" class="form-control" name="ZipCode" id="ZipCodeID" >
                </div>
                <div class="col-md-4 px-md-3 p-0">
                <label for="SuburbID" class="font-weight-bold">Suburb:</label>
                <input type="text" placeholder="Enter Suburb" class="form-control" name="Suburb" id="SuburbID" >
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 pr-md-3 p-0">
                <label for="PhoneNumberID" class="font-weight-bold">PhoneNumber:</label>
                <input type="text" placeholder="Enter PhoneNumber" class="form-control" name="PhoneNumber" id="PhoneNumberID" >
                </div>
                <div class="col-md-4 px-md-3 p-0 align-self-end my-3 my-md-2">
                    <input type="radio" name="gender"
                    <?php if (isset($gender) && $gender=="female") echo "checked";?>
                    value="female" checked>Female
                    <input type="radio" name="gender" 
                    <?php if (isset($gender) && $gender=="male") echo "checked";?>
                    value="male">Male
                </div>
            </div>
             <div class="row">
            <input type="submit" value="Register" class="btn btn-primary m-0">
            </div>

            </div>
            
            </form>
        
    </div>