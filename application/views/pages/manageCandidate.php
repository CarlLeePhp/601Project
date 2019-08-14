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
    <div style="overflow:auto" v-if="candidates.length > 0">
        
            <table class="table table-hover mt-5 mr-5">
           
                <thead>
                    <tr>
                        
                        <th scope="col" v-bind:class="{ 'd-none': ! showJobInterest }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('jobInterest')">Job Interest</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showJobType }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('jobType')">Job Type</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showClientName }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('transportation')">Transportation</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showTransportation }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('LicenseNumber')">Driver License</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showLicenseNumber }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('classLicense')">License Class</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showEndorsement }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('endorsement')">Endorsement</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCitizenship }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('citizenship')">Citizenship</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showNationality }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('nationality')">Nationality</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showPassportCountry }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('passportCountry')">Passport Country</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showpassportNumber }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('passportNumber')">Passport Number</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCompensationInjury }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('compensationInjury')">Compensation Injury</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCompensationDateFrom }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('compensationDateFrom')">Date From</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCompensationDateTo }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('compensationDateTo')">Date To</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showAsthma }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('asthma')">Asthma</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showBlackOut }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('blackOut')">BlackOut</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDiabetes }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('diabetes')">Diabetes</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showBronchitis }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('bronchitis')">Bronchitis</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showBackInjury }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('backInjury')">Back Injury</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDeafness }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('deafness')">Deafness</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDermatitis }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('dermatitis')">Dermatitis</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showSkinInfection }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('skinInfection')">Skin Infection</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showAllergies }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('allergies')">Allergies</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showHernia }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('hernia')">Hernia</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showHighBloodPressure }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('highBloodPressure')">High Blood Pressure</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showHeartProblems }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('heartProblems')">Heart Problems</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showUsingDrugs }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('usingDrugs')">Drugs</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showUsingContactLenses }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('usingContactLenses')">Lenses</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showRSI }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('RSI')">RSI</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDependants }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('dependants')">Dependants</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showSmoke }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('smoke')">Smoke</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showConviction }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('conviction')">Conviction</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showConvictionDetails }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('convictionDetails')">Conviction Detail</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="candidate in candidates" :key="candidate.CandidateID">
                        
                        <td v-text="candidate.jobInterest" v-bind:class="{ 'd-none': ! showClientTitle }"></td>
                        <td v-text="candidate.jobType" v-bind:class="{ 'd-none': ! showClientTitle }"></td>
                        <td v-text="candidate.transportation" v-bind:class="{ 'd-none': ! showClientName }"></td>
                        <td v-text="candidate.LicenseNumber" v-bind:class="{ 'd-none': ! showCompany }"></td>
                        <td v-text="candidate.classLicense" v-bind:class="{ 'd-none': ! showEmail }"></td>
                        <td v-text="candidate.endorsement" v-bind:class="{ 'd-none': ! showContactNumber }"></td>
                        
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
        candidates: <?php echo json_encode($candidates); ?>,
        candidatesCopy: [],
        showBookmark: true,
        
        showJobInterest: true,
        showJobType: true,
        showClientName: true,
        showTransportation: true,
        showLicenseNumber: true,
        showEndorsement: true,
        showCitizenship: true,
        showNationality: true,
        showPassportCountry: true,
        showpassportNumber: true,
        showCompensationInjury: true,
        showCompensationDateFrom: true,
        showCompensationDateTo: true,
        showAsthma: true,
        showBlackOut: true,
        showDiabetes: true,
        showBronchitis: true,
        showBackInjury: true,
        showDeafness: true,
        showDermatitis: true,
        showSkinInfection: true,
        showAllergies: true,
        showHernia: true,
        showHighBloodPressure: true,
        showHeartProblems: true,
        showUsingDrugs: true,
        showUsingContactLenses: true,
        showRSI: true,
        showDependants: true,
        showSmoke: true,
        showConviction: true,
        showConvictionDetails: true,
                    

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
            else if (sortKey == 'dateSubmitted') {
                this.toggle = !this.toggle
                if(this.toggle){
                    this.jobs.sort(function(a, b) {
                        return a.dateSubmitted.localeCompare(b.dateSubmitted)
                    })
                } else {
                    this.jobs.sort(function(a, b) {
                        return b.dateSubmitted.localeCompare(a.dateSubmitted)
                    })
                }
            }
        },
        
    },
    mounted: function(){
        
        
        this.candidatesCopy = this.candidates;
    }

})
</script>