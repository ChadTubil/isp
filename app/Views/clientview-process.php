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
    <div class="col-xl-5 col-m-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #263A56">
                <h6 class="m-0 font-weight-bold" style="color: white">CLIENT</h6>
            </div>
            <div class="card-body">
                <?php foreach($clientdata as $clientd): ?>
                <div class="row">
                    <div class="col-xl-3 col-m-12">
                        <label class="custom-label" style="color: black;">CLIENT ID:&nbsp</label>
                    </div>
                    <div class="col-xl-9 col-m-12">
                        <h5 style="color: black"><strong><?= $clientd['clientid']; ?></strong></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-m-12">
                        <label class="custom-label" style="color: black;">NAME:&nbsp</label>
                    </div>
                    <div class="col-xl-9 col-m-12">
                        <h5 style="color: black"><strong><?= $clientd['fullname']; ?></strong></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-m-12">
                        <label class="custom-label" style="color: black;">EMAIL:&nbsp</label>
                    </div>
                    <div class="col-xl-9 col-m-12">
                        <h5 style="color: black"><strong><?= $clientd['email']; ?></strong></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-m-12">
                        <label class="custom-label" style="color: black;">MOBILE:&nbsp</label>
                    </div>
                    <div class="col-xl-9 col-m-12">
                        <h5 style="color: black"><strong><?= $clientd['mobile']; ?></strong></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-m-12">
                        <label class="custom-label" style="color: black;">ADDRESS:&nbsp</label>
                    </div>
                    <div class="col-xl-9 col-m-12">
                        <h5 style="color: black"><strong><?= $clientd['houseunitno']; ?> 
                        <?= $clientd['buildingname']; ?> <?= $clientd['villagesubdivision']; ?> <?= $clientd['street']; ?> 
                        <?= $clientd['barangay']; ?> <?= $clientd['city']; ?> <?= $clientd['province']; ?> <?= $clientd['zipcode']; ?>
                        </strong></h5>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-xl-7 col-m-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #263A56">
                <h6 class="m-0 font-weight-bold" style="color: white">PROCESS</h6>
            </div>
            <div class="card-body">
                <h5 style="color: black">Choose a plan:</h5>
                <div class="form-group row">
                    <?php foreach($plandata as $pland): ?>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <a class="btn" style="text-align: left;" 
                            href="<?= base_url(); ?>clients/process-1/<?= $pland['planid']; ?>/<?= $clientd['clientid']; ?>">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-s font-weight-bold text-primary text-uppercase mb-1"><?= $pland['speed']; ?> MBPS</div>
                                                <div class="h5 mb-0 font-weight-bold text-uppercase" style="color: black;"><?= $pland['name']; ?></div>
                                                <div class="text-s font-weight-bold text-danger text-uppercase mb-1">₱<?= $pland['price']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>    
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF CODE HERE -->

<?php echo $this->endSection(); ?>                