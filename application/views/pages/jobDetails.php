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
        </textarea>
    </div>
    </div>
</div>
<hr />
    <?php if( $job['JobStatus'] == 'published') :?>
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
<!-- EndHere -->
<hr class="border border-dark"/>
<div class="container-fluid">
<div style="overflow:auto">
        <div  id="ajax-content">
        <table class="table border-bottom border-dark"><thead>
        <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <!-- <th scope="col">UndoSession</th> -->
        <th scope="col">Candidate Name</th>
        <th scope="col">Contact Number</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Job Type</th>
        <th scope="col">Hours working</th>
        <th scope="col">Job Rates</th>
        <th scope="col">Total Earned</th>
        <th scope="col">Employee Notes</th>
        </tr>
    	</thead><tbody class="align-items-center">
        <?php foreach ($candidatesData as $candidateData):?>
        <?php $savedCandidateEarnings[$candidateData['CandidateID']] = $candidateData['CandidateEarnings'];?>
        <?php $savedWorkRate[$candidateData['CandidateID']] = $candidateData['JobRate'];?>
        <?php $savedHoursWorked[$candidateData['CandidateID']] = $candidateData['CandidateHoursWorked'];?>
        <form>
        <tr id="targetRow<?php echo $candidateData['CandidateID'];?>"><th scope="row">
        <a onclick="removeAssignedCandidate(<?php echo $candidateData['CandidateID']?>)" class="text-danger"><i style="font-size:25px" class="icon ion-md-close-circle"></i> </a></th>
        <td><a onclick="resetCandidateData(<?php echo $candidateData['CandidateID']?>,<?php echo $savedHoursWorked[$candidateData['CandidateID']] ;?>)" class="text-secondary" ><i style="font-size:25px" class="icon ion-md-trash"></i></a></td>
        <td><?php echo $candidateData['FirstName'] . ' ' . $candidateData['LastName'];?></td>
        <td><?php echo $candidateData['PhoneNumber'];?></td>
        <td><?php echo $candidateData['Email'];?></td>
		<td><?php echo $candidateData['Address'];?></td>
        <td><?php echo $candidateData['jobType'];?></td>
        
		<td><input type="text" id="hoursWorked<?php echo $candidateData['CandidateID']?>" onchange="updateHoursWorked(<?php echo $candidateData['CandidateID']?>,<?php echo $savedHoursWorked[$candidateData['CandidateID']] ;?>)" placeholder="<?php echo $candidateData['CandidateHoursWorked'];?>"></td>
		<td><input type="text" id="jobRate<?php echo $candidateData['CandidateID']?>" onchange="updateJobRate(<?php echo $candidateData['CandidateID']?>,<?php echo $savedHoursWorked[$candidateData['CandidateID']] ;?>)" placeholder="<?php echo $candidateData['JobRate'];?>"></td>
        <td><input type="text" class="border-0" id="candidateEarnings<?php echo $candidateData['CandidateID']?>" value="<?php printf('%.2f',$candidateData['CandidateEarnings']);?>"> </td>
        <td><input type="text" id="candidateNotes<?php echo $candidateData['CandidateID']?>" onchange="updateCandidateNotes(<?php echo $candidateData['CandidateID']?>,<?php echo $savedHoursWorked[$candidateData['CandidateID']] ;?>)" placeholder="<?php echo $candidateData['CandidateNotes'];?>"></td>
        </tr>
        </form>
        
        <?php endforeach;?>    
    </tbody>
    </table>
    
    </div> <!--ajaxContentEnd-->
</div>
   
</div>
    <div class="row justify-content-center">
        <a class="col-md-3 col-6 btn btn-info my-5">Assign Candidate </a>
    </div>
<?php else: redirect('/');?>
        
<?php endif; ?>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<script>
    CKEDITOR.replace( 'editor1' );
</script>
<script>
    
var xRequest = new XMLHttpRequest();
function updateHoursWorked($candidateID,$workingHoursSaved) {
        var hoursWorked = document.getElementById('hoursWorked'+$candidateID).value;
        if(hoursWorked){
            if(isNaN(hoursWorked)){ alert('You cant enter a text for this field, please enter a number')} else {
            var the_data = 'candidateID='+$candidateID+'&hoursWorked='+hoursWorked+'&workingHoursSaved='+$workingHoursSaved;
            xRequest.open("POST",'<?php echo base_url()?>index.php/Jobs/updateHoursWorked/'+$candidateID,true)
            xRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
                xRequest.send(the_data);
                xRequest.onload = function(){
                        document.getElementById('targetRow'+$candidateID).innerHTML = xRequest.responseText;
                };
            };
        }
    }

function updateJobRate($candidateID,$workingHoursSaved) {
    var jobRate = document.getElementById('jobRate'+$candidateID).value;
    if(jobRate){
        if(isNaN(jobRate)){ alert('You cant enter a text for this field, please enter a number')} else {
        var the_data = 'jobRate='+jobRate+'&workingHoursSaved='+$workingHoursSaved;
        
        xRequest.open("POST",'<?php echo base_url()?>index.php/Jobs/updateJobRate/'+$candidateID,true)
        xRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
            xRequest.send(the_data);
            xRequest.onload = function(){
                document.getElementById('targetRow'+$candidateID).innerHTML = xRequest.responseText;
            };
        };
    }
}

function updateCandidateNotes($candidateID,$workingHoursSaved){
    var the_data = 'candidateNotes='+document.getElementById('candidateNotes'+$candidateID).value+'&workingHoursSaved='+$workingHoursSaved;

    xRequest.open("POST",'<?php echo base_url()?>index.php/Jobs/updateCandidateNotes/'+$candidateID+'/'+'jobDetails',true)
    xRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xRequest.send(the_data);
    xRequest.onload = function(){
        document.getElementById('targetRow'+$candidateID).innerHTML = xRequest.responseText;
    };
}

function removeAssignedCandidate($candidateID){
    var the_data = 'candidateID='+$candidateID;
    xRequest.open("POST","<?php echo base_url()?>index.php/Jobs/removeAssignedCandidate/"+$candidateID+"/<?php echo $job['JobID'];?>",true)
    
    xRequest.send(the_data);
    xRequest.onload = function(){
        document.getElementById('ajax-content').innerHTML = xRequest.responseText;
    };
}

function resetCandidateData($candidateID,$workingHoursSaved){
    var the_data = 'workingHoursSaved='+$workingHoursSaved;
    xRequest.open("POST","<?php echo base_url()?>index.php/Jobs/resetCandidateData/"+$candidateID,true)
    xRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xRequest.send(the_data);
    xRequest.onload = function(){
        document.getElementById('targetRow'+$candidateID).innerHTML = xRequest.responseText;
    };
}
</script>