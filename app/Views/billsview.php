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
            <h6 class="m-0 font-weight-bold" style="color: white;">LIST OF ALL BILLS</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="color: black;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="color: black;">
                    <thead>
                        <tr style="background-color: #263A56; color: white;">
                            <th>SOA</th>
                            <th>ACCOUNT</th>
                            <th>BILL NO</th>
                            <th>STATUS</th>
                            <th style="text-align: center;">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($billsdata as $billsd): ?>
                            <tr>
                                <td><?= $billsd['soano']; ?></td>
                                <td><?= $billsd['accountid']; ?></td>
                                <td><?= $billsd['billno']; ?></td>
                                <td>
                                    <?php 
                                        if($billsd['status'] == '0'){
                                            echo "PENDING";
                                        }else{
                                            echo "PAID";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info btn-primary" title="View"
                                        onclick="window.location.href='<?= base_url(); ?>bills/view/<?= $billsd['billsid']; ?>'"
                                        style="color: #263A56">
                                        <i class="fas fa-fw fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-info btn-warning" title="Print"
                                        onclick="window.location.href='<?= base_url(); ?>bills/view/<?= $billsd['billsid']; ?>'"
                                        style="color: #263A56">
                                        <i class="fas fa-fw fa-print"></i>
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