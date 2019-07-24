<div style="height: 50px;"></div>
<h2 class="text-center">Add New Dealer</h2>
<hr />
<br />

<form action="<?php echo base_Url(); ?>index.php/pages/index" method="post">
    <div class="form-goup row">
        <label for="Dealer" class="offset-md-2 col-md-2 col-form-label text-right">New Dealer:</label>
        <div class="col-md-4"> 
            <input type="text" name="Dealer" id="" class="form-control">
            
        </div>
    </div>
    <br />
    <div class="form-goup row">
        <label for="Sale" class="offset-md-2 col-md-2 col-form-label text-right">Sale:</label>
        <div class="col-md-4"> 
             <select name="Sale" class="form-control">
	         <?php foreach ($sales as $sale): ?>
			<option value="<?php echo $sale['SALE_ID']; ?>"><?php echo $sale['SALE_NAME']; ?></option>
		<?php endforeach; ?>
	     </select>
            
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>
