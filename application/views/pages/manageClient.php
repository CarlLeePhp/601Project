<div id="app">
    <div style="height: 50px;"></div>

    <h2 class="text-center"><?php echo $title; ?></h2>
    <hr />
    
    
    <div class="container mb-5 p-md-5">

        <!-- Collapse -->
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Filters</a>

        <div class="collapse" id="collapseExample">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="company">Company</label>
                    <input type="text" class="form-control" v-model="filterCompany" id="company" placeholder="Company Name">
                </div>
                <div class="form-group col-md-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" v-model="filterCity" id="city" placeholder="City">
                </div>
                <div class="form-group col-md-3">
                    <label for="jobTitle">Job Title</label>
                    <input type="text" class="form-control" v-model="filterJobTitle" id="jobTitle" placeholder="Job Title">
                </div>
                
            </div>
            <button class="btn btn-success" @click="applyFilters">Apply</button>
            <button class="btn btn-warning" @click="clearFilters">Clear</button>

            <p>Shows:</p>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" v-model="showClientTitle" id="showClientTitle">
                <label class="form-check-label" for="showClientTitle">
                    Title
                </label>
                
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" v-model="showClientName" id="showClientName">
                <label class="form-check-label" for="showClientName">
                    Name
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" v-model="showCompany" id="showCompany">
                <label class="form-check-label" for="showCompany">
                    Company
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" v-model="showEmail" id="showEmail">
                <label class="form-check-label" for="showEmail">
                    Email
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" v-model="showContactNumber" id="showContactNumber">
                <label class="form-check-label" for="showContactNumber">
                    Contact Number
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" v-model="showJobTitle" id="showJobTitle">
                <label class="form-check-label" for="showJobTitle">
                    Job Title
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" v-model="showJobType" id="showJobType">
                <label class="form-check-label" for="showJobType">
                    Job Type
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" v-model="showAddress" id="showAddress">
                <label class="form-check-label" for="showAddress">
                    Address
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" v-model="showCity" id="showCity">
                <label class="form-check-label" for="showCity">
                    City
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" v-model="showDescription" id="showDescription">
                <label class="form-check-label" for="showDescription">
                    Description
                </label>
            </div>
        </div>
        <!-- Collapse End -->

        <!-- Table -->
        <div style="overflow:auto">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col" v-bind:class="{ 'd-none': ! showClientTitle }"><a href="#" @click.stop.prevent="sortBy('clientTitle')">Title</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showClientName }"><a href="#" @click.stop.prevent="sortBy('clientName')">Name</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCompany }"><a href="#" @click.stop.prevent="sortBy('company')">Company</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showEmail }"><a href="#" @click.stop.prevent="sortBy('email')">Email</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showContactNumber }"><a href="#" @click.stop.prevent="sortBy('contactNumber')">Contact Number</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showJobTitle }"><a href="#" @click.stop.prevent="sortBy('jobTitle')">Job Title</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showJobType }"><a href="#" @click.stop.prevent="sortBy('jobType')">Job Type</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showAddress }"><a href="#" @click.stop.prevent="sortBy('address')">Address</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCity }"><a href="#" @click.stop.prevent="sortBy('city')">City</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDescription }">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="job in jobs" :key="job.id">
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
        <!-- Table End -->
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
                
            },
            <?php endforeach; ?>
        ],
        jobsCopy: [],
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
                let company = this.jobsCopy[i].company;
                let city = this.jobsCopy[i].city;
                let jobTitle = this.jobsCopy[i].jobTitle;
                
                if(company.search(this.filterCompany) >= 0
                    && city.search(this.filterCity) >= 0
                    && jobTitle.search(this.filterJobTitle) >= 0){
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
                this.jobs.sort(function(a, b) {
                    return a.clientTitle.localeCompare(b.clientTitle)
                })
            } else if (sortKey == 'clientName') {
                console.log("clientName")
                this.jobs.sort(function(a, b) {
                    return a.clientName.localeCompare(b.clientName)
                })
            } else if (sortKey == 'company') {
                this.jobs.sort(function(a, b) {
                    return a.company.localeCompare(b.company)
                })
            } else if (sortKey == 'email') {
                this.jobs.sort(function(a, b) {
                    return a.email.localeCompare(b.email)
                })
            } else if (sortKey == 'contactNumber') {
                this.jobs.sort(function(a, b) {
                    return a.contactNumber.localeCompare(b.contactNumber)
                })
            } else if (sortKey == 'jobTitle') {
                this.jobs.sort(function(a, b) {
                    return a.jobTitle.localeCompare(b.jobTitle)
                })
            } else if (sortKey == 'jobType') {
                this.jobs.sort(function(a, b) {
                    return a.jobType.localeCompare(b.jobType)
                })
            } else if (sortKey == 'city') {
                this.jobs.sort(function(a, b) {
                    return a.city.localeCompare(b.city)
                })
            } else if (sortKey == 'address') {
                this.jobs.sort(function(a, b) {
                    return a.address.localeCompare(b.address)
                })
            }
        }
    },
    mounted: function(){
        this.jobsCopy = this.jobs;
    }

})
</script>