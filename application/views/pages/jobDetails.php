<?php if(!(isset($_SESSION['userType']))&& ($_SESSION['userType']!='admin' && $_SESSION['userType']!='staff')){
			redirect('/');
		} ?>
<div id="app">
<div style="height: 50px;"></div>

<h2 class="text-center"><?php echo $title; ?></h2>
<hr />

<div class="container mb-2 p-md-5">
<?php if($userType == 'staff' || $userType == 'admin'):?>
<div class="row justify-content-center">
    <table class="table table-sm col-4 table-hover">
    
    
    <tbody>
    <legend class="text-md-left text-center">Client's Brief: <b><?php echo strtoupper($job['JobStatus']);?></b></legend>
        <?php foreach($job as $key => $value):?>
        <?php if($key == 'JobID' || $key == 'Description' || $key == 'Editor1' || $key == 'ThumbnailText' || $key == 'JobStatus' || $key == 'PublishTitle' || $key == "PublishDate")  :?>
        <?php else :?>
        <tr>
        <th><?php echo $key ?></th>
        <td><?php echo $value?></th>
        </tr>
            <?php endif?>
        <?php endforeach;?>
        
    </tbody>
    </table>
    
    <div class="col-md-8">
    <div class="container">
        <h2 class="text-center font-weight-bold">Job Description</h2>
        <hr/>
        <textarea readonly class="form-control-plaintext ml-3" id="exampleFormControlTextarea1" rows="10">
            <?php echo $job['Description'] ;?>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis repudiandae modi dolor vel voluptas. Dolor nostrum blanditiis doloremque placeat, beatae odio, maxime corporis obcaecati omnis numquam nemo cumque facilis autem?
          
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis repudiandae modi dolor vel voluptas. Dolor nostrum blanditiis doloremque placeat, beatae odio, maxime corporis obcaecati omnis numquam nemo cumque facilis autem?

          Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis repudiandae modi dolor vel voluptas. Dolor nostrum blanditiis doloremque placeat, beatae odio, maxime corporis obcaecati omnis numquam nemo cumque facilis autem?

          Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis repudiandae modi dolor vel voluptas. Dolor nostrum blanditiis doloremque placeat, beatae odio, maxime corporis obcaecati omnis numquam nemo cumque facilis autem?

          Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis repudiandae modi dolor vel voluptas. Dolor nostrum blanditiis doloremque placeat, beatae odio, maxime corporis obcaecati omnis numquam nemo cumque facilis autem?

          Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis repudiandae modi dolor vel voluptas. Dolor nostrum blanditiis doloremque placeat, beatae odio, maxime corporis obcaecati omnis numquam nemo cumque facilis autem?

          Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis repudiandae modi dolor vel voluptas. Dolor nostrum blanditiis doloremque placeat, beatae odio, maxime corporis obcaecati omnis numquam nemo cumque facilis autem?

          Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis repudiandae modi dolor vel voluptas. Dolor nostrum blanditiis doloremque placeat, beatae odio, maxime corporis obcaecati omnis numquam nemo cumque facilis autem?

          Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis repudiandae modi dolor vel voluptas. Dolor nostrum blanditiis doloremque placeat, beatae odio, maxime corporis obcaecati omnis numquam nemo cumque facilis autem?

          Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis repudiandae modi dolor vel voluptas. Dolor nostrum blanditiis doloremque placeat, beatae odio, maxime corporis obcaecati omnis numquam nemo cumque facilis autem?

    </textarea>
    </div>
    </div>
</div>
<hr />
    <?php if( $job['JobStatus'] != NULL) :?>
    <div class="row justify-content-center">
        <a class="btn btn-outline-dark col-md-3 col-6" href="<?php echo base_url()?>index.php/Jobs/jobUnpublish/<?php echo $job['JobID'];?>">Unpublish from job page</a>
    </div>
    <?php endif;?>
</div>
    
<h2 class="text-center">WebContent</h2>
<hr class="border border-dark"/>

