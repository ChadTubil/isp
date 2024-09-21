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
        <div class="col-xl-12 col-m-12">
            <?php if(isset($validation)): ?>
                <div class="card bg-danger text-white shadow">
                    <div class="card-body" style="text-align: left;">
                        <?= validation_list_errors() ?>
                    </div>
                </div>
                <br>
            <?php endif; ?>
            <?php if(session()->getTempdata('success')): ?>
                <div class="card bg-success text-white shadow">
                    <div class="card-body" style="text-align: left;">
                        <?= session()->getTempdata('success') ?>
                    </div>
                </div>
                <br>
            <?php endif; ?>
            <?php if(session()->getTempdata('error')): ?>
                <div class="card bg-danger text-white shadow">
                    <div class="card-body" style="text-align: left;">
                        <?= session()->getTempdata('error') ?>
                    </div>
                </div>
                <br>
            <?php endif; ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color: #263A56">
                    <h6 class="m-0 font-weight-bold" style="color: white">ADD EMPLOYEE</h6>
                </div>
                <div class="card-body">
                    <?= form_open('employees/add', ['class' => 'user']); ?>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">EMPLOYEE NUMBER</label>
                                <input type="text" class="form-control form-control"
                                    name="iptempnum" placeholder="Employee Number" style="color: black;">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 mb-12 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">LAST NAME</label>
                                <input type="text" class="form-control form-control"
                                    name="iptlastname" placeholder="Lastname" style="color: black;">
                            </div>
                            <div class="col-sm-4 mb-12 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">FIRST NAME</label>
                                <input type="text" class="form-control form-control"
                                    name="iptfirstname" placeholder="Firstname" style="color: black;">
                            </div>
                            <div class="col-sm-3 mb-12 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">MIDDLE NAME</label>
                                <input type="text" class="form-control form-control"
                                    name="iptmiddlename" placeholder="Middlename" style="color: black;">
                            </div>
                            <div class="col-sm-2 mb-12 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">EXTENSION</label>
                                <input type="text" class="form-control form-control"
                                    name="iptext" placeholder="Extention" style="color: black;">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-12 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">HIRING DATE</label>
                                <input type="date" class="form-control form-control"
                                    name="ipthiring" placeholder="Lastname" style="color: black;">
                            </div>
                            <div class="col-sm-5 mb-12 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">POSITION</label>
                                <select name="iptposition" class="form-control"
                                    style="color: black;">
                                    <?php foreach($positionsdata as $posd): ?>
                                        <option value="<?= $posd['posid']; ?>"><?= $posd['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-icon-split" type="submit" name="add">
                        <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                        <span class="text">SAVE</span>
                    </button>
                    <?= form_close(); ?>
                    <button class="btn btn-danger btn-icon-split" title="Cancel"
                        onclick="window.location.href='<?= base_url(); ?>employees'">
                        <span class="icon text-white-50"><i class="fas fa-ban"></i></span>
                        <span class="text">CANCEL</span>
                    </button>
                </div>
                
            </div>
        </div>
    </div>
    

<!-- END OF CODE HERE -->

<?php echo $this->endSection(); ?>                