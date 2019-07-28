

<div id="app">    
<div style="height: 50px;"></div>

<h2 class="text-center"><?php echo $title; ?></h2>
<hr />
<p>Welcome back, <?php echo $firstName; ?>!</p>
<p>Your cannot see this page without login.</p>

<?php if($userType == 'admin'): ?>
    <p>Admin can see this part.</p>
<?php endif; ?>

<?php if($userType == 'staff'): ?>
    <p>Staff can see this part.</p>
<?php endif; ?>

<?php if($userType == 'candidate'): ?>
    <p>Candidate can see this part.</p>
<?php endif; ?>

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