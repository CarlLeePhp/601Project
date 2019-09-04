<div id="app">
    <div style="height: 50px;"></div>

    <h2 class="text-center">New Applicants</h2>
    <hr />

    <button type="button" @click="showRemoveTab" style="position:fixed;right: 20px; bottom:25px;z-index:1" class="btn btn-outline-danger bg-danger">
        <img style="height:39px; width:35px;" src="<?php echo base_url()?>lib/images/papershreeder.png">
    </button>
        <ul class="nav nav-tabs flex-column flex-sm-row" id="myTab" role="tablist">
            <li class="nav-item  ml-auto text-sm-center">
                <a class="nav-link active text-dark font-weight-bold" id="lastclients-tab" data-toggle="tab" href="#lastclients" role="tab" aria-controls="lastclients" aria-selected="true">Last Clients <span class="badge badge-primary ml-1" v-text="uncheckedJobsCount"></span></a>
            </li>
            <li class="nav-item  mr-auto text-sm-center">
                <a class="nav-link text-dark font-weight-bold" id="lastcondidates-tab" data-toggle="tab" href="#lastcondidates" role="tab" aria-controls="lastcondidates" aria-selected="false">Last Candidates<span class="badge badge-primary ml-1" v-text="uncheckedCandidateCount"></span></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">