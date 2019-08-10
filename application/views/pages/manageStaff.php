<div id="app">
<div style="height: 50px;"></div>

<h2 class="text-center"><?php echo $title; ?></h2>
<hr />
<!-- <p>Welcome back, <?php echo $firstName; ?>!</p>
<p>Your cannot see this page without login.</p> -->

<div class="container mb-5 p-md-5">
<?php if($userType == 'admin'):?>
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active text-dark font-weight-bold" id="addStaff-tab" data-toggle="tab" href="#addStaff" role="tab" aria-controls="addStaff" aria-selected="true"> Add Staff</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark font-weight-bold" id="changeStaffPassword-tab" data-toggle="tab" href="#changeStaffPassword" role="tab" aria-controls="changeStaffPassword" aria-selected="false">Change staff's password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark font-weight-bold" id="removeStaff-tab" data-toggle="tab" href="#removeStaff" role="tab" aria-controls="removeStaff" aria-selected="false">Remove Staff</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="addStaff" role="tabpanel" aria-labelledby="addStaff-tab">
        <?php 
        $this->load->view('staffManager/addStaff',$staffs) ;?>
        </div>
        <div class="tab-pane fade" id="changeStaffPassword" role="tabpanel" aria-labelledby="changeStaffPassword-tab">
        <?php
        $this->load->view('staffManager/changeStaffPassword'); ?>
        </div>
        <div class="tab-pane fade" id="removeStaff" role="tabpanel" aria-labelledby="removeStaff-tab">
        <?php 
        $this->load->view('staffManager/removeStaff'); ?>
        
        </div>
        </div>
        

    </div>
    <div style="overflow:auto">
      <table class="table mt-5 table-hover" >
        <thead>
          <tr>
            <th scope="col">
            <a style="color:black" href="#" @click.stop.prevent="sortBy('id')">User ID<div class="d-md-inline d-none"><i class="ml-1 icon ion-md-arrow-dropdown"></i><i class="icon ion-md-arrow-dropup"></i></div></a></th>
            <th scope="col"><a style="color:black" href="#" @click.stop.prevent="sortBy('email')">Email<div class="d-md-inline d-none"><i class="ml-1 icon ion-md-arrow-dropdown"></i><i class="icon ion-md-arrow-dropup"></i></div></a></th>
            <th scope="col"><a style="color:black" href="#" @click.stop.prevent="sortBy('firstName')">FirstName<div class="d-md-inline d-none"><i class="ml-1 icon ion-md-arrow-dropdown"></i><i class="icon ion-md-arrow-dropup"></i></div></a></th>
            <th scope="col"><a style="color:black" href="#" @click.stop.prevent="sortBy('lastName')">LastName<div class="d-md-inline d-none"><i class="ml-1 icon ion-md-arrow-dropdown"></i><i class="icon ion-md-arrow-dropup"></i></div></a></th>
            <th scope="col"><a style="color:black" href="#" @click.stop.prevent="sortBy('city')">City<div class="d-md-inline d-none"><i class="ml-1 icon ion-md-arrow-dropdown"></i><i class="icon ion-md-arrow-dropup"></i></div></a></th>
            <th scope="col"><a style="color:black" href="#" @click.stop.prevent="sortBy('address')">Address<div class="d-md-inline d-none"><i class="ml-1 icon ion-md-arrow-dropdown"></i><i class="icon ion-md-arrow-dropup"></i></div></a></th>
            <th scope="col"><a style="color:black" href="#" @click.stop.prevent="sortBy('phoneNumber')">PhoneNumber<div class="d-md-inline d-none"><i class="ml-1 icon ion-md-arrow-dropdown"></i><i class="icon ion-md-arrow-dropup"></i></div></a></th>
          </tr>
        </thead>
        <tbody >  
          <tr v-for="staff in staffs" :key="staff.id">
            <th  v-text="staff.id"></th>
            <td v-text="staff.email"></td>
            <td v-text="staff.firstName"></td>
            <td v-text="staff.lastName"></td>
            <td v-text="staff.city"></td>
            <td v-text="staff.address"></td>
            <td v-text="staff.phoneNumber"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <?php else: redirect('/');?>
        
    <?php endif; ?>


