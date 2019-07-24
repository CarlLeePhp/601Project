<div style="height: 50px;"></div>
<h2 class="text-center">Add New Boat</h2>
<hr />
<br />

<form action="<?php echo base_Url(); ?>index.php/pages/index" method="post">
    <div class="form-goup row d-none">
        <label for="Dealer" class="offset-md-2 col-md-2 col-form-label text-right">Dealer:</label>
        <div class="col-md-4"> 
            <input type="text" name="Dealer" id="" class="form-control" value="<?php echo $dealer_id; ?>">
        </div>
    </div>

    <br />
    <div class="form-goup row">
        <label for="Boat" class="offset-md-2 col-md-2 col-form-label text-right">Boat Model:</label>
        <div class="col-md-4"> 
            <select name="Boat" class="form-control">
                <?php foreach ($models as $model): ?>
                    <option value="<?php echo $model['MODEL_ID']; ?>"><?php echo $model['MODEL']; ?></option>
                <?php endforeach; ?>
	        </select>
            
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </div>

</form>
<br />
<div class="row">
    <a role="button" href="<?php echo base_Url(); ?>index.php/pages/new_model" class="btn btn-warning offset-md-4">New Model</a>
</div>
