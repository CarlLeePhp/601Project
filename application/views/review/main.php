<style>
    tr.OPT{
        background-color: #c9c9c9;
    }
</style>

<div id="app">    
<div style="height: 50px;"></div>

<h2 class="text-center"><?php echo $title; ?></h2>

<hr />
<h4 class="text-center">{{ messages }}</h4>
<br />

    <form action="" v-on:submit.prevent="onSubmit">
        <div class="form-goup row">
            <label for="Dealer" class="offset-md-2 col-md-2 col-form-label text-right">Dealer:</label>
            <div class="col-md-4"> 
                <select name="Dealer" id="Dealer" class="form-control" v-model="dealer">
                    <option value="0">Please choose a Dealer</option>
                    <option v-for="dealer in dealers" :key="dealer.id" :value="dealer.id">{{ dealer.des }}</option>
                </select>
                
            </div>
        </div>

        <br />
        <div class="form-group row">
            <label for="model" class="offset-md-2 col-md-2 col-form-label text-right">Boat Model:</label>
            <div class="col-md-4"> 
                <select name="model" class="form-control" v-model="model">
	                <?php foreach ($models as $model): ?>
			            <option value="<?php echo $model['MODEL_ID']; ?>"><?php echo $model['MODEL']; ?></option>
		            <?php endforeach; ?>
	            </select>
            </div>
            
        </div>

        <br />
        <div class="form-group row">
            <label for="serial" class="offset-md-2 col-md-2 col-form-label text-right">Serial:</label>
            <div class="col-md-4"> 
                <input type="text" name="serial" class="form-control" v-model="boat_serial" placeholder="Boat Serial Number">
            </div>
            <button class="btn btn-primary">Add</button>
        </div>
    </form>
    <!-- form end -->

    <!-- Check List Table -->
    <div class="row">
        <table class="table offset-md-2 col-md-8">
            <thead>
                <tr>
                    <th scop="col">ID</th>
                    <th scop="col">Description</th>
                    <th scop="col">Checked</th>
                </tr> 
            </thead>
            <tbody>
                <tr v-for="item in items" :key="item.CL_ID" :class="item.TYPE">
                    <td>{{ item.CL_ID }}</td>
                    <td>{{ item.CL_DES }}</td>
                    <td><input type="checkbox" v-model="item.CHECKED"></td>
                    
                </tr>
                
            </tbody>
        </table>
    </div>
    <br />
        <!-- Check List Table End -->

        <div class="form-row">
            <div class="form-goup offset-md-2 col-md-8">
                <label for="miss">Missed Parts</label>
                <textarea name="miss" id="miss" class="form-control" row="5"> </textarea>
            </div>
        </div>
        <br />
        <div class="d-flex justify-content-center">
            <button class="btn btn-success" @click="updateChecklist">Save</button>

        </div>

        <!-- A test button
        <button @click="buttonHandler">Click Me</button>
        -->
<br />
<hr />
        <h4 class="text-center">Pictures</h4>
        <div class="d-flex align-content-start flex-wrap">
            <div class="col-md-4 mb-2">
                <img src="<?php echo base_Url(); ?>img/apple.jpeg" class="img-fluid" />
            </div>
            <div class="col-md-4 mb-2">
                <img src="<?php echo base_Url(); ?>img/apple.jpeg" class="img-fluid" />
            </div>
            <div class="col-md-4 mb-2">
                <img src="<?php echo base_Url(); ?>img/apple.jpeg" class="img-fluid" />
            </div>
            <div class="col-md-4 mb-2">
                <img src="<?php echo base_Url(); ?>img/apple.jpeg" class="img-fluid" />
            </div>
            
        </div>

        <div class="d-flex justify-content-center">
            <a role="button"  class="btn btn-primary">Upload Picture</a>
        </div>
	<br />
        <div class="d-flex justify-content-center">
            <a role="button" href="<?php echo base_Url(); ?>index.php/pages/sent_email" class="btn btn-warning">Send Email</a>
        </div>
        <p>{{ messages }}</p>
        <br>
        <button class="btn btn-primary" @click="printPage">Print Page</button>

    <!-- Upload File Test -->
    <form enctype="multipart/form-data" action="<?php echo base_Url(); ?>index.php/pages/get_file" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="3000" />
        <input type="file" name="userfile" id="userfile">
        <input type="submit" value="OK">
    </form>

</div> <!-- App -->



<!-- Vue -->
<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
<script src="<?php echo base_Url(); ?>lib/html2canvas.js"></script>

<script>

    var app = new Vue({
        el: '#app',
        data: {
            base_url: "<?php echo base_Url(); ?>",
            new_boat_url: "<?php echo base_Url(); ?>", // it is for the New Boat button
            dealer: "0",  // dealer_id
            boat: "0", // boat_id
            model: "", // boat_model_id
            boat_serial: "",
            messages: "<?php echo $message; ?>",
            dealers: [
                <?php foreach ($dealers as $dealer): ?>
                    {id: "<?php echo $dealer['DEALER_ID'] ?>", des: "<?php echo $dealer['DEALER_NAME'] ?>"},
                <?php endforeach; ?>
            ],
            
            boats: [
                {id: 0, model: "No model", serial: "No serial number"}
            ],
            items: [{CL_ID: 0, BOAT_ID: 0, CL_DES: "", CHECKED: 0, TYPE: ""}]
        },
        methods: {
            dealerHandler: function (){
                
                // reset the href of New Boat button
                this.new_boat_url = this.base_url + "index.php/pages/new_boat/" + this.dealer

                var urllink = "<?php echo base_Url(); ?>" + 'index.php/pages/getBoat/' + this.dealer
                this.$http.get(urllink).then(res => {
                    var result = res.body
                    
                    var results = result.split(",")
                    this.boats=[]
                    for(i=0; i<results.length; i=i+3) {
                        this.boats.push({id: results[i], model: results[i+1], serial: results[i+2]})
                    }
                }, res => {
                    // error callback
                })                    
            },
            boatHandler: function(){
                // get the serial
                for(i=0; i<this.boats.length; i++) {
                    
                    if(this.boat == this.boats[i].id) {
                        this.boat_serial=this.boats[i].serial
                        
                    }
                }

                

                // get check list
                var formData = new FormData()
                formData.append('boat_id', this.boat)
                var urllink = "<?php echo base_Url(); ?>" + 'index.php/pages/get_list/'
                this.$http.post(urllink, formData).then(res => {
                    //refresh the table
                    var result = res.body
                    this.items = []
                    for(i=0;i<result.length;i++){
                        if(result[i].CHECKED == "0") {
                            result[i].CHECKED = false
                        } else {
                            result[i].CHECKED = true
                        }
                        this.items.push(result[i])  
                    }
                }, res => {
                    // error callback
                    this.messages = "POST FAIL"
                })
                
                
            },
            updateChecklist: function (){
                var formData = new FormData()
                var myList = JSON.stringify(this.items)
                formData.append('checkLists', myList)
                var urllink = "<?php echo base_Url(); ?>" + 'index.php/pages/update_list/'
                this.$http.post(urllink, formData).then(res => {
                    //refresh the table
                    var result = res.body
                    this.messages = myList
                    
                }, res => {
                    // error callback
                    this.messages = "POST FAIL"
                })
            },
            onSubmit: function (){

            },
            printPage: function(){
                html2canvas(document.body).then(function(canvas) {
                    document.body.appendChild(canvas);
                });
            }
        }
    })
</script>