</div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModal2Label">Action {{ errMessage }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>{{ errors2 }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal END -->
    
</div>
    <?php if(strlen($message)>0):?>
        <script type='text/javascript'>alert('Wrong administrator password, Failure in removing staff');</script>
    <?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>


<script>
    var app = new Vue({
        el: '#app',
        data: {
            errors: "Password did not match, failed to update new staff into database",
            errors2: "Password did not match, failed to update staff's password into database",
            confirmPassword: "",
            password: "",
            updateStaffPassword: "",
            confirmUpdate: "",
            errMessage: "Failed",
            toggle: true,
            staffs: [
              <?php foreach ($staffs as $staff): ?>
            {id: "<?php echo $staff['UserID']; ?>",
            email: "<?php echo $staff['Email']; ?>",
            firstName: "<?php echo $staff['FirstName']; ?>",
            lastName: "<?php echo $staff['LastName']; ?>",
            city: "<?php echo $staff['City']; ?>",
            address: "<?php echo $staff['Address']; ?>",
            phoneNumber: "<?php echo $staff['PhoneNumber']; ?>"},
      <?php endforeach; ?>
            ]
        },
        methods: {
            checkForm: function(e){
                if(this.confirmPassword == this.password){
                    return true
                } else {
                    // this.errors = "Password did not match, failed to update new staff into database"
                    // this.errMessage = "Failed"
                    e.preventDefault();
                    $('#exampleModal').modal('show')
                }
            },
            sortBy: function(sortKey) {
              if(sortKey == 'id'){
                this.toggle = !this.toggle
                if(this.toggle){
                  this.staffs.sort(function(a,b){return a.id - b.id})
                } else {
                  this.staffs.sort(function(a,b){return b.id - a.id})
                }
              } else if (sortKey == 'email'){
                this.toggle = !this.toggle
                if(this.toggle){
                this.staffs.sort(function(a,b){return a.email.localeCompare(b.email)})
                }
                else {
                  this.staffs.sort(function(a,b){return b.email.localeCompare(a.email)})
                }
              } else if(sortKey == 'firstName'){
                this.toggle = !this.toggle
                if(this.toggle){
                this.staffs.sort(function(a,b){return a.firstName.localeCompare(b.firstName)})
                } else {
                  this.staffs.sort(function(a,b){return b.firstName.localeCompare(a.firstName)})
                }
              } else if(sortKey == 'lastName') {
                this.toggle = !this.toggle
                if(this.toggle){
                  this.staffs.sort(function(a,b){return a.lastName.localeCompare(b.lastName)})
                } else {
                  this.staffs.sort(function(a,b){return b.lastName.localeCompare(a.lastName)})
                }
              } else if(sortKey == 'city'){
                this.toggle = !this.toggle
                if(this.toggle){
                  this.staffs.sort(function(a,b){return a.city.localeCompare(b.city)})
                } else {
                  this.staffs.sort(function(a,b){return b.city.localeCompare(a.city)})
                }
              } else if(sortKey == 'address'){
                this.toggle = !this.toggle
                if(this.toggle){
                  this.staffs.sort(function(a,b){return a.address.localeCompare(b.address)})
                } else {
                  this.staffs.sort(function(a,b){return b.address.localeCompare(a.address)})
                }
              } else if(sortKey == 'phoneNumber'){
                this.toggle = !this.toggle
                if(this.toggle){
                  this.staffs.sort(function(a,b){return a.localeCompare(b.phoneNumber)})
                } else {
                  this.staffs.sort(function(a,b){return b.localeCompare(a.phoneNumber)})
                }
              }
            },
            checkForm2: function(n){
              if(this.updateStaffPassword == this.confirmUpdate){
                return true
              } else {
                n.preventDefault();
                $('#exampleModal2').modal('show')
              }
            }
        }
        
    })
    
</script>

