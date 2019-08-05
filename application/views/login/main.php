
<div id="app" class="container m-md-5">    
   

<div class="row justify-content-center">    
<div class="col-md-5 mt-5">
<h3 class="mt-5">Log In</h3 ><br>
    <form action="<?php echo base_Url(); ?>index.php/login/login" method="post" class="border bg-outline-secondary rounded p-md-5 p-4 mb-5">

        <label for="EmailID" class="font-weight-bold">Email:</label>
        <input type="email" class="shadow-none rounded-0 form-control border-dark border-top-0 border-left-0 border-right-0" placeholder="Enter email" id="EmailID" name="Email"/>
        
        <label for="PasswordID" class="font-weight-bold mt-4">Password:</label>
        <input type="password" class="shadow-none rounded-0 form-control border-dark border-top-0 
        border-left-0 border-right-0 " placeholder="Enter Password" id="PasswordID" name="Password"/>
        <!-- a message if the user entered a wrong info -->
        <?php if($wrongInfo!='undefined') { echo '<small class="text-danger"> You entered either incorrect email or password, please try again. </small>';} ?>
        <input type="submit" class="border-secondary btn btn-warning form-control mt-4" value="Log In">
        
        <a href="<?php echo base_url() ?>index.php/Register" class="btn btn-outline-dark form-control mt-3"> Register</a>
        
        <div class="mt-2 align-self-center">
        <a href="<?php echo base_url() ?>index.php/Login/forgotPassword" class="text-dark" ><img src="<?php echo base_url() ?>lib/images/lock.png" style="width:8px; height:12px"> Forgot password</a>
        </div>
    </form>
</div> 
</div> 

</div> <!-- App -->


<!-- Vue -->
<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            
        },
        methods: {

        }
        
    })
</script>
