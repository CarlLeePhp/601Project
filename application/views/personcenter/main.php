

<div id="app">    
<div style="height: 50px;"></div>

<h2 class="text-center customPop"><?php echo $title; ?></h2>
<hr />
<!-- <p>Welcome back, <?php echo $firstName; ?>!</p>
<p>Your cannot see this page without login.</p> -->

<div class="container mb-5 p-5">
<?php if($userType == 'admin'): {
    $this->load->view('personcenter/adminPanel');
}?>
    
<?php endif; ?>

<?php if($userType == 'staff'): {
    $this->load->view('personcenter/staffPanel');
}?>
<?php endif; ?>

<?php if($userType == 'candidate'): {
    $this->load->view('personcenter/personalPanel');
}?>
<?php endif; ?> 
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