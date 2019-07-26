

<div id="app">    
<div style="height: 50px;"></div>

<h2 class="text-center"><?php echo $title; ?></h2>

<hr />
<h4 class="text-center"><?php echo $message ?></h4>
<br />
    <!-- Login Form -->
    <form action="<?php echo base_Url(); ?>index.php/login/login" method="post">
        
        <div class="form-group row">
            <label for="name" class="offset-md-2 col-md-2 col-form-label text-right">Name:</label>
            <div class="col-md-4"> 
                <input type="text" name="name" class="form-control" placeholder="Full Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="passwd" class="offset-md-2 col-md-2 col-form-label text-right">Pass Word:</label>
            <div class="col-md-4"> 
                <input type="text" name="passwd" class="form-control" placeholder="Email Address">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            
        </div>
    </form>
    <!-- form end -->
    
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