<!-- Editable Page For Job -->
<div class="container mb-5">
    <form action="<?php echo base_url()?>index.php/Jobs/jobPublish/<?php echo $job['JobID'];?>" method="post">
        <div class="row justify-content-start">
            <div class="col-12 mt-4">
                <input type="text" class="form-control border border-0" value="<?php echo $job['PublishTitle'] ;?>" style="height:80px;font-size:48px;" placeholder="Enter Title" name="publishTitle"/>
            </div>
        </div>
        <hr/>
        <div class="row mt-4">
            <div class="col-md-8">
            <table class="table table-sm table-hover">
                <tbody>
                <legend class="text-md-left text-center">Job's classifications:</legend>
                    <?php foreach($job as $key => $value):?>
                        <?php if(($key == 'JobTitle' || $key == 'JobType' || $key == 'City' || $key == 'Suburb' || $key == 'PublishDate') && $value != NULL):?>
                        <tr>
                        <th><?php echo $key . ':';?></th>
                        <td><?php echo $value?></th>
                        </tr>
                        <?php endif?>
                    <?php endforeach;?>
                </tbody>
            
            </table>
            </div>
            <div class="mt-4 col-md-4 ">
                    <div class="row justify-content-center">
                        <img src="<?php echo base_url()?>lib/images/facebook.jpg">
                    </div>
                    <div class="row justify-content-center">
                    <input type="file" id="JobID" name="jobImage">
                </div>
            </div>
        </div>
        <label for="thumbnailTextID" class="text-muted  mt-4">Briefs text for thumbnail: </label>
        <textarea name="thumbnailText" id="thumbnailTextID" class="form-control" row="3"><?php if($job['ThumbnailText']== NULL){ echo 'Enter text for thumbnail';} else {echo $job['ThumbnailText'];};?></textarea>
        <div class="mt-5">
            <textarea name="editor1"><?php if($job['Editor1']==NULL){ echo 'Enter the text for job'; } else { echo $job['Editor1'] ;}?></textarea>
        </div>
        <div class="text-right pt-3">
            <h4><u><a class="font-weight-bold">Back To Jobs</a></u></h4>
        </div>
        <div class="row justify-content-center">
        <input type="submit" value="Publish" class="col-md-3 col-6 btn btn-outline-dark mt-3"/>
        </div>
    </form>
</div>
<hr class="border border-dark"/>
<div class="container">
<div style="overflow:auto">
    <table class="table border-bottom border-dark">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Candidate Name</th>
        <th scope="col">Contact Number</th>
        <th scope="col">Email</th>
        <th scope="col">Hours working</th>
        <th scope="col">Job Type</th>
        <th scope="col">Rate</th>
        <th scope="col">EmployeeRating</th>
        <th scope="col">Total Earned</th>
        <th scope="col">Address</th>
        </tr>
    </thead>
    <form action ="#" method="post">
    <tbody class="align-items-center">
        <tr>
        <th scope="row" class="p-1">
            <input type="button" class="btn btn-danger align-items-center" name="removeCandidateFromJob" style="border-radius:5px;margin:4px 2px;height:36px; width=20px;text-align: center;" value="X">
        </th>
        <td>#CandidateName</td>
        <td>#CandidateContact</td>
        <td>#CandidateEmail</td>
        <td><input type="text" class="form-control p-1" value="#CandidateHoursWorked"></td>
        <td>#JobType</td>
        <td><input type="text" class="form-control p-1" value="#JobRate"></td>
        <td><input type="text" class="form-control p-1" value="#EmployeeRating"></td>
        <td>#TOTALEarned rate * hoursworked readonly</td>
        <td>#</td>
        </tr>
    </tbody>
    <input type="submit" name="applyChanges" hidden>
    </form>
    </table>
    </div>
    <div class="row justify-content-center">
    <a href="<?php echo base_url()?>.index.php/personcenter/#/PARAM" class="btn btn-info my-3 col-md-3 col-6 text-center">Assign Candidate</a>
    </div>
</div>
<?php else: redirect('/');?>
        
    <?php endif; ?>






    
</div>
<script>
    CKEDITOR.replace( 'editor1' );
</script>

