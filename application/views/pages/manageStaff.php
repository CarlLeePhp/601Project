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
        <?php echo $message?>

    </div>
    <div style="overflow:auto">
      <table class="table mt-5" >
        <thead>
          <tr>
            <th scope="col"><a href="#" @click.stop.prevent="sortBy('id')">userID</a></th>
            <th scope="col"><a href="#" @click.stop.prevent="sortBy('email')">Email</a></th>
            <th scope="col"><a href="#" @click.stop.prevent="sortBy('firstName')">FirstName</a></th>
            <th scope="col"><a href="#" @click.stop.prevent="sortBy('lastName')">LastName</a></th>
            <th scope="col"><a href="#" @click.stop.prevent="sortBy('city')">City</a></th>
            <th scope="col"><a href="#" @click.stop.prevent="sortBy('address')">Address</a></th>
            <th scope="col"><a href="#" @click.stop.prevent="sortBy('phoneNumber')">PhoneNumber</a></th>
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

    <!-- Modal END -->

</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            errors: "Password did not match, failed to update new staff into database",
            confirmPassword: "",
            password: "",
            errMessage: "Failed",
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
                this.staffs.sort(function(a,b){return a.id - b.id})
              } else if (sortKey == 'email'){
                console.log("email")
                this.staffs.sort(function(a,b){return a.email.localeCompare(b.name)})
              } else if(sortKey == 'firstName'){
                this.staffs.sort(function(a,b){return a.firstName.localeCompare(b.firstName)})
              } else if(sortKey == 'lastName') {
                this.staffs.sort(function(a,b){return a.lastName.localeCompare(b.lastName)})
              } else if(sortKey == 'city'){
                this.staffs.sort(function(a,b){return a.city.localeCompare(b.city)})
              } else if(sortKey == 'address'){
                this.staffs.sort(function(a,b){return a.address.localeCompare(b.address)})
              } else if(sortKey == 'phoneNumber'){
                this.staffs.sort(function(a,b){return a.localeCompare(b.phoneNumber)})
              }
            }
        }
        
    })
    
</script>

