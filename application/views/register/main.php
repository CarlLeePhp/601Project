

<div id="app">    
<div style="height: 50px;"></div>

<h2 class="text-center"><?php echo $title; ?></h2>


<br />

    <form action="<?php echo base_Url(); ?>index.php/register/index" method="post">
        <input type="text" name="new" value="new" class="d-none"/>
        <div class="form-group row">
            <label for="name" class="offset-md-2 col-md-2 col-form-label text-right">Name:</label>
            <div class="col-md-4"> 
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="offset-md-2 col-md-2 col-form-label text-right">Email:</label>
            <div class="col-md-4"> 
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="form-group row">
            <label for="type" class="offset-md-2 col-md-2 col-form-label text-right">User Type:</label>
            <div class="col-md-4"> 
                <select name="type" class="form-control">
	                
			        <option value="client">Client</option>
                    <option value="candidate">Candidate</option>
		            
	            </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="passwd" class="offset-md-2 col-md-2 col-form-label text-right">Password:</label>
            <div class="col-md-4"> 
                <input type="text" name="passwd" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            
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