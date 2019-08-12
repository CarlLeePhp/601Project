<div class="container" id="app">
    <h3 class="text-warning mx-5 mt-5">Jobs at Lee Recruitment</h3>
    <hr />
    <p class="lead">
        Many of jobs at Lee Recruitment vacancies are never advertised and we will help you to search for the jobs that
        suit your skills, experience and ambitions.
    </p>
    <div class="container my-3">
        <div class="row p-4 justify-content-around">
            <!-- startForm -->
            <form action="<?php echo base_url()?>index.php/Jobs" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <label for="JobTitleID" class="font-weight-bold">Job Title:</label>
                        <input class="form-control " type="text" placeholder="Keywords" id="JobTitle"
                            aria-label="JobTitle" name="jobTitle">
                    </div>
                    <div class="col-md-3 ">
                        <label for="JobType" class="font-weight-bold">Job Type:</label>
                        <select class="form-control " type="text" id="JobType" aria-label="JobType" name="jobType">
                            <option selected></option>
                            <option value="PartTime">Part Time</option>
                            <option value="Full Time">Full Time</option>
                        </select>
                    </div>
                    <div class="col-md-4 ">
                        <label for="Location" class="font-weight-bold">Location:</label>
                        <select class="form-control" type="text" id="Location" aria-label="Location" name="location" >
                        <option selected></option>
                        <?php foreach($cities as $city): ?>
                            <option value="<?php echo $city['CityName']; ?>"><?php echo $city['CityName']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-1 align-self-end my-3 my-md-0">
                        <input type="submit" value="Search" class="btn btn-primary">
                    </div>
                </div>
            </form>
            <!-- endform -->

            <!-- Job Table -->
    <div class="container">
      <hr />
      <div class="row mt-5">
         <div v-for="job in jobs">
            <div class="col m-3">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo base_url()?>lib/images/Aerial_Electronics_Install.jpg" class="card-img-top" alt="aerialElectronicsInstall">
                    <div class="card-body">
                        <p class="card-text" v-text="job.jobThumbnailText">
                        
                        </p>
                    </div>
                </div>
            </div>
        </div>
      </div>  <!--end row-->
      

    </div>
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
            jobID: "",
            jobTitle: "",
            jobType: "",
            location: "",
            jobThumbnailText: "",
            jobs: [
                <?php foreach ($jobs as $job): ?> {
                id: "<?php echo $job['JobID']; ?>",
                jobTitle: "<?php echo $job['JobTitle']; ?>",
                jobType: "<?php echo $job['JobType']; ?>",
                location: "<?php echo $job['City']; ?>",
                jobThumbnailText: "<?php echo $job['ThumbnailText']; ?>",
            },
            <?php endforeach; ?>
            ],
        },
        methods: {
            
        }
        
    })
</script>