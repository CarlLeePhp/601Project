<div style="height: 50px;"></div>
<h2 class="text-center">Add New Boat Model</h2>
<hr />
<br />

<form action="<?php echo base_Url(); ?>index.php/pages/index" method="post">
    <div class="form-goup row">
        <label for="Model" class="offset-md-2 col-md-2 col-form-label text-right">Model:</label>
        <div class="col-md-4"> 
            <input type="text" name="Model" id="" class="form-control">
            
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>
