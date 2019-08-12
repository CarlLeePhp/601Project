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
                    <input type="text" class="form-control" v-model="filterCompany" id="company" placeholder="Company Name">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="city">City:</label>
                    <input type="text" class="form-control" v-model="filterCity" id="city" placeholder="City">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="jobTitle">Job Title:</label>
                    <input type="text" class="form-control" v-model="filterJobTitle" id="jobTitle" placeholder="Job Title">
                </div>
                
            </div>
            <button class="btn btn-outline-info " @click="applyFilters">Apply</button>
            <button class="btn btn-outline-dark mx-2" @click="clearFilters">Clear</button>

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
        </div>
        <!-- Collapse End -->

        
        
    </div>
    <!-- Table -->
    <div class=" mb-5 px-5">
    <div style="overflow:auto" >
        
            <table class="table table-hover mt-5 mr-5">
           
                <thead>
                    <tr>
                        <th scope="col" v-bind:class="{ 'd-none': ! showBookmark }"><a href="#"  @click.stop.prevent="sortBy('bookmark')" class="text-dark "><img src="<?php echo base_url();?>lib/images/Bookmark1.png" style="height: 16px; width:16px;"></a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDetails }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('details')">Details</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showClientTitle }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('clientTitle')">Title</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showClientName }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('clientName')">Name</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCompany }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('company')">Company</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showEmail }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('email')">Email</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showContactNumber }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('contactNumber')">Contact Number</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showJobTitle }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('jobTitle')">Job Title</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showJobType }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('jobType')">Job Type</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showAddress }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('address')">Address</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCity }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('city')">City</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDescription }">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="job in jobs" :key="job.id">
                        <td v-bind:class="{ 'd-none': ! showBookmark }"> <form action="#" name="#" method="post"><input type="checkbox" name="#" value="yes" ><input type="submit" hidden></form></td>
                        <td v-bind:class="{ 'd-none': ! showDetails }"><a :href="job.ref" role="button"><i style="font-size:30px;" class="ml-1 icon ion-md-document mx-3"></i></a></td>
                        <td v-text="job.clientTitle" v-bind:class="{ 'd-none': ! showClientTitle }"></td>
                        <td v-text="job.clientName" v-bind:class="{ 'd-none': ! showClientName }"></td>
                        <td v-text="job.company" v-bind:class="{ 'd-none': ! showCompany }"></td>
                        <td v-text="job.email" v-bind:class="{ 'd-none': ! showEmail }"></td>
                        <td v-text="job.contactNumber" v-bind:class="{ 'd-none': ! showContactNumber }"></td>
                        <td v-text="job.jobTitle" v-bind:class="{ 'd-none': ! showJobTitle }"></td>
                        <td v-text="job.jobType" v-bind:class="{ 'd-none': ! showJobType }"></td>
                        <td v-text="job.address" v-bind:class="{ 'd-none': ! showAddress }"></td>
                        <td v-text="job.city" v-bind:class="{ 'd-none': ! showCity }"></td>
                        <td v-text="job.description" v-bind:class="{ 'd-none': ! showDescription }"></td>
                    </tr>
                </tbody>
                
            </table>
           
        </div>
    </div>
    <!-- Table End -->  
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
        toggle: false,
        jobs: [
            <?php foreach ($jobs as $job): ?> {
                id: "<?php echo $job['JobID']; ?>",
                
                clientTitle: "<?php echo $job['ClientTitle']; ?>",
                clientName: "<?php echo $job['ClientName']; ?>",
                company: "<?php echo $job['Company']; ?>",
                email: "<?php echo $job['Email']; ?>",
                contactNumber: "<?php echo $job['ContactNumber']; ?>",
                jobTitle: "<?php echo $job['JobTitle']; ?>",
                jobType: "<?php echo $job['JobType']; ?>",
                address: "<?php echo $job['Address']; ?>",
                city: "<?php echo $job['City']; ?>",
                description: "<?php echo $job['Description']; ?>",
                ref: "<?php echo base_url()?>index.php/Jobs/jobDetails/<?php echo $job['JobID'];?>",
                // BookmarkStat: "BookmarkID<?php echo $job['JobID']?>",
                // BookmarkRef: "<?php echo base_url()?>index.php/TestControl/<?php echo $job['JobID'];?>",
                // BookmarkName: "formBookmark<?php echo $job['JobID']?>",
                // BookmarkMeth: "sendBookmark(<?php echo 'formBookmark' . $job['JobID']?>)",
            },
            <?php endforeach; ?>
        ],
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
        // filters
        filterCompany: "",
        filterCity: "",
        filterJobTitle: ""
        
    },
    methods: {
        applyFilters: function(){
            this.jobs = [];
            for(var i=0; i<this.jobsCopy.length; i++){
                let company = this.jobsCopy[i].company.toLowerCase();
                let city = this.jobsCopy[i].city.toLowerCase();
                let jobTitle = this.jobsCopy[i].jobTitle.toLowerCase();
                
                if(company.search(this.filterCompany.toLowerCase()) >= 0
                    && city.search(this.filterCity.toLowerCase()) >= 0
                    && jobTitle.search(this.filterJobTitle.toLowerCase()) >= 0){
                    this.jobs.push(this.jobsCopy[i]);
                }
            }
        },
        clearFilters: function(){
            this.filterCompany = "";
            this.filterCity = "";
            this.filterJobTitle = "";
            this.jobs = this.jobsCopy;
        },
        sortBy: function(sortKey) {
            if (sortKey == 'clientTitle') {
                this.toggle = !this.toggle
                if(this.toggle) {
                    this.jobs.sort(function(a, b) {
                        return a.clientTitle.localeCompare(b.clientTitle)
                    })
                } else {
                    this.jobs.sort(function(a, b) {
                        return b.clientTitle.localeCompare(a.clientTitle)
                    })
                }
            } else if (sortKey == 'clientName') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.jobs.sort(function(a, b) {
                        return a.clientName.localeCompare(b.clientName)
                    })
                } else {
                    this.jobs.sort(function(a, b) {
                        return b.clientName.localeCompare(a.clientName)
                    })
                }
            } else if (sortKey == 'company') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.jobs.sort(function(a, b) {
                        return a.company.localeCompare(b.company)
                    })
                } else {
                    this.jobs.sort(function(a, b) {
                        return b.company.localeCompare(a.company)
                    })
                }
            } else if (sortKey == 'email') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.jobs.sort(function(a, b) {
                        return a.email.localeCompare(b.email)
                    })
                } else {
                    this.jobs.sort(function(a, b) {
                        return b.email.localeCompare(a.email)
                    })
                }
            } else if (sortKey == 'contactNumber') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.jobs.sort(function(a, b) {
                        return a.contactNumber.localeCompare(b.contactNumber)
                    })
                } else {
                    this.jobs.sort(function(a, b) {
                        return b.contactNumber.localeCompare(a.contactNumber)
                    })
                }
            } else if (sortKey == 'jobTitle') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.jobs.sort(function(a, b) {
                        return a.jobTitle.localeCompare(b.jobTitle)
                    })
                } else {
                    this.jobs.sort(function(a, b) {
                        return b.jobTitle.localeCompare(a.jobTitle)
                    })
                }
            } else if (sortKey == 'jobType') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.jobs.sort(function(a, b) {
                        return a.jobType.localeCompare(b.jobType)
                    })
                } else {
                    this.jobs.sort(function(a, b) {
                        return b.jobType.localeCompare(a.jobType)
                    })
                }
            } else if (sortKey == 'city') {
                this.toggle = !this.toggle
                if(this.toggle){ 
                    this.jobs.sort(function(a, b) {
                        return a.city.localeCompare(b.city)
                    })
                } else {
                    this.jobs.sort(function(a, b) {
                        return b.city.localeCompare(a.city)
                    })
                }
            } else if (sortKey == 'address') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.jobs.sort(function(a, b) {
                        return a.address.localeCompare(b.address)
                    })
                } else {
                    this.jobs.sort(function(a, b) {
                        return b.address.localeCompare(a.address)
                    })
                }
            }
        },
        // sendBookmark: function(bookmarkNameForm){
        //     document.bookmarkNameForm.submit();
        // },
    },
    mounted: function(){
        this.jobsCopy = this.jobs;
    }

})
</script>