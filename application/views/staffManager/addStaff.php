<div id="app">
<div class="container mt-5">
   
    <form action="<?php echo base_url() ?>index.php/Register/newStaff" method="post">
    <div class="container justify-content-center">
    <div class="row mt-2">
        <label class="font-weight-bold" for="emailID">Email: </label>
    </div>
    <div class="row">
    <input type="text" class="form-control col-md-5" id="emailID" name="email">
    </div>
    <div class="row mt-2">
        <label class="font-weight-bold" for="passwordID">Password: </label>
    </div>
    <div class="row ">
    <input type="password" class="form-control col-md-5"  id="passwordID" name="password">
    </div>
    <div class="row mt-2">
        <label class="font-weight-bold" for="confirmPasswordID">ConfirmPassword: </label>
    </div>
    <div class="row">
    <input type="password" class="form-control col-md-5"  id="confirmPasswordID" name="confirmPassword">
    </div>
    <!-- <div class="row mt-3" v-if="errors.length">
        <p class="text-danger" v-text="errors"></p>
    </div> -->
    <div class="row mt-4">
    <input type="submit" class="btn btn-outline-dark" value="Register Staff"/>
    </div>
    </div>
    </form>
</div>
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            errors: "",
            confirmPassword: "",
            password: ""
        },
        methods: {
            checkForm: function(e){
                if(this.confirmPassword == this.password){
                    return true
                } else {
                    this.errors = "Password did not match"
                    e.preventDefault()
                }
            }
        }
        
    })
</script> -->