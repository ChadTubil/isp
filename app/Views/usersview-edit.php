<?php $this->extend("layouts/base"); ?>
<?php $this->section("title"); ?>
    <?php echo $page_title; ?>
<?php $this->endSection(); ?>
<?php $this->section("heading"); ?>
    <?php echo $page_heading; ?>
<?php $this->endSection(); ?>

<?php echo $this->section('content'); ?>

<!-- CODE START HERE -->
    <div class="row">
        <div class="col-xl-7 col-m-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color: #263A56">
                    <h6 class="m-0 font-weight-bold" style="color: white">Add User</h6>
                </div>
                <div class="card-body">
                <?php foreach($usersedit as $usere): ?>
                    <?= form_open('users/edit/'.$usere['uid'], ['class' => 'user']); ?>
                        
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="custom-label" for="username" style="color: black;">USERNAME</label>
                                    <input type="text" class="form-control form-control-user" id="username"
                                        name="user" placeholder="Username" style="color: black;" value="<?= $usere['username']; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="custom-label" for="password" style="color: black;">PASSWORD</label>
                                    <input type="text" class="form-control form-control-user" id="password"
                                        name="pass" placeholder="Password" style="color: black;" value="<?= $usere['password']; ?>">
                                </div>
                            </div>
                            <br>
                            <h5 style="color: black;"><strong>ACCESS</strong></h5>
                            <div class="form-group row">
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="adminCheck" name="chkadmin" 
                                        value="1" 
                                            <?php if($usere['admin'] == 1) {
                                                echo 'checked';
                                            }else{}; ?>
                                        >
                                        <label class="custom-control-label" for="adminCheck" style="color: black;">ADMINISTRATION</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="cashierCheck" name="chkcashier" 
                                        value="1"
                                            <?php if($usere['cashier'] == 1) {
                                                echo 'checked';
                                            }else{}; ?>
                                        >
                                        <label class="custom-control-label" for="cashierCheck" style="color: black;">CASHIER</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="staffCheck" name="chkstaff" 
                                        value="1"
                                            <?php if($usere['staff'] == 1) {
                                                echo 'checked';
                                            }else{}; ?>
                                        >
                                        <label class="custom-control-label" for="staffCheck" style="color: black;">STAFF</label>
                                    </div>
                                </div>
                            </div>
                        
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-icon-split" type="submit" name="add">
                        <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                        <span class="text">SAVE</span>
                    </button>
                    <?= form_close(); ?>
                    <?php endforeach; ?>
                    <button class="btn btn-danger btn-icon-split" title="Cancel"
                        onclick="window.location.href='<?= base_url(); ?>users'">
                        <span class="icon text-white-50"><i class="fas fa-ban"></i></span>
                        <span class="text">CANCEL</span>
                    </button>
                </div>
                
            </div>
        </div>
    </div>
    

<!-- END OF CODE HERE -->

<?php echo $this->endSection(); ?>                