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
        <div class="col-xl-6 col-m-12">
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
                    <h6 class="m-0 font-weight-bold" style="color: white">PLAN INCLUSIONS</h6>
                </div>
                <div class="card-body">
                    <?php foreach($plansdata as $plansd): ?>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">PLAN</label>
                                <input type="text" class="form-control"
                                    name="iptplan" placeholder="Plan" style="color: black;"
                                    value="<?= $plansd['name']; ?>" disabled>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">SPEED <span style="color: red;">(MBPS)</span></label>
                                <input type="number" class="form-control"
                                    name="iptspeed" placeholder="Speed" style="color: black;"
                                    value="<?= $plansd['speed']; ?>" disabled>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">PRICE</label>
                                <input type="text" class="form-control"
                                    name="iptprice" placeholder="Price" style="color: black;"
                                    value="<?= $plansd['price']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">DESCRIPTION</label>
                                <textarea class="form-control form-control" rows="4" cols="50"
                                    name="iptdescription" placeholder="Description" style="color: black;" disabled><?= $plansd['description']; ?></textarea>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label class="custom-label" for="username" style="color: black;">REQUIREMENTS</label>
                                <textarea class="form-control form-control" rows="4" cols="50"
                                    name="iptrequirements" placeholder="Requirements" style="color: black;" disabled><?= $plansd['requirements']; ?></textarea>    
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <br>
                    <h5 style="color: black;"><strong>INCLUSIONS</strong></h5>
                    <div class="table-responsive" style="color: black;">
                        <table class="table table-bordered" width="100%" cellspacing="0" style="color: black;">
                            <thead>
                                <tr style="background-color: #263A56; color: white;">
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($bundlesdata as $bundlesd): ?>
                                    <?php $INCLUSIONID = $bundlesd['inclusionid']; ?>
                                    <?php foreach($inclusionsdata as $inclusionsd): ?>
                                        <?php if($INCLUSIONID == $inclusionsd['inclid']): ?>
                                        <tr>
                                            <td><?= $inclusionsd['name']; ?></td>
                                            <td><?= $inclusionsd['description']; ?></td>
                                            <td>
                                            <button class="btn btn-danger btn-sm" title="Add Inclusion"
                                                onclick="window.location.href='<?= base_url(); ?>plans/inclusions-delete/<?= $plansd['planid']; ?>/<?= $inclusionsd['inclid']; ?>'">
                                                <i class="fas fa-fw fa-minus"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <?php else: ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-icon-split" title="Back"
                        onclick="window.location.href='<?= base_url(); ?>plans'">
                        <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                        <span class="text">BACK</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-m-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color: #263A56">
                    <h6 class="m-0 font-weight-bold" style="color: white">ADD INCLUSIONS</h6>
                </div>
                <div class="card-body">
                    <!-- <h5 style="color: black;"><strong>INCLUSIONS</strong></h5> -->
                    <div class="table-responsive" style="color: black;">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="color: black;">
                            <thead>
                                <tr style="background-color: #263A56; color: white;">
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($inclusionsdata as $inclusionsd): ?>
                                    <tr>
                                        <td><?= $inclusionsd['name']; ?></td>
                                        <td><?= $inclusionsd['description']; ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" title="Add Inclusion"
                                                onclick="window.location.href='<?= base_url(); ?>plans/inclusions-add/<?= $plansd['planid']; ?>/<?= $inclusionsd['inclid']; ?>'"
                                                <?php 
                                                    foreach($bundlesdata as $bundlesd){
                                                        if($inclusionsd['inclid'] == $bundlesd['inclusionid']){echo 'disabled';}else{}
                                                    }
                                                ?>>
                                                <i class="fas fa-fw fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<!-- END OF CODE HERE -->

<?php echo $this->endSection(); ?>                