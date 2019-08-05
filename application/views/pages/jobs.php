<div class="container" id="app">

    <h3 class="text-warning mx-5 mt-5">Jobs at Lee Recruitment</h3>
    <hr />
    <p class="lead">
        Many of jobs at Lee Recruitment vacancies are never advertised and we will help you to search for the jobs that
        suit your skills, experience and ambitions.
    </p>
    <div class="container border-bottom  mb-3">

        <div class="row p-4 justify-content-around">
            <!-- startForm -->
            <form action="#" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <label for="JobTitleID" class="font-weight-bold">Job Title:</label>
                        <input class="form-control " type="text" placeholder="Keywords" id="JobTitle"
                            aria-label="JobTitle" v-model="jobTitle">
                    </div>
                    <div class="col-md-3 ">
                        <label for="JobType" class="font-weight-bold">Job Type:</label>
                        <select class="form-control " type="text" id="JobType" aria-label="JobType" v-model="jobType">
                            <option selected>Job Type</option>
                            <option value="1">Part Time</option>
                            <option value="2">Full Time</option>
                        </select>
                    </div>
                    <div class="col-md-4 ">
                        <label for="Location" class="font-weight-bold">Location:</label>
                        <select class="form-control " type="text" id="Location" aria-label="Location" v-model="location">
                            <option selected>Any Locations</option>
                            <option value="1">Invercargill</option>
                            <option value="2">Te Anau</option>
                            <option value="3">Otago</option>
                            <option value="4">Queenstown</option>
                            <option value="5">Dunedin</option>
                            <option value="6">Timaru</option>
                            <option value="7">Nelson</option>
                        </select>
                    </div>
                    <div class="col-md-1 align-self-end my-3 my-md-0">
                        <input type="submit" value="Search" class="btn btn-primary">
                    </div>
                </div>
            </form>
            <!-- endform -->

            <!-- Job Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th scop="col">ID</th>
                        <th scop="col">Job Title</th>
                        <th scop="col">Location</th>
                    </tr> 
                </thead>
                <tbody>
                    <tr v-for="job in jobs" :key="job.id">
                        <td>{{ job.id }}</td>
                        <td>{{ job.jobTitle }}</td>
                        <td>{{ job.location }}</td>
                    </tr>
                    
                </tbody>
            </table>

            <!-- Job Table End-->
           
        </div>
    </div>

</div>

<!-- Vue -->
<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            jobTitle: "",
            jobType: "",
            location: "",
            jobs: [
                <?php foreach($jobs as $job): ?>
                    {
                        id: <?php echo $job['JobID']; ?>,
                        jobTitle: "<?php echo $job['JobTitle']; ?>",
                        location: <?php echo $job['City']; ?>
                    },
                <?php endforeach; ?>
            ]
        },
        methods: {
            
        }
        
    })
</script>