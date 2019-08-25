</div> <!-- App -->

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
var app = new Vue({
    el: '#app',
    data: {
        message: "",
        bookmarkID: "",
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
                dateSubmitted: "<?php echo $job['JobSubmittedDate']?>",
                ref: "<?php echo base_url()?>index.php/Jobs/jobDetails/<?php echo $job['JobID'];?>",
                checked: "<?php if($job['Checked']=="true"){ echo true; } else { echo false;};?>",
            },
            <?php endforeach; ?>
        ],
        jobsCopy: [],
        showClientCheck: true,
        showDetails: true,
        showClientTitle: true,
        showClientName: true,
        showCompany: true,
        showClinetEmail: true,
        showContactNumber: true,
        showJobTitle : true,
        showJobType: true,
        showClientAddress: true,
        showClientCity: true,
        showDescription: true,
        showDateSubmitted: true,
        
        // filters
        filterCompany: "",
        filterCity: "",
        filterJobTitle: "",
        filterContactNumber: "",
        filterContactPerson: "",

        candidates: <?php echo json_encode($candidates); ?>,
        candidatesCopy: [],
        showCandidateCheck: true,
        showFirstName: true,
        showLastName: true,
        showJobInterest: true,
        showJobType: true,
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

        // filters
        filterJobInterest: "",
        filterJobType: "",
        filterFirstName: "",
        filterCity: "",
        filterLastName: "",
        filterSuburb: "",
        filterPhoneNumber: "",
        filterEmail: "",
        
    },
    methods: {
        applyFilters: function(){
            this.jobs = [];
            for(var i=0; i<this.jobsCopy.length; i++){
                let company = this.jobsCopy[i].company.toLowerCase();
                let city = this.jobsCopy[i].city.toLowerCase();
                let jobTitle = this.jobsCopy[i].jobTitle.toLowerCase();
                let contactNumber = this.jobsCopy[i].contactNumber.toLowerCase();
                let contactPerson = this.jobsCopy[i].clientName.toLowerCase();
                if(company.search(this.filterCompany.toLowerCase()) >= 0
                    && city.search(this.filterCity.toLowerCase()) >= 0
                    && jobTitle.search(this.filterJobTitle.toLowerCase()) >= 0
                    && contactNumber.search(this.filterContactNumber.toLowerCase()) >= 0
                    && contactPerson.search(this.filterContactPerson.toLowerCase()) >= 0){
                    this.jobs.push(this.jobsCopy[i]);
                }
            }
        },
        clearFilters: function(){
            this.filterCompany = "";
            this.filterCity = "";
            this.filterJobTitle = "";
            this.filterContactNumber = "";
            this.filterContactPerson = "";
            this.jobs = this.jobsCopy;
        },
        candidateFilters: function(){
            this.candidatesCopy = [];
            for(var i=0; i<this.candidates.length; i++){
                let jobInterest = this.candidates[i].JobInterest.toLowerCase();
                let jobType = this.candidates[i].JobType.toLowerCase();
                let firstName = this.candidates[i].FirstName.toLowerCase();
                let city = this.candidates[i].City.toLowerCase();
                let lastName = this.candidates[i].LastName.toLowerCase();
                let suburb = this.candidates[i].Suburb.toLowerCase();
                let phoneNumber = this.candidates[i].PhoneNumber.toLowerCase();
                let email = this.candidates[i].Email.toLowerCase();
                if(jobInterest.search(this.filterJobInterest.toLowerCase()) >= 0
                    && jobType.search(this.filterJobType.toLowerCase()) >= 0
                    && firstName.search(this.filterFirstName.toLowerCase()) >= 0
                    && city.search(this.filterCity.toLowerCase()) >= 0
                    && lastName.search(this.filterLastName.toLowerCase()) >= 0
                    && suburb.search(this.filterSuburb.toLowerCase()) >= 0
                    && phoneNumber.search(this.filterPhoneNumber.toLowerCase()) >= 0
                    && email.search(this.filterEmail.toLowerCase()) >= 0){
                    this.candidatesCopy.push(this.candidates[i]);
                }
            }
        },
        clearCandidateFilters: function(){
            this.filterJobInterest = "";
            this.filterJobType = "";
            this.filterFirstName = "";
            this.filterCity = "";
            this.filterLastName = "";
            this.filterPhoneNumber = "";
            this.filterEmail = "";
            this.candidatesCopy = this.candidates;
        },
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
        sortCandidate: function(sortKey){
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
        checkClient: function(jobID){
            console.log(jobID);
        },
        checkCandidate: function(candidateID){
            console.log(candidateID);
        }
        
    },
    mounted: function(){
        this.jobsCopy = this.jobs;

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
    }

})
</script>