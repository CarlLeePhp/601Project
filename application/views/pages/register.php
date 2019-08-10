<div class="container m-md-5" id="app">
    <span class="display-4">Register a new account</span>
    <hr>



    <form action="<?php echo base_url()?>index.php/Register/newUser/" class="m-md-5" method="POST" @submit="checkForm">
        <h3 class="text-warning ml-0 my-3"> Log-in Information</h3>
        <div class="col-12 mb-5">
            <div class="row">
                <div class="col-md-4 p-0">
                    <label for="EmailID" class="font-weight-bold">E-mail</label>
                    <input type="email" class="form-control" placeholder="Enter Email" name="Email" id="EmailID" @change="checkEmail" v-model="email"/>
                </div>
            </div>
            <div class="row mt-3" v-if="emailError.length">
                <p class="text-danger" v-text="emailError"></p>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 px-1 p-0">
                    <label for="passwordID" class="font-weight-bold">Password:</label>
                    <input type="password" placeholder="Enter Password" class="form-control" name="password"
                        id="passwordID" v-model="password">
                        <div class="">
                    <small class="text-muted">The length of the password should atleast be 6 characters</small>
                </div>
                </div>
                
            </div>
            <div class="row mt-3">
                <div class="col-md-4 px-1 p-0">
                    <label for="confirmPasswordID" class="font-weight-bold">Confirm Password:</label>
                    <input type="password" placeholder="Re-Enter password" class="form-control" name="confirmPassword"
                        id="confirmpasswordID" v-model="confirmPasswd">
                </div>
            </div>
            <div class="row mt-3" v-if="passwdError.length">
                <p class="text-danger" v-text="passwdError"></p>
            </div>
            
        </div>
        <hr />
        <h3 class="text-warning ml-0 my-3"> Personal Information</h3>
        <div class="col-12">
            <div class="row">
                <div class="col-md-4 pr-md-3 p-0">
                    <label for="firstNameID" class="font-weight-bold">First Name:</label>
                    <input type="text" class="form-control" placeholder="Enter firstName" name="firstName"
                        id="firstNameID" required />
                </div>

                <div class="col-md-4 px-md-3 p-0">
                    <label for="lastNameID" class="font-weight-bold">Last Name:</label>
                    <input type="text" placeholder="Enter lastName" class="form-control" name="lastName" id="lastNameID"
                        required>
                </div>
                <div class="col-md-4 px-md-3 p-0">
                    <label for="DOBID" class="font-weight-bold">Date of Birth:</label>
                    <input type="date" placeholder="Enter DOB" class="form-control" name="DOB" id="DOBID" required>
                </div>
            </div>
            <div class="row mt-md-3">
                <div class="col-md-4 pr-md-3 p-0 mt-2 mt-md-0">
                    <label for="AddressID" class="font-weight-bold">Address and street number:</label>
                    <input type="text" placeholder="Enter Address" class="form-control" name="Address" id="AddressID"
                        required />
                </div>
                <div class="col-md-3 px-md-3 col-9 p-0 mt-2 mt-md-0 pr-2">
                    <label for="CityID" class="font-weight-bold">City:</label>
                    <select class="form-control" type="text" name="City" id="CityID" required >
                    <option selected></option>
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
                        id="PhoneNumberID" required />
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
            <div class="row my-4 justify-content-md-start justify-content-center">
                <input type="submit" value="Register" class="btn btn-primary m-0 " :disabled="isButton">
            </div>

        </div>

    </form>
    
</div>


<!-- Vue -->
<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            emailError: "",
            passwdError: "",
            confirmPasswd: "",
            password: "",
            email: "",
            emails: [
                <?php foreach($users as $user): ?>
                    "<?php echo $user['Email']; ?>",
                <?php endforeach; ?>
            ],
            isButton: true
        },
        methods: {
            checkForm: function(e){
                if(this.confirmPasswd == this.password){
                    if(this.password.length<6){
                        this.passwdError = "Password is too short"
                        e.preventDefault()
                    } else {
                        return true
                    }
                } else {
                    this.passwdError = "Password did not match"
                    e.preventDefault()
                }
            },
            checkEmail: function(){
                if(this.emails.includes(this.email)){
                    this.emailError = "this email already exists"
                    this.isButton = true
                } else {
                    if(!this.validEmail(this.email)){
                        this.emailError = "Invalid Email Address"
                        this.isButton = true
                    } else {
                    this.emailError = ""
                    this.isButton = false
                    }
                }
            },
            validEmail: function(email){
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email)
            }
        }
        
    })
</script>