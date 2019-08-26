<div id="app">
    <div style="height: 50px;"></div>

    <h2 class="text-center"><?php echo $title; ?></h2>
    <hr />
    
    
    <div class="container ">

        <!-- Collapse -->
        <a class="btn btn-outline-dark border border-dark form-control" style="border-radius: 15px 15px 0px 0px;" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <span class="font-weight-bold">Filters</span><i class="ml-1 icon ion-md-barcode mx-3"></i></a>
       
        <div class="collapse border border-dark p-5 bg-white" style="border-radius: 0px 0px 15px 15px;" id="collapseExample">
            <div class="form-row mt-1">
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="company">Company:</label>
                    <input type="text" class="form-control" name="companyName" v-model="filterCompany" id="company" placeholder="Company Name">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="city">City:</label>
                    <input type="text" class="form-control" name="cityName" v-model="filterCity" id="city" placeholder="City">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="jobTitle">Job Title:</label>
                    <input type="text" class="form-control" name="jobTitleName" v-model="filterJobTitle" id="jobTitle" placeholder="Job Title">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="ContactNumber">Contact Number:</label>
                    <input type="text" class="form-control" name="contactNumberName" v-model="filterContactNumber" id="ContactNumber" placeholder="Contact Number">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="ContactPerson">Contact person name:</label>
                    <input type="text" class="form-control" name="contactPersonName" v-model="filterContactPerson" id="ContactPerson" placeholder="Contact person name">
                </div>
            </div>
            <button class="btn btn-outline-info " @click="applyFilters">Apply</button>
            <a href="<?php echo base_url()?>index.php/Archive" class="btn btn-outline-dark mx-2">Clear</a>
      
            <p class="mt-md-5 mt-3 text-dark font-weight-bold">Shows column:</p>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showBookmark" id="showBookmark">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showBookmark">
                    Bookmark
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showDetails" id="showDetails">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showDetails">
                    Details
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showClientTitle" id="showClientTitle">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showClientTitle">
                    Title
                </label>
                
            </div>
            
            <div class="form-check form-check-inline col-md-2">
            <input class="form-check-input" type="checkbox" v-model="showClientName" id="showClientName">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showClientName">
                    Name
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showCompany" id="showCompany">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showCompany">
                    Company
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showEmail" id="showEmail">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showEmail">
                    Email
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showContactNumber" id="showContactNumber">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showContactNumber">
                    Contact Number
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showJobTitle" id="showJobTitle">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showJobTitle">
                    Job Title
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showJobType" id="showJobType">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showJobType">
                    Job Type
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showAddress" id="showAddress">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showAddress">
                    Address
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showCity" id="showCity">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showCity">
                    City
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showDescription" id="showDescription">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showDescription">
                    Description
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showDateSubmitted" id="showDateSubmitted">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showDateSubmitted">
                    DateSubmitted
                </label>
            </div>
        </div>
        <!-- Collapse End -->

        
        
    </div>
    <!-- Table -->
    <div class=" mb-5 px-5">
    <div class="dragscroll" style=" overflow: scroll; cursor: grab; cursor : -o-grab; cursor : -moz-grab; cursor : -webkit-grab;" >
        
            <table class="table table-hover mt-5 mr-5">
           
                <thead>
                    <tr>
                        <th scope="col" v-bind:class="{ 'd-none': ! showBookmark }"><a href="#"  @click.stop.prevent="sortBy('Bookmark')" class="text-dark "><img src="<?php echo base_url();?>lib/images/Bookmark1.png" style="height: 16px; width:16px;"></a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDetails }"><a href="#" class="text-dark" @click.stop.prevent="">Details</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showClientTitle }"><a href="#" class="text-dark p-2 pr-3" @click.stop.prevent="sortBy('ClientTitle')">Title</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showClientName }"><a href="#" class="text-dark p-2 pr-3" @click.stop.prevent="sortBy('ClientName')">Name</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCompany }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('Company')">Company</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showEmail }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('Email')">Email</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showContactNumber }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('ContactNumber')">Contact Number</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showJobTitle }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('JobTitle')">Job Title</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showJobType }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('JobType')">Job Type</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showAddress }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('Address')">Address</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCity }"><a href="#" class="text-dark  p-2 pr-3" @click.stop.prevent="sortBy('City')">City</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDescription }">Description</th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDateSubmitted }"><a href="#" class="text-dark py-2" @click.stop.prevent="sortBy('JobSubmittedDate')">DateSubmitted</a></th>
                       
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="job in jobs" :key="job.JobID">
                        
                        <td v-bind:class="{ 'd-none': ! showBookmark }"><input type="checkbox" :id="job.bookmarkUrl" v-on:click="updateBookmark(job.JobID)" :checked="job.bookmarkStat"></td>
                        <td class="textInfoPos" v-bind:class="{ 'd-none': ! showDetails }"><span class="textInfo text-center" style="left: -35px;width:190px;">See Job's Details</span><a :href="job.ref" role="button"><i style="font-size:30px;" class="ml-1 icon ion-md-document mx-3"></i></a></td>
                        <td v-text="job.ClientTitle" v-bind:class="{ 'd-none': ! showClientTitle }"></td>
                        <td v-text="job.ClientName" v-bind:class="{ 'd-none': ! showClientName }"></td>
                        <td v-text="job.Company" v-bind:class="{ 'd-none': ! showCompany }"></td>
                        <td v-text="job.Email" v-bind:class="{ 'd-none': ! showEmail }"></td>
                        <td v-text="job.ContactNumber" v-bind:class="{ 'd-none': ! showContactNumber }"></td>
                        <td v-text="job.JobTitle" v-bind:class="{ 'd-none': ! showJobTitle }"></td>
                        <td v-text="job.JobType" v-bind:class="{ 'd-none': ! showJobType }"></td>
                        <td v-text="job.Address" v-bind:class="{ 'd-none': ! showAddress }"></td>
                        <td v-text="job.City" v-bind:class="{ 'd-none': ! showCity }"></td>
                        <td v-text="job.Description" v-bind:class="{ 'd-none': ! showDescription }"></td>
                        <td v-text="job.JobSubmittedDate" v-bind:class="{ 'd-none': ! showDateSubmitted }"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Table End --> 
    <div class="row  justify-content-center mb-4">
        <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item" v-for="pageNum in pageNums" :key="pageNum.id" :class="{ active: pageNum.isActive }">
                <a class="page-link"  href="#" @click.stop.prevent="getJobs(pageNum.id)">{{ pageNum.id / 10 + 1 }}</a>
            </li>
        </ul>
        </nav>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Action {{ errMessage }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ errors }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal END -->
