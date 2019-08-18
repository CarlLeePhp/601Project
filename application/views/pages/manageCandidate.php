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
                    <label class="text-dark font-weight-bold" for="JobInterest">Job Interest:</label>
                    <input type="text" class="form-control" v-model="filterJobInterest" id="JobInterest" placeholder="Job Interest">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="JobType">Job Type:</label>
                    <input type="text" class="form-control" v-model="filterJobType" id="JobType" placeholder="Job Type">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="Transportation">Transportation:</label>
                    <input type="text" class="form-control" v-model="filterTransportation" id="Transportation" placeholder="Transportation">
                </div>
                
            </div>
            <button class="btn btn-outline-info " @click="applyFilters">Apply</button>
            <button class="btn btn-outline-dark mx-2" @click="clearFilters">Clear</button>

            <p class="mt-md-5 mt-3 text-dark font-weight-bold">Shows column:</p>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showJobInterest" id="showJobInterest">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showJobInterest">
                    Job Interest
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showJobType" id="showJobType">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showJobType">
                    Job Type
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showTransportation" id="showTransportation">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showTransportation">
                    Transportation
                </label>
                
            </div>
            
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showCitizenship" id="showCitizenship">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showCitizenship">
                    Citizenship
                </label>
            </div>
            
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showCompensationInjury" id="showCompensationInjury">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showCompensationInjury">
                    Compensation Injury
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showCompensationDateFrom" id="showCompensationDateFrom">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showCompensationDateFrom">
                    Compensation Date From
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showCompensationDateTo" id="showCompensationDateTo">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showCompensationDateTo">
                Compensation Date To
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showHealthConditions" id="showHealthConditions">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showHealthConditions">
                    Health Conditions
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showDependants" id="showDependants">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showDependants">
                    Dependants
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showSmoke" id="showSmoke">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showSmoke">
                    Smoke
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showConviction" id="showConviction">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showConviction">
                    Conviction
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showConvictionDetails" id="showConvictionDetails">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showConvictionDetails">
                    Conviction Detail
                </label>
            </div>
        </div>
        <!-- Collapse End -->

        
        
    </div>
    <!-- Table -->
    <div class=" mb-5 px-5">
    <div style="overflow:auto" v-if="candidates.length > 0">
        
            <table class="table table-hover mt-5 mr-5">
           
                <thead>
                    <tr>
                        <th scope="col" v-bind:class="{ 'd-none': ! showFirstName }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('FirstName')">First Name</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showLastName }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('LastName')">Last Name</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showLastName }">CV</th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showJobInterest }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('jobInterest')">Job Interest</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showJobType }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('jobType')">Job Type</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showTransportation }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('transportation')">Transportation</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCitizenship }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('citizenship')">Citizenship</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCompensationInjury }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('compensationInjury')">Compensation Injury</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCompensationDateFrom }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('compensationDateFrom')">Date From</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCompensationDateTo }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('compensationDateTo')">Date To</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showHealthConditions }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('healthProblem')">Health Problem</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDependants }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('dependants')">Dependants</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showSmoke }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('smoke')">Smoke</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showConviction }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('conviction')">Conviction</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showConvictionDetails }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('convictionDetails')">Conviction Detail</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="candidate in candidatesCopy" :key="candidate.CandidateID">
                        <th v-text="candidate.FirstName" v-bind:class="{ 'd-none': ! showFirstName }"></th>
                        <th v-text="candidate.LastName" v-bind:class="{ 'd-none': ! showLastName }"></th>
                        <th><a class="text-dark" :href="'<?php echo base_Url(); ?>index.php/candidateMission/downloadCV/' + candidate.jobCV" target="_blank">CV</a></th>
                        <th v-text="candidate.jobInterest" v-bind:class="{ 'd-none': ! showJobInterest }"></th>
                        <th v-text="candidate.jobType" v-bind:class="{ 'd-none': ! showJobType }"></th>
                        <th v-text="candidate.transportation" v-bind:class="{ 'd-none': ! showTransportation }"></th>
                        <th v-text="candidate.citizenship" v-bind:class="{ 'd-none': ! showCitizenship }"></th>
                        <th v-text="candidate.compensationInjury" v-bind:class="{ 'd-none': ! showCompensationInjury }"></th>
                        <th v-text="candidate.compensationDateFrom" v-bind:class="{ 'd-none': ! showCompensationDateFrom }"></th>
                        <th v-text="candidate.compensationDateTo" v-bind:class="{ 'd-none': ! showCompensationDateTo }"></th>
                        <th v-text="candidate.healthProblem" v-bind:class="{ 'd-none': ! showHealthConditions }"></th>
                        <th v-text="candidate.dependants" v-bind:class="{ 'd-none': ! showDependants }"></th>
                        <th v-text="candidate.smoke" v-bind:class="{ 'd-none': ! showSmoke }"></th>
                        <th v-text="candidate.conviction" v-bind:class="{ 'd-none': ! showConviction }"></th>
                        <th v-text="candidate.convictionDetails" v-bind:class="{ 'd-none': ! showConvictionDetails }"></th>
                    
                        
                    </tr>
                </tbody>
                
            </table>
           
        </div>
    </div>
    <!-- Table End -->

    <!-- Pagination -->
    <nav aria-label="Candidate Page">
        <ul class="pagination justify-content-center">
            
            <li class="page-item" v-for="pageNum in pageNums" :key="pageNum.id" :class="{ active: pageNum.isActive }">
                <a class="page-link"  href="#" @click.stop.prevent="getCandidates(pageNum.id)">{{ pageNum.id / 10 + 1 }}</a>
            </li>
            
            
        </ul>
    </nav>
    <!-- Pagination End -->

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
        candidates: <?php echo json_encode($candidates); ?>,
        candidatesCopy: [],
        showBookmark: true,
        
        showFirstName: true,
        showLastName: true,
        showJobInterest: true,
        showJobType: true,
        showTransportation: true,
        showCitizenship: true,
        showCompensationInjury: true,
        showCompensationDateFrom: true,
        showCompensationDateTo: true,
        showHealthConditions: true,
        showDependants: true,
        showSmoke: true,
        showConviction: true,
        showConvictionDetails: true,
        
        candidateNum: <?php echo $candidateNum; ?>,
        // filters
        filterJobInterest: "",
        filterJobType: "",
        filterTransportation: "",
        // pages
        pageNums:[
            {id: 1, isActive: true}
        ]
        
    },
    methods: {
        applyFilters: function(){
            this.candidatesCopy = [];
            for(var i=0; i<this.candidates.length; i++){
                let jobInterest = this.candidates[i].jobInterest.toLowerCase();
                let jobType = this.candidates[i].jobType.toLowerCase();
                let transportation = this.candidates[i].transportation.toLowerCase();
                
                if(jobInterest.search(this.filterJobInterest.toLowerCase()) >= 0
                    && jobType.search(this.filterJobType.toLowerCase()) >= 0
                    && transportation.search(this.filterTransportation.toLowerCase()) >= 0){
                    this.candidatesCopy.push(this.candidates[i]);
                }
            }
        },
        clearFilters: function(){
            this.filterJobInterest = "";
            this.filterJobType = "";
            this.filterTransportation = "";
            this.candidatesCopy = this.candidates;
        },
        sortBy: function(sortKey) {
            if (sortKey == 'FirstName') {
                this.toggle = !this.toggle
                if(this.toggle) {
                    this.candidatesCopy.sort(function(a, b) {
                        return a.FirstName.localeCompare(b.FirstName)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.FirstName.localeCompare(a.FirstName)
                    })
                }
            } else if (sortKey == 'LastName') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.candidatesCopy.sort(function(a, b) {
                        return a.LastName.localeCompare(b.LastName)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.LastName.localeCompare(a.LastName)
                    })
                }
            } else if (sortKey == 'jobInterest') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.candidatesCopy.sort(function(a, b) {
                        return a.jobInterest.localeCompare(b.jobInterest)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.jobInterest.localeCompare(a.jobInterest)
                    })
                }
            } else if (sortKey == 'jobType') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.candidatesCopy.sort(function(a, b) {
                        return a.jobType.localeCompare(b.jobType)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.jobType.localeCompare(a.jobType)
                    })
                }
            } else if (sortKey == 'transportation') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.candidatesCopy.sort(function(a, b) {
                        return a.transportation.localeCompare(b.transportation)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.transportation.localeCompare(a.transportation)
                    })
                }
            } else if (sortKey == 'citizenship') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.candidatesCopy.sort(function(a, b) {
                        return a.citizenship.localeCompare(b.citizenship)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.citizenship.localeCompare(a.citizenship)
                    })
                }
            } else if (sortKey == 'compensationInjury') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.candidatesCopy.sort(function(a, b) {
                        return a.compensationInjury.localeCompare(b.compensationInjury)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.compensationInjury.localeCompare(a.compensationInjury)
                    })
                }
            } else if (sortKey == 'compensationDateFrom') {
                this.toggle = !this.toggle
                if(this.toggle){ 
                    this.candidatesCopy.sort(function(a, b) {
                        return a.compensationDateFrom.localeCompare(b.compensationDateFrom)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.compensationDateFrom.localeCompare(a.compensationDateFrom)
                    })
                }
            } else if (sortKey == 'compensationDateTo') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.candidatesCopy.sort(function(a, b) {
                        return a.compensationDateTo.localeCompare(b.compensationDateTo)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.compensationDateTo.localeCompare(a.compensationDateTo)
                    })
                }
            }
            else if (sortKey == 'healthProblem') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.candidatesCopy.sort(function(a, b) {
                        return a.healthProblem.localeCompare(b.healthProblem)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.healthProblem.localeCompare(a.healthProblem)
                    })
                }
            }
            else if (sortKey == 'dependants') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.candidatesCopy.sort(function(a, b) {
                        return a.dependants.localeCompare(b.dependants)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.dependants.localeCompare(a.dependants)
                    })
                }
            }
            else if (sortKey == 'smoke') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.candidatesCopy.sort(function(a, b) {
                        return a.smoke.localeCompare(b.smoke)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.smoke.localeCompare(a.smoke)
                    })
                }
            }
            else if (sortKey == 'conviction') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.candidatesCopy.sort(function(a, b) {
                        return a.conviction.localeCompare(b.conviction)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.conviction.localeCompare(a.conviction)
                    })
                }
            }
            else if (sortKey == 'convictionDetails') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.candidatesCopy.sort(function(a, b) {
                        return a.convictionDetails.localeCompare(b.convictionDetails)
                    })
                } else {
                    this.candidatesCopy.sort(function(a, b) {
                        return b.convictionDetails.localeCompare(a.convictionDetails)
                    })
                }
            }
        },
        getCandidates: function(offset){
            for(var i=0; i<this.pageNums.length; i++){
                if(this.pageNums[i].id == offset){
                    this.pageNums[i].isActive = true;
                } else {
                    this.pageNums[i].isActive = false;
                }
            }
            var formData = new FormData()
            formData.append('offset', offset);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/CandidateMission/getCandidates/'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body
                this.candidates = [];
                this.candidates = result;
                for(var i=0; i<this.candidates.length; i++){
                    if(this.candidates[i].asthma == 'true' || this.candidates[i].blackOut == 'true' || 
                        this.candidates[i].diabetes == 'true' || this.candidates[i].bronchitis == 'true' ||
                        this.candidates[i].backInjury == 'true' || this.candidates[i].deafness == 'true' ||
                        this.candidates[i].dermatitis == 'true' || this.candidates[i].skinInfection == 'true' ||
                        this.candidates[i].allergies == 'true' || this.candidates[i].hernia == 'true' ||
                        this.candidates[i].highBloodPressure == 'true' || this.candidates[i].heartProblems == 'true' ||
                        this.candidates[i].usingDrugs == 'true' || this.candidates[i].usingContactLenses == 'true' ||
                        this.candidates[i].RSI == 'true'){
                        this.candidates[i].healthProblem = 'YES';
                    } else {
                        this.candidates[i].healthProblem = 'NO';
                    }
            
                }
                this.candidatesCopy = this.candidates;
                
            }, res => {
                // error callback
                
            })
        },
        downloadCV: function(candidateID){
            console.log(candidateID);
        }
        
    },
    mounted: function(){
        
        for(var i=0; i<this.candidates.length; i++){
            if(this.candidates[i].asthma == 'true' || this.candidates[i].blackOut == 'true' || 
                this.candidates[i].diabetes == 'true' || this.candidates[i].bronchitis == 'true' ||
                this.candidates[i].backInjury == 'true' || this.candidates[i].deafness == 'true' ||
                this.candidates[i].dermatitis == 'true' || this.candidates[i].skinInfection == 'true' ||
                this.candidates[i].allergies == 'true' || this.candidates[i].hernia == 'true' ||
                this.candidates[i].highBloodPressure == 'true' || this.candidates[i].heartProblems == 'true' ||
                this.candidates[i].usingDrugs == 'true' || this.candidates[i].usingContactLenses == 'true' ||
                this.candidates[i].RSI == 'true'){
                this.candidates[i].healthProblem = 'YES';
            } else {
                this.candidates[i].healthProblem = 'NO';
            }
            
        }
        this.candidatesCopy = this.candidates;

        // inite pageNums
        this.pageNums = [];
        for(var i=0; i<this.candidateNum; i=i+10){
            
            this.pageNums.push({id: i, isActive: false});
        }
        this.pageNums[0].isActive = true;

    }

})
</script>