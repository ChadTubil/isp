<?php $this->extend("layouts/base"); ?>
<?php $this->section("title"); ?>
    <?php echo $page_title; ?>
<?php $this->endSection(); ?>
<?php $this->section("heading"); ?>
    <?php echo $page_heading; ?>
<?php $this->endSection(); ?>

<?php echo $this->section('content'); ?>

<!-- CODE START HERE -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users Management</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="color: black;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="color: black;">
                    <thead>
                        <tr style="background-color: #263A56; color: white;">
                            <th>ID</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th style="text-align: center;">
                                <button class="btn btn-success btn-sm" style="border: 1px solid white;" title="Add"
                                    onclick="window.location.href='<?= base_url(); ?>users/add'">
                                    <i class="fas fa-fw fa-plus"></i>
                                    ADD
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($usersinfo as $usersi): ?>
                            <tr>
                                <td><?php if($usersi['uaccid'] == 0){
                                            echo 'NO ACCOUNT';
                                        }else{
                                            echo "EMP-".$usersi['uaccid'];
                                        }
                                    ?>
                                </td>
                                <td><?= $usersi['username']; ?></td>
                                <td><?= $usersi['password']; ?></td>
                                <td style="text-align: center;">
                                    <button class="btn btn-warning btn-sm">
                                        <i class="fas fa-fw fa-key"></i>
                                    </button>
                                    <button class="btn btn-info btn-sm" title="Edit"
                                    onclick="window.location.href='<?= base_url(); ?>users/edit/<?= $usersi['uid']; ?>'">
                                        <i class="fas fa-fw fa-pen"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" title="Delete"
                                        onclick="window.location.href='<?= base_url(); ?>users/delete/<?= $usersi['uid']; ?>'">
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