</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
var app = new Vue({
    el: '#app',
    data: {
        errMessage: "",
        errors: "",
        bookmarkID: "",
        toggle: false,
        
        jobs: <?php echo json_encode($jobs); ?>,
        jobsCopy: [],
        showBookmark: true,
        showDetails: true,
        showClientTitle: true,
        showClientName: true,
        showCompany: true,
        showEmail: true,
        showContactNumber: true,
        showJobTitle : true,
        showJobType: true,
        showAddress: true,
        showCity: true,
        showDescription: true,
        showDateSubmitted: true,
        archiveJobNum: <?php echo $archiveJobNum;?>,
        // filters
        filterCompany: "",
        filterCity: "",
        filterJobTitle: "",
        filterContactNumber: "",
        filterContactPerson: "",
        pageNums:[
            {id: 1, isActive: true}
        ]
        
    },
    methods: {
        sortBy: function(sortKey) {
            this.toggle = !this.toggle;
            if(this.toggle){
                this.jobs.sort(function(a, b){
                    return a[sortKey].localeCompare(b[sortKey]);
                })
            } else {
                this.jobs.sort(function(a, b){
                    return b[sortKey].localeCompare(a[sortKey]);
                })
            }
        },
        getJobs: function(offset){
            for(var i=0; i<this.pageNums.length; i++){
                if(this.pageNums[i].id == offset){
                    this.pageNums[i].isActive = true;
                } else {
                    this.pageNums[i].isActive = false;
                }
            }
            var formData = new FormData()
            formData.append('offset', offset);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/Archive/getJobsArchive'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body
                this.jobs = result
            }, res => {
                // error callback
                
            })
        },
        applyFilters: function(){
            
            var formData = new FormData()
            formData.append('companyName',this.filterCompany);
            formData.append('cityName', this.filterCity);
            formData.append('jobTitleName',this.filterJobTitle);
            formData.append('contactNumberName',this.filterContactNumber);
            formData.append('contactPersonName',this.filterContactPerson);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/Archive/applyFilterArchive'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body
                this.jobs = result
                this.pageNums = [];
                for(var i=0; i<this.jobs.length; i=i+10){
                    this.pageNums.push({id: i, isActive: false});
                }
                this.pageNums[0].isActive = true;
                
            }, res => {
                // error callback
                
            })
        },
        updateBookmark: function(jobID){
            var xRequest = new XMLHttpRequest;
            var bookmarkVal = "";
            if(document.getElementById("Bookmark"+jobID).checked){
                bookmarkVal = "true";
               
            } else {
                bookmarkVal = "false";
            }
           var the_data = 'bookmarkValue='+bookmarkVal

        xRequest.open("POST",'<?php echo base_url()?>index.php/Jobs/updateBookmark/'+jobID,true)
        xRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
        xRequest.send(the_data);
           
        }
    },
    
    mounted: function(){
        this.pageNums = [];
        for(var i=0; i<this.archiveJobNum; i=i+10){
            this.pageNums.push({id: i, isActive: false});
        }
        this.pageNums[0].isActive = true;
    }

})
</script>
