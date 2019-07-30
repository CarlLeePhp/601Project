<div class="container m-md-5" id="app">
    <span class="display-4">Register a new account</span>
    <hr>



    <form action="<?php echo base_url()?>index.php/Register/newUser/" class="m-md-5" method="POST" @submit.stop="formCheck">
        <h3 class="text-warning ml-0 my-3"> Log-in Information</h3>
        <div class="col-12 mb-5">
            <div class="row">
                <div class="col-md-4 p-0">
                    <label for="EmailID" class="font-weight-bold">E-mail</label>
                    <input type="email" class="form-control" placeholder="Enter Email" name="Email" id="EmailID" />
                </div>

            </div>
            <div class="row mt-3">
                <div class="col-md-4 px-1 p-0">
                    <label for="passwordID" class="font-weight-bold">Password:</label>
                    <input type="password" placeholder="Enter Password" class="form-control" name="password"
                        id="passwordID" v-model="password">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 px-1 p-0">
                    <label for="confirmPasswordID" class="font-weight-bold">Confirm Password:</label>
                    <input type="password" placeholder="Re-Enter password" class="form-control" name="confirmPassword"
                        id="confirmpasswordID" v-model="confirmPasswd">
                </div>
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
                    <select class="form-control" type="text" name="City" id="CityID" required />
                    <option selected></option>
                    <option value="Auckland">Auckland</option>
                    <option value="Wellington">Wellington</option>
                    <option value="Christchurch">Christchurch</option>
                    <option value="Dunedin">Dunedin</option>
                    <option value="Hamilton">Hamilton</option>
                    <option value="Queenstown">Queenstown</option>
                    <option value="Tauranga">Tauranga</option>
                    <option value="Rotorua">Rotorua</option>
                    <option value="Napier">Napier</option>
                    <option value="Invercargill">Invercargill</option>
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
                <input type="submit" value="Register" class="btn btn-primary m-0 ">
            </div>

        </div>

    </form>
    <p v-if="errors.length">
        <ul>
            <li v-for="error in errors">{{ error }}</li>
        </ul>
    </p>
</div>


<!-- Vue -->
<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            errors: [],
            confirmPasswd: "",
            password: ""
        },
        methods: {
            checkForm: function(e){
                if(this.confirmPasswd == this.password){
                    this.errors.push("You get the same password.")
                } else {
                    this.errors.push("Please confirm your password.")
                }

                e.preventDefault()
            }
        }
        
    })
</script>