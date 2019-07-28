<div class="container mb-5">
<div class="row">
<div class="nav flex-column nav-pills mt-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="text-dark nav-link customPane border-top border-dark <?php echo $active1 ?>"
   style="border-radius:0px;" id="v-pills-emission-tab" data-toggle="pill" href="#v-pills-emission" 
   role="tab" aria-controls="v-pills-emission" aria-selected="">Our Mission</a>

  <a class="text-dark nav-link customPane border-top border-bottom border-dark <?php echo $active2 ?>" 
    style="border-radius:0px;" id="v-pills-service-tab" data-toggle="pill" href="#v-pills-service" 
    role="tab" aria-controls="v-pills-service" aria-selected="">Associated Services</a>

    <a class="text-dark nav-link customPane border-top border-bottom border-dark <?php echo $active3 ?>" 
    style="border-radius:0px;" id="v-pills-submitVacancy-tab" data-toggle="pill" href="#v-pills-submitVacancy"
    role="tab" aria-controls="v-pills-submitVacancy" aria-selected="">Submit Vacancy</a>
  </div>
    <div class="col tab-content p-0" id="v-pills-tabContent">
    <div class="tab-pane fade show <?php echo $active1?>" id="v-pills-emission" role="tabpanel" aria-labelledby="v-pills-emission-tab">
 
        <div class="container m-md-5">
            <span class="display-4">Employers</span>
            <hr>
            <div class="col-12">
            
            <h3 class="text-warning font-weight-bold ">Need a short term staff to complete a project?</h3>
            <p>Let us help!</p>
            <p>We can provide suitably skilled people at short notice.This can be for 1 day or much longer. <br>
                We take care of all the normal employment costs including: Wages, ACC, PAYE, Holiday pay, Statutory Holiday Pay, Sick Pay and Employer Kiwisaver Contributions. You simply get a weekly invoice for an agreed hourly rate. </p>
        
                <h3 class="text-warning font-weight-bold ">Need permanent employees?</h3>
            
            <p>Recruiting good staff can take a vast amount of time. 
                At Lee Recruitment we can take care of this by searching and shortlisting quality applicants that suit your role and your company culture. 
                Talk to us about your business and your requirements. Our aim is to partner with you to provide employment solutions that fit your company needs.
                 We know every company is different so tell us about yourselves. </p>
        
                <h3 class="text-warning font-weight-bold ">Skills Shortage</h3>
            <p>Have a difficult to fill role?</p>
            <p>We search 'near and far' for suitable candidates in 'hard to fill' industries such as trades and professional engineers.
     Both passive and active candidates register with us to ensure they receive opportunities as they arise. </p>
        
            </div>
            

            <div class="text-center">
        <a href="<?php echo base_url() ?>EmployerMission/index/3">
        <input type="button" class="btn btn-secondary" value="Submit your vacancy"/>
        </a>
            </div>
        </div>
     <!--end of container-->
    </div> <!--endOfPane-->
    <!-- startOfPane service -->
    <div class="tab-pane fade show <?php echo $active2?>" id="v-pills-service" role="tabpanel" aria-labelledby="v-pills-service-tab">
    <div class="container m-md-5">
            <span class="display-4">Associated Service</span>
            <hr>
            <div class="col-12">
            
            <h3 class="text-warning font-weight-bold ">Health and Safety Compliance</h3>
            <p class="font-weight-bold">Find your business's path to healthier and safer future with Lee Consulting.</p>
            <p>Locally owned and operated here in Southland, Lee Consulting specialises in Health and Safety compliance.
                Our clients are wide-ranging from industrial trades-based businesses to local government. 
                We have the skills and experience to create a Health and Safety Management System (HSMS) specific to your business,
                 no matter how big or small, and ongoing support to help you make the most out of it. </p>
                
            <p>With the Health and Safety at Work Act 2015 (HSWA) the new responsibilities were introduces for managing the work-related risks that could cause serious injury, illness or even death. 
                HSWA recognises that to improve the health and safety performance we all need to work together.
                Government, businesses and workers must establish better leadership, participation in, and accountability for people's health and safety.</p>
        
             
            <p>Everyone who goes to work should come home healthy and safe. 
            To achieve this, HSWA provides a new way of thinking and Lee Consulting will help you understand it 
            and implement it to your business. </p>

            <p class="font-weight-bold">Our Approach is to:</p>
            <ul>
                <li><b>Listen</b> - to what you actually want to achieve.</li>
                <li><b>Evaluate</b> - your existing HSMS if any, process, procedures etc.</li>
                <li><b>Recommend solutions</b> - to comply with the relevant legislations and HSWA.</li>
                <li><b>Develop and Implement</b> - the solution that was agreed on e.g. the whole HSMS or some of its components.</li>
                <li><b>Communicate, Support & provide Training</b> - throughout the whole process.</li>
           </ul>

           To read more about Lee Consulting Ltd please <a href="http://www.leeconsulting.co.nz/">Click here.</a>
            </div>
    </div>

    
</div> <!--endOfPane-->

<div class="tab-pane fade show <?php echo $active3?>" id="v-pills-submitVacancy" role="tabpanel" aria-labelledby="v-pills-submitVacancy-tab">
    <div class="container m-md-5">
            <span class="display-4">SubmitVacancy</span>
            <hr>
            <div class="col-12">
            
            <form action="<?php echo base_url()?>TestControl/index/" class="m-md-5" method="POST">
            <div class="row">
                <div class="col-2 p-0">
                <label for="clientTitleID" class="font-weight-bold">Title</label>

                <select class="form-control p-2" type="text" name="clientTitle" id="clientTitleID" >
                    <option selected>-</option>
                    <option value="1">Mr.</option>
                    <option value="2">Mrs.</option>
                    <option value="3">Miss</option>
                    <option value="4">Ms.</option>
                    <option value="5">Dr.</option>
                </select>
                </div>
                <div class="col-5 px-1 px-md-4">
                <label for="clientNameID" class="font-weight-bold">Contact Person:</label>
                <input type="text" placeholder="Enter Name" class="form-control" name="clientName" id="clientNameID" >
                </div>
                <div class="col-5 p-0">
                <label for="clientCompanyID" class="font-weight-bold">Company Name:</label>
                <input type="text" placeholder="Company Name" class="form-control" name="clientCompany" id="clientCompanyID" />
                </div>
                
            </div>
            <div class="row mt-3">
             <div class="col-12 p-0">
                 <label for="clientEmailID" class="font-weight-bold">Email:</label>
                 <input type="text" placeholder="Enter Email" class="form-control" name="clientEmail" id="clientEmailID" />
            </div>
            </div>
            <div class="row mt-3">
             <div class="col-12 p-0">
                 <label for="clientContactID" class="font-weight-bold">Contact Number:</label>
                 <input type="text" placeholder="Enter Contact Number" class="form-control" name="clientContact" id="clientContact" />
            </div>
            </div>
            <div class="row mt-3">
             <div class="col-4 col-md-3 pl-0">
                 <label for="clientCityID" class="font-weight-bold">City:</label>
                 <select class="form-control" type="text" name="clientCity" id="clientCityID" >
                    <option selected>-</option>
                    <option value="1">Dunedin</option>
                    <option value="2">Otago</option>
                    <option value="3">Invercargill</option>
                </select></div>
                <div class="col-md-9 col-8 pr-0">
                 <label for="clientAddressID" class="font-weight-bold">Address Number:</label>
                 <input type="text" placeholder="Enter Address Number" class="form-control" name="clientAddress" id="clientAddress" />
                </div>
            </div>
            <div class="row mt-3">
             <div class="col-6 pl-0">
                 <label for="clientJobTitleID" class="font-weight-bold">Job Title:</label>
                 <input type="text" placeholder="Enter Job Title" class="form-control" name="clientJobTitle" id="clientJobTitleID" />
                </div>
                <div class="col-6 pr-0">
                <label for="clientJobTypeID" class="font-weight-bold">Job Type:</label>
                 <select class="form-control " type="text" name="clientJobType" id="clientJobTypeID" >
                    <option selected>-</option>
                    <option value="1">Part Time</option>
                    <option value="2">Full Time</option>
                </select> </div>
                
            </div>
            <div class="row mt-3">
                <div class="col-12 p-0">
                    <div class="form-group">
                    <label for="descriptionID" class="font-weight-bold">Description:</label>
                    <textarea class="form-control" rows="5" name="description" id="descriptionID"></textarea>
                    </div>
                </div>
             </div>
             <div class="row">
            <input type="submit" value="Submit Vacancy" class="btn btn-primary m-0">
            </div> 
            </form>
        </div>
    </div>

    
</div>
</div>
    
</div>
</div>