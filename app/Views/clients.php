<?php $this->extend("layouts/base"); ?>
<?php $this->section("title"); ?>
    <?php echo $page_title; ?>
<?php $this->endSection(); ?>
<?php $this->section("heading"); ?>
    <?php echo $page_heading; ?>
<?php $this->endSection(); ?>

<?php echo $this->section('content'); ?>

<!-- CODE START HERE -->
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
            <h6 class="m-0 font-weight-bold" style="color: white;">CLIENTS</h6>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-0"></div>
                <div class="col-sm-8 mb-3 mb-sm-0">
                    <?= form_open('clients', ['class' => 'navbar-search']); ?>
                        <div class="input-group">
                            <input type="text" class="form-control border-1" placeholder="SEARCH CLIENT"
                            aria-label="Search" style="color: black; border-color: #263A56;"
                            name="searchclient">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" style="background-color: #263A56; border-color: #263A56;">
                                    <i class="fas fa-search fa-sm"></i> SEARCH
                                </button>
                            </div>
                        </div>
                    <?= form_close(); ?>
                </div>
                <div class="col-sm-2 mb-3 mb-sm-0"></div>
            </div>
            <div class="table-responsive" style="color: black;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="color: black;">
                    <thead>
                        <tr style="background-color: #263A56; color: white;">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Plan</th>
                            <th>Account</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($clientdata as $clientd): ?>
                            <tr>
                                <td><?= $clientd['clientid']; ?></td>
                                <td><?= $clientd['fullname']; ?></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center;">
                                    <button class="btn btn-primary btn-sm" title="Process"
                                    onclick="window.location.href='<?= base_url(); ?>clients/process/<?= $clientd['clientid']; ?>'">
                                        <i class="fas fa-fw fa-circle-notch"></i>
                                    </button>
                                    <button class="btn btn-info btn-sm" title="Edit"
                                    onclick="window.location.href='<?= base_url(); ?>clients/edit/<?= $clientd['clientid']; ?>'">
                                        <i class="fas fa-fw fa-pen"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" title="Delete"
                                        onclick="window.location.href='<?= base_url(); ?>clients/delete/<?= $clientd['clientid']; ?>'">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- END OF CODE HERE -->

<?php echo $this->endSection(); ?>                