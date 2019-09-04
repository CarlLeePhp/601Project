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
        
        jobs: <?php echo json_encode($jobs)?>,
        uncheckedJobsCount: 0,
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
        uncheckedCandidateCount: 0,
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
        showRemoveStatus: false,

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
                let company = this.jobsCopy[i].Company.toLowerCase();
                let city = this.jobsCopy[i].City.toLowerCase();
                let jobTitle = this.jobsCopy[i].JobTitle.toLowerCase();
                let contactNumber = this.jobsCopy[i].ContactNumber.toLowerCase();
                let contactPerson = this.jobsCopy[i].ClientName.toLowerCase();
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
            var formData = new FormData()

            formData.append('jobID', jobID);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/applicant/checkClient/'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body
                // remove it from the jobs array
                for(var i=0; i<this.jobs.length; i++){
                    if(this.jobs[i].id == jobID){
                        this.jobs.splice(i, 1);
                    }
                }
                this.jobsCopy = this.jobs;
                this.uncheckedJobsCount = this.uncheckedJobsCount-1;
            }, res => {
                // error callback
                this.message = 'Post was failed, please try it later.';
                $('#myModal').modal('show');
            })
        },
        checkCandidate: function(candidateID){
            var formData = new FormData()

            formData.append('candidateID', candidateID);
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/applicant/checkCandidate/'
            this.$http.post(urllink, formData).then(res => {
                var result = res.body
                // remove it from the candidatesCopy array
                for(var i=0; i<this.candidatesCopy.length; i++){
                    if(this.candidatesCopy[i].CandidateID == candidateID){
                        this.candidatesCopy.splice(i, 1);
                    }
                }
                this.candidates = this.candidatesCopy;
                this.uncheckedCandidateCount = this.uncheckedCandidateCount-1;
            }, res => {
                // error callback
                this.message = 'Post was failed, please try it later.';
                $('#myModal').modal('show');
            })
        },
        getUrl: function(candidateID){
            var issetJob = "<?php if(isset($job['JobID'])){ echo $job['JobID'];}?>"
            var goToUrl = "<?php echo base_url() . 'index.php/CandidateMission/candidateDetails/';?>"+candidateID +"/"+issetJob;
            document.location.href = goToUrl;
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
        removeCandidateApp: function(elementID){
            var formData = new FormData()
            formData.append('candidateID',elementID)
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/CandidateMission/removeCandidateApplication/'
            this.$http.post(urllink, formData).then(res => {
                
            }, res => {
                
            })
            $('#rowCandidate'+elementID).addClass('text-muted');
            $('#rowCandidate'+elementID).css('background-color',"#F0F0F0");
        },
        removeJobApp: function(elementID){
            var formData = new FormData()
            formData.append('jobID',elementID)
            var urllink = "<?php echo base_Url(); ?>" + 'index.php/Jobs/removeJobApplication/'
            this.$http.post(urllink, formData).then(res => {
                
            }, res => {
                
            })
            $('#rowJob'+elementID).addClass('text-muted');
            $('#rowJob'+elementID).css('background-color',"#F0F0F0");
        },
        showRemoveTab: function(){
            this.showRemoveStatus = !this.showRemoveStatus
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
    },
    mounted: function(){
        this.jobsCopy = this.jobs;
        this.uncheckedJobsCount = this.jobsCopy.length;
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
           
            this.uncheckedCandidateCount+=1;
        }
        this.candidatesCopy = this.candidates;
    }
})
</script>