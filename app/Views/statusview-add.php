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
                    <h6 class="m-0 font-weight-bold" style="color: white">ADD STATUS</h6>
                </div>
                <div class="card-body">
                    <?= form_open('status/add', ['class' => 'user']); ?>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">STATUS</label>
                                <input type="text" class="form-control form-control-user"
                                    name="iptstatus" placeholder="Status" style="color: black;">
                            </div>
                            <div class="col-sm-12">
                                <label class="custom-label" for="password" style="color: black;">DESCRIPTION</label>
                                <textarea class="form-control form-control" rows="4" cols="50"
                                name="iptdescription" placeholder="Description" style="color: black;"></textarea>
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
                        onclick="window.location.href='<?= base_url(); ?>status'">
                        <span class="icon text-white-50"><i class="fas fa-ban"></i></span>
                        <span class="text">CANCEL</span>
                    </button>
                </div>
                
            </div>
        </div>
    </div>
    

<!-- END OF CODE HERE -->

<?php echo $this->endSection(); ?>                