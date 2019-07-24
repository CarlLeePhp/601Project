

<div id="app">    
<div style="height: 50px;"></div>

<h2 class="text-center"><?php echo $title; ?></h2>

<hr />
<h4 class="text-center">{{ messages }}</h4>
<br />

    <form action="" v-on:submit.prevent="onSubmit">
        <input type="text" name="new" value="new" class="d-none"/>
        <div class="form-goup row">
            <label for="Model" class="offset-md-2 col-md-2 col-form-label text-right">Boat Model:</label>
            <div class="col-md-4"> 
                <select name="Model" id="Model" class="form-control" @change="modelHandler" v-model="model">
                    <option value="0">Please Choose a Boat Model</option>
                    <option v-for="model in models" :key="model.id" :value="model.id">{{ model.model }}</option>
                </select>
                
            </div>
        </div>
        <br />
        <div class="form-group row">
            <label for="Item" class="offset-md-2 col-md-2 col-form-label text-right">New Item:</label>
            <div class="col-md-4"> 
                <input type="text" name="Item" id="" class="form-control" v-model="new_item" placeholder="New Item">
            </div>
            
            
        </div>
        <div class="form-goup row">
            <label for="type" class="offset-md-2 col-md-2 col-form-label text-right">Type:</label>
            <div class="col-md-4"> 
                <select name="type" class="form-control" v-model="item_type">
                    <option value="REQ">REQ</option>
                    <option value="OPT">OPT</option>  
                </select>
            </div>
            <button class="btn btn-primary" @click="add_item">Add</button>
        </div>
    </form>
    <!-- form end -->
    <br>
    <!-- Check List Table -->
    <div class="row">
        <table class="table offset-md-2 col-md-8">
            <thead>
                <tr>
                    <th scop="col">ID</th>
                    <th scop="col">Check List Item</th>
                    <th scop="col">Buttons</th>
                </tr> 
            </thead>
            <tbody id="tableBody">
                <tr v-for="item in ritems" >
                    <td>{{ item.id }}</td>
                    <td>{{ item.des }}</td>
                    <td>
                        <a class="btn btn-success" :href="item.edit" role="button">Edit</a>
                        <a class="btn btn-danger" :href="item.remove" role="button">Remove</a>
                    </td>
                </tr>
                <tr v-for="item in oitems" style="background-color: #c9c9c9;">
                    <td>{{ item.id }}</td>
                    <td>{{ item.des }}</td>
                    <td>
                        <a class="btn btn-success" :href="item.edit" role="button">Edit</a>
                        <a class="btn btn-danger" :href="item.remove" role="button">Remove</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Check List Table End -->
</div> <!-- App -->


<!-- Vue -->
<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            messages: "<?php echo $message; ?>",
            model: "", // Boat Model ID
            new_item: "",
            item_type: "",
            base_url : "<?php echo base_Url(); ?>",
            new_item_url : "<?php echo base_Url(); ?>" + 'index.php/checklist/',
            models: [
                <?php foreach ($models as $model): ?>
                    {id: "<?php echo $model['MODEL_ID'] ?>", model: "<?php echo $model['MODEL'] ?>"},
                <?php endforeach; ?>
            ],
            ritems: [{id: 0, des: "None", model: 0, type: "", edit: "", remove: ""}],
            oitems: [{id: 0, des: "", model: 0, type: "", edit: "", remove: ""}]
        },
        methods: {
            modelHandler : function(){
                // get check list items
                var urllink = "<?php echo base_Url(); ?>" + 'index.php/checklist/getItem/' + this.model
                this.$http.get(urllink).then(res => {
                    var result = res.body
                    var results = result.split(",")
                    this.ritems=[]
                    this.oitems=[]
                    for(i=0; i<results.length; i=i+4) {
                        if(results[i+3] == "REQ"){
                            this.ritems.push({
                                id: results[i],
                                des: results[i+1],
                                model: results[i+2],
                                type: results[i+3],
                                edit: "<?php echo base_Url(); ?>" + 'index.php/checklist/edit_item/' + results[i],
                                remove: "<?php echo base_Url(); ?>" + 'index.php/checklist/remove_item/' + results[i]
                            })
                        } else if(results[i+3] == "OPT") {
                            this.oitems.push({
                                id: results[i],
                                des: results[i+1],
                                model: results[i+2],
                                type: results[i+3],
                                edit: "<?php echo base_Url(); ?>" + 'index.php/checklist/edit_item/' + results[i],
                                remove: "<?php echo base_Url(); ?>" + 'index.php/checklist/remove_item/' + results[i]
                            })
                        }
                        
                    }
                }, res => {
                    // error callback
                })              
            },
            add_item : function(){
                // insert a item for current boat model
                var formData = new FormData()
                formData.append('model_id', this.model)
                formData.append('new_item', this.new_item)
                formData.append('type', this.item_type)
                var urllink = "<?php echo base_Url(); ?>" + 'index.php/checklist/add_item/'
                this.$http.post(urllink, formData).then(res => {
                    //refresh the table
                    var result = res.body
                    var results = result.split(",")
                    this.ritems=[]
                    this.oitems=[]
                    for(i=0; i<results.length; i=i+4) {
                        if(results[i+3] == "REQ"){
                            this.ritems.push({
                                id: results[i],
                                des: results[i+1],
                                model: results[i+2],
                                type: results[i+3],
                                edit: "<?php echo base_Url(); ?>" + 'index.php/checklist/edit_item/' + results[i],
                                remove: "<?php echo base_Url(); ?>" + 'index.php/checklist/remove_item/' + results[i]
                            })
                        } else if(results[i+3] == "OPT") {
                            this.oitems.push({
                                id: results[i],
                                des: results[i+1],
                                model: results[i+2],
                                type: results[i+3],
                                edit: "<?php echo base_Url(); ?>" + 'index.php/checklist/edit_item/' + results[i],
                                remove: "<?php echo base_Url(); ?>" + 'index.php/checklist/remove_item/' + results[i]
                            })
                        }
                        
                    }
                }, res => {
                    // error callback
                    this.messages = "POST FAIL"
                })          
            },
            onSubmit: function(){

            }
        }
    })
</script>