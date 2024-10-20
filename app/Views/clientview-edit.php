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
                    <h6 class="m-0 font-weight-bold" style="color: white">UPDATE</h6>
                </div>
                <div class="card-body">
                <?php foreach($clientdata as $clientd): ?>
                    <?= form_open('clients/edit/'.$clientd['clientid'], ['class' => 'user']); ?>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">LASTNAME</label>
                                <input type="text" class="form-control"
                                    name="iptlastname" placeholder="Lastname" style="color: black;"
                                    value="<?= $clientd['lastname']; ?>">
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">FIRSTNAME</label>
                                <input type="text" class="form-control"
                                    name="iptfirstname" placeholder="Firstname" style="color: black;"
                                    value="<?= $clientd['firstname']; ?>">
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">MIDDLENAME</label>
                                <input type="text" class="form-control"
                                    name="iptmiddlename" placeholder="Middlename" style="color: black;"
                                    value="<?= $clientd['middlename']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">MOBILE NUMBER</label>
                                <input type="text" class="form-control"
                                    name="iptmobile" placeholder="Mobile Number" style="color: black;"
                                    value="<?= $clientd['mobile']; ?>">
                            </div>
                            <div class="col-sm-7 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">EMAIL</label>
                                <input type="email" class="form-control"
                                    name="iptemail" placeholder="Email" style="color: black;"
                                    value="<?= $clientd['email']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">PROVINCE</label>
                                <input type="text" class="form-control"
                                    name="iptprovince" placeholder="Province" style="color: black;"
                                    value="<?= $clientd['province']; ?>">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">CITY</label>
                                <input type="text" class="form-control"
                                    name="iptcity" placeholder="City" style="color: black;"
                                    value="<?= $clientd['city']; ?>">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">BARANGAY</label>
                                <input type="text" class="form-control"
                                    name="iptbarangay" placeholder="BARANGAY" style="color: black;"
                                    value="<?= $clientd['barangay']; ?>">
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">ZIP CODE</label>
                                <input type="text" class="form-control"
                                    name="iptzipcode" placeholder="ZIP CODE" style="color: black;"
                                    value="<?= $clientd['zipcode']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">PROPERTY TYPE</label>
                                <select name="iptpropertytype" class="form-control" style="color: black;">
                                    <option value="<?= $clientd['propertytype']; ?>" selected><?= $clientd['propertytype']; ?></option>
                                    <option value="House">House</option>
                                    <option value="Building">Building</option>
                                </select>
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">HOUSE/UNIT # <span style="color: red;">* If property is house</span></label>
                                <input type="text" class="form-control"
                                    name="ipthouseunitno" placeholder="House/Unitno" style="color: black;"
                                    value="<?= $clientd['houseunitno']; ?>">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">BUILDING NAME <span style="color: red;">* If property is building</span></label>
                                <input type="text" class="form-control"
                                    name="iptbuildingname" placeholder="Building Name" style="color: black;"
                                    value="<?= $clientd['buildingname']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">STREET</label>
                                <input type="text" class="form-control"
                                    name="iptstreet" placeholder="Street" style="color: black;"
                                    value="<?= $clientd['street']; ?>">
                            </div>
                            <div class="col-sm-7 mb-3 mb-sm-0">
                                <label class="custom-label" style="color: black;">VILLAGE/SUBDIVISION <span style="color: red;">* Optional</span></label>
                                <input type="text" class="form-control"
                                    name="iptvillagesubdivision" placeholder="Village/Subdivision" style="color: black;"
                                    value="<?= $clientd['villagesubdivision']; ?>">
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
                        onclick="window.location.href='<?= base_url(); ?>dashboard'">
                        <span class="icon text-white-50"><i class="fas fa-ban"></i></span>
                        <span class="text">CANCEL</span>
                    </button>
                </div>
                
            </div>
        </div>
    </div>
    

<!-- END OF CODE HERE -->

<?php echo $this->endSection(); ?>                