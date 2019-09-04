
<div id="app">

<?php if(sizeof($job)>3):?>
<div class="form-control bg-success text-center text-white font-weight-bold rounded-0" style="position:fixed; top:0px;z-index:1;opacity:0.9">
    Assigning candidate to <?php echo $job['JobTitle'] . ' in ' . $job['City'];?>
</div>
<?php endif;?>
    <div style="height: 50px;"></div>

    <h2 class="text-center"><?php echo $title; ?></h2>
    <hr />
    
    
    <div class="container ">
        <a href="<?php echo base_url()?>index.php/CandidateMission/addingNewCandidateStaffOnly">
            <button type="button" style="position:fixed;right: 20px; bottom:20px;z-index:1" class="btn btn-dark btn-lg border-white">
            <i style="font-size:30px;" class="icon ion-md-add m-1 text-white"></i>
            </button>
        </a>
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
                    
                    <select class="form-control p-2" type="text" v-model="filterJobType" id="jobTypeID">
                        <option selected></option>
                        <option value="FullTime">Full Time</option>
                        <option value="PartTime">Part Time</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="FirstName">First Name:</label>
                    <input type="text" class="form-control" v-model="filterFirstName" id="FirstName" placeholder="FirstName">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="LastName">Last Name:</label>
                    <input type="text" class="form-control" v-model="filterLastName" id="LastName" placeholder="LastName">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="City">City:</label>
                    <input type="text" class="form-control" v-model="filterCity" id="City" placeholder="City">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="Suburb">Suburb:</label>
                    <input type="text" class="form-control" v-model="filterSuburb" id="Suburb" placeholder="Suburb">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="PhoneNumber">Phone Number:</label>
                    <input type="text" class="form-control" v-model="filterPhoneNumber" id="PhoneNumber" placeholder="PhoneNumber">
                </div>
                <div class="form-group col-md-3">
                    <label class="text-dark font-weight-bold" for="Email">Email:</label>
                    <input type="text" class="form-control" v-model="filterEmail" id="Email" placeholder="Email">
                </div>
                
            </div>
            <button class="btn btn-outline-info " @click="applyFilters">Apply</button>
            <button class="btn btn-outline-dark mx-2" @click="clearFilters">Clear</button>

            <p class="mt-md-5 mt-3 text-dark font-weight-bold">Shows column:</p>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showPhoneNumber" id="showPhoneNumber">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showPhoneNumber">
                    Phone Number
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showDOB" id="showDOB">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showDOB">
                    Date Of Birth
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showEmail" id="showEmail">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showEmail">
                    Email
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showCity" id="showCity">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showCity">
                    City
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showAddress" id="showAddress">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showAddress">
                   Address
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showSuburb" id="showSuburb">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showSuburb">
                   Suburb
                </label>
            </div>
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showGender" id="showGender">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showGender">
                   Gender
                </label>
            </div>
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
                <input class="form-check-input" type="checkbox" v-model="showCV" id="showCV">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showCV">
                    CV
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
            <div class="form-check form-check-inline col-md-2">
                <input class="form-check-input" type="checkbox" v-model="showCandidateNotes" id="showCandidateNotes">
                <label style="font-size: 1em;" class="form-check-label my-1" for="showCandidateNotes">
                    Notes
                </label>
            </div>
        </div>
        <!-- Collapse End -->

        
        
    </div>
    <!-- Table -->
    <div class=" mb-5 px-5">
    <div class="dragscroll" style="overflow: scroll; cursor: grab; cursor : -o-grab; cursor : -moz-grab; cursor : -webkit-grab;" >
        
            <table class="table table-hover mt-5 mr-5" id="candidateTable">
           
                <thead>
                    <tr>
                        <th scope="col" v-bind:class="{ 'd-none': ! showAssignCandidate }"><a href="#" class="text-dark" @click.stop.prevent="">Assign Candidate</a></th>
                        <th scope="col"><a href="#" class="text-dark" @click.stop.prevent="">Details</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCV }">CV</th>
                        <th scope="col" ><a href="#" class="text-dark pr-5" @click.stop.prevent="sortBy('ApplyDate')">Apply date</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showFirstName }"><a href="#" class="text-dark pr-5" @click.stop.prevent="sortBy('FirstName')">First Name</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showLastName }"><a href="#" class="text-dark pr-5" @click.stop.prevent="sortBy('LastName')">Last Name</a></th>
                        
                        <th scope="col" v-bind:class="{ 'd-none': ! showPhoneNumber }"><a href="#" class="text-dark" @click.stop.prevent="">Phone Number</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDOB }"><a href="#" class="text-dark pr-5" @click.stop.prevent="sortBy('DOB')">Date Of Birth</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showEmail }"><a href="#" class="text-dark" @click.stop.prevent="">Email</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCity }"><a href="#" class="text-dark pt-5 pr-5 pb-3 pl-0" @click.stop.prevent="sortBy('City')">City</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showAddress }"><a href="#" class="text-dark" @click.stop.prevent="">Address</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showSuburb }"><a href="#" class="text-dark pt-5 pr-5 pb-3 pl-0" @click.stop.prevent="sortBy('Suburb')">Suburb</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showGender }"><a href="#" class="text-dark pt-5 pr-5 pb-3 pl-0" @click.stop.prevent="sortBy('Gender')">Gender</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showJobInterest }"><a href="#" class="text-dark pt-5 pr-5 pb-3 pl-0" @click.stop.prevent="sortBy('JobInterest')">Job Interest</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showJobType }"><a href="#" class="text-dark pt-5 pr-5 pb-3 pl-0" @click.stop.prevent="sortBy('JobType')">Job Type</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showTransportation }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('Transportation')">Transportation</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCitizenship }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('Citizenship')">Citizenship</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCompensationInjury }"><a href="#" class="text-dark pt-5 pr-5 pb-3 pl-0" @click.stop.prevent="sortBy('CompensationInjury')">Compensation Injury</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCompensationDateFrom }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('CompensationDateFrom')">Compensation From</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCompensationDateTo }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('CompensationDateTo')">Compensation To</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showHealthConditions }"><a href="#" class="text-dark pt-5 pr-5 pb-3 pl-0" @click.stop.prevent="sortBy('healthProblem')">Health Problem</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showDependants }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('Dependants')">Dependants</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showSmoke }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('Smoke')">Smoke</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showConviction }"><a href="#" class="text-dark pt-5 pr-5 pb-3 pl-0" @click.stop.prevent="sortBy('Conviction')">Conviction</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showConvictionDetails }"><a href="#" class="text-dark" @click.stop.prevent="sortBy('ConvictionDetails')">Conviction Detail</a></th>
                        <th scope="col" v-bind:class="{ 'd-none': ! showCandidateNotes }"><a href="#" class="text-dark" @click.stop.prevent="">Notes</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="candidate in candidatesCopy" :key="candidate.CandidateID">
                        <th class="textInfoPos" v-bind:class="{ 'd-none': ! showAssignCandidate }"><span class="textInfo text-center" style="left: 0px;overflow:initial;">Assign job <br>to this Candidate</span><a v-on:click="AssignIDURL(candidate.CandidateID)" role="button" class="text-info"><i style="font-size:30px;" class="ml-1 icon ion-md-contacts mx-3"></i></a></th>
                        <th class="textInfoPos"><span class="textInfo text-center" style="left: -35px;width:190px;">See Candidate's Details</span><a v-on:click="getUrl(candidate.CandidateID)" role="button" class="text-primary"><i style="font-size:30px;" class="ml-1 icon ion-md-document mx-3"></i></a></th>
                        <th class="textInfoPos" v-bind:class="{ 'd-none': ! showCV }"><span class="textInfo text-center" style="left: -45px;width:160px;">Download <br>Candidate's CV</span><a class="btn btn-outline-dark px-2" :href="'<?php echo base_Url(); ?>index.php/candidateMission/downloadCV/' + candidate.JobCV">CV</a></th>
                        <th v-text="candidate.ApplyDate"></th>
                        <th v-text="candidate.FirstName" v-bind:class="{ 'd-none': ! showFirstName }"></th>
                        <th v-text="candidate.LastName" v-bind:class="{ 'd-none': ! showLastName }"></th>
                        <th v-text="candidate.PhoneNumber" v-bind:class="{ 'd-none': ! showPhoneNumber }"></th>
                        <th v-text="candidate.DOB" v-bind:class="{ 'd-none': ! showDOB }"></th>
                        <th v-text="candidate.Email" v-bind:class="{ 'd-none': ! showEmail }"></th>
                        <th v-text="candidate.City" v-bind:class="{ 'd-none': ! showCity }"></th>
                        <th v-text="candidate.Address" v-bind:class="{ 'd-none': ! showAddress }"></th>
                        <th v-text="candidate.Suburb" v-bind:class="{ 'd-none': ! showSuburb }"></th>
                        <th v-text="candidate.Gender" v-bind:class="{ 'd-none': ! showGender }"></th>
                        <th v-text="candidate.JobInterest" v-bind:class="{ 'd-none': ! showJobInterest }"></th>
                        <th v-text="candidate.JobType" v-bind:class="{ 'd-none': ! showJobType }"></th>
                        <th v-text="candidate.Transportation" v-bind:class="{ 'd-none': ! showTransportation }"></th>
                        <th v-text="candidate.Citizenship" v-bind:class="{ 'd-none': ! showCitizenship }"></th>
                        <th v-text="candidate.CompensationInjury" v-bind:class="{ 'd-none': ! showCompensationInjury }"></th>
                        <th v-text="candidate.CompensationDateFrom" v-bind:class="{ 'd-none': ! showCompensationDateFrom }"></th>
                        <th v-text="candidate.CompensationDateTo" v-bind:class="{ 'd-none': ! showCompensationDateTo }"></th>
                        <th v-text="candidate.healthProblem" v-bind:class="{ 'd-none': ! showHealthConditions }"></th>
                        <th v-text="candidate.Dependants" v-bind:class="{ 'd-none': ! showDependants }"></th>
                        <th v-text="candidate.Smoke" v-bind:class="{ 'd-none': ! showSmoke }"></th>
                        <th v-text="candidate.Conviction" v-bind:class="{ 'd-none': ! showConviction }"></th>
                        <th v-text="candidate.ConvictionDetails" v-bind:class="{ 'd-none': ! showConvictionDetails }"></th>
                        <th v-bind:class="{ 'd-none': ! showCandidateNotes }"><input type="text" @click="targetThisBox(candidate.CandidateID)" v-on:keyup.enter="clearSelection()" :id="candidate.CandidateID" v-on:change="updateNotes(candidate.CandidateID)" :value="candidate.CandidateNotes"></th>
                    
                        
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
                <div v-if="pageNum.id >= currentPageID-2 && pageNum.id <= currentPageID + 2">
                    <a class="page-link"  href="#" @click.stop.prevent="getCandidates(pageNum.id)">{{ pageNum.id + 1 }}</a>
                </div>
            </li>
            
            
        </ul>
    </nav>

    <p>{{ currentPageID }}</p>
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
        showBookmark: false,
        showAssignCandidate: <?php if(isset($job['JobID'])){echo "true";} else {echo "false";}?>,
        showFirstName: true,
        showLastName: true,
        showJobInterest: true,
        showJobType: true,
        showCV: true,
        showTransportation: true,
        showCitizenship: true,
        showCompensationInjury: true,
        showCompensationDateFrom: false,
        showCompensationDateTo: false,
        showHealthConditions: true,
        showDependants: false,
        showSmoke: false,
        showConviction: true,
        showConvictionDetails: false,
        showCandidateNotes: true,
        showPhoneNumber: true,
        showDOB: true,
        showEmail: true,
        showCity: true,
        showAddress: false,
        showSuburb: true,
        showGender: false,
        candidateNum: <?php echo $candidateNum; ?>,
        fromPage: "<?php echo $fromPage;?>",
        hiddenInput: "",
        // filters
        filterJobInterest: "<?php if(!empty($job['JobTitle'])){echo $job['JobTitle'];}?>",
        filterJobType: "<?php if(!empty($job['JobType'])){echo $job['JobType'];}?>",
        filterFirstName: "",
        filterCity: "<?php if(!empty($job['City'])){echo $job['City'];}?>",
        filterLastName: "",
        filterSuburb: "",
        filterPhoneNumber: "",
        filterEmail: "",
        // pages
        pageNums:[
            {id: 1, isActive: true}
        ]
        
    },
    methods: {
        applyFilters: function(){
            var formData = new FormData()
            formData.append('offset',1)
            formData.append('jobInterest',this.filterJobInterest);
            formData.append('city', this.filterCity);
            formData.append('jobType',this.filterJobType);
            formData.append('firstName',this.filterFirstName);
            formData.append('phoneNumber',this.filterPhoneNumber);
            formData.append('lastName',this.filterLastName);
            formData.append('suburb',this.filterSuburb);
            formData.append('email',this.filterEmail);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/CandidateMission/applyFilterCandidate/<?php echo $fromPage;?>'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body
                this.candidatesCopy = result
            
                this.pageNums = [];
                for(var i=0; i<this.candidateCopy.length; i=i+10){
                    this.pageNums.push({id: i, isActive: false});
                }
                this.pageNums[0].isActive = true;
                for(var i=0; i<this.candidatesCopy.length; i++){
            if(this.candidatesCopy[i].Asthma == 'true' || this.candidatesCopy[i].BlackOut == 'true' || 
                this.candidatesCopy[i].Diabetes == 'true' || this.candidatesCopy[i].Bronchitis == 'true' ||
                this.candidatesCopy[i].BackInjury == 'true' || this.candidatesCopy[i].Deafness == 'true' ||
                this.candidatesCopy[i].Dermatitis == 'true' || this.candidatesCopy[i].SkinInfection == 'true' ||
                this.candidatesCopy[i].Allergies == 'true' || this.candidatesCopy[i].Hernia == 'true' ||
                this.candidatesCopy[i].HighBloodPressure == 'true' || this.candidatesCopy[i].HeartProblems == 'true' ||
                this.candidatesCopy[i].UsingDrugs == 'true' ||
                this.candidatesCopy[i].RSI == 'true'){
                this.candidatesCopy[i].healthProblem = 'YES';
            } else {
                this.candidatesCopy[i].healthProblem = 'NO';
            }
            
        }
            }, res => {
            })
        },
        clearFilters: function(){
            if(this.fromPage != "jobDetails"){
                document.location.reload();
            } else {
            this.filterJobInterest = "";
            this.filterJobType = "";
            this.filterFirstName = "";
            this.filterCity = "";
            this.filterLastName = "";
            this.filterPhoneNumber = "";
            this.filterEmail = "";
            this.applyFilters();
            }
        },
        sortBy: function(sortKey) {
            this.toggle = !this.toggle;
            if(this.toggle){
                this.candidatesCopy.sort(function(a, b){
                    return a[sortKey].localeCompare(b[sortKey]);
                })
            } else {
                this.candidatesCopy.sort(function(a, b){
                    return b[sortKey].localeCompare(a[sortKey]);
                })
            }
        },
        targetThisBox: function(elementID){
            const input = document.getElementById(elementID);
            input.focus();
            input.select();
        },
        clearSelection: function(){
            if (window.getSelection) {window.getSelection().removeAllRanges();document.activeElement.blur();}
            else if (document.selection) {document.selection.empty();}
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
            formData.append('offset',offset)
            formData.append('jobInterest',this.filterJobInterest);
            formData.append('city', this.filterCity);
            formData.append('jobType',this.filterJobType);
            formData.append('firstName',this.filterFirstName);
            formData.append('phoneNumber',this.filterPhoneNumber);
            formData.append('lastName',this.filterLastName);
            formData.append('suburb',this.filterSuburb);
            formData.append('email',this.filterEmail);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/CandidateMission/getCandidates/<?php echo $fromPage;?>'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body
                this.candidatesCopy = result
                for(var i=0; i<this.candidatesCopy.length; i++){
            if(this.candidatesCopy[i].Asthma == 'true' || this.candidatesCopy[i].BlackOut == 'true' || 
                this.candidatesCopy[i].Diabetes == 'true' || this.candidatesCopy[i].Bronchitis == 'true' ||
                this.candidatesCopy[i].BackInjury == 'true' || this.candidatesCopy[i].Deafness == 'true' ||
                this.candidatesCopy[i].Dermatitis == 'true' || this.candidatesCopy[i].SkinInfection == 'true' ||
                this.candidatesCopy[i].Allergies == 'true' || this.candidatesCopy[i].Hernia == 'true' ||
                this.candidatesCopy[i].HighBloodPressure == 'true' || this.candidatesCopy[i].HeartProblems == 'true' ||
                this.candidatesCopy[i].UsingDrugs == 'true' ||
                this.candidatesCopy[i].RSI == 'true'){
                this.candidatesCopy[i].healthProblem = 'YES';
            } else {
                this.candidatesCopy[i].healthProblem = 'NO';
            }
            
        }
            }, res => {
            })
        },
        updateNotes: function(candidateID){
            
            var formData = new FormData()
            formData.append('candidateNotes', document.getElementById(candidateID).value);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/Jobs/updateCandidateNotes/'+candidateID+'/'+'manageCandidate'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body;
                //update the changes into the data in current page.
                for(var i=0; i<this.candidates.length; i++){
                    if(this.candidates[i].CandidateID == candidateID){
                        this.candidates[i].CandidateNotes = document.getElementById(candidateID).value;
                        this.candidatesCopy[i].CandidateNotes = this.candidates[i].CandidateNotes;
                    }
                }
                
                $('#'+candidateID).html(result);
            }, res => {
                // error callback
                
            })
        },
        getUrl: function(candidateID){
            var issetJob = "<?php if(isset($job['JobID'])){ echo $job['JobID'];}?>"
            var goToUrl = "<?php echo base_url() . 'index.php/CandidateMission/candidateDetails/';?>"+candidateID +"/"+issetJob;
            document.location.href = goToUrl;
        },
        AssignIDURL: function(candidateID,jobID){
            var issetJob = "<?php if(isset($job['JobID'])){ echo $job['JobID'];}?>"
            var goToUrl = "<?php echo base_url() . 'index.php/Jobs/assignCandidate/';?>"+candidateID +"/"+issetJob;
            document.location.href = goToUrl;
        },
        
        
    },
    computed: {
        currentPageID: function(){
            let result;
            for(var i=0; i<this.pageNums.length; i++){
                if(this.pageNums[i].isActive){
                    result = this.pageNums[i].id;
                }
            }
            return result;
        }
    },
    mounted: function(){
        
        for(var i=0; i<this.candidates.length; i++){
            if(this.candidates[i].Asthma == 'true' || this.candidates[i].BlackOut == 'true' || 
                this.candidates[i].Diabetes == 'true' || this.candidates[i].Bronchitis == 'true' ||
                this.candidates[i].BackInjury == 'true' || this.candidates[i].Deafness == 'true' ||
                this.candidates[i].Dermatitis == 'true' || this.candidates[i].SkinInfection == 'true' ||
                this.candidates[i].Allergies == 'true' || this.candidates[i].Hernia == 'true' ||
                this.candidates[i].HighBloodPressure == 'true' || this.candidates[i].HeartProblems == 'true' ||
                this.candidates[i].UsingDrugs == 'true' ||
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
        
        this.filterJobType = "<?php echo $job['JobType']?>";
        
        this.filterCity = "<?php echo $job['City']?>";
    }

})
</script>