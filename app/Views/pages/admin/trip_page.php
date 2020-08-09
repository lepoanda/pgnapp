<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<script src="js/tripAdmin.js"></script>

<body>
    <div class="container">
        <h1>List Trip</h1>
        <input type="hidden" id="user_id" value="<?= $user_id ?>">
        <button class="btn btn-white btn-sm btn-success" data-toggle="modal" data-target="#modal-create"><i class="fa fa-plus"></i> Create</button>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Transport</th>
                        <th scope="col">Rute Awal</th>
                        <th scope="col">Rute Tujuan</th>
                        <th scope="col">Jadwal</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="target">
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal" id="modal-create">
        <div class="modal-dialog" style="width: 70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title bold"><i class="fa fa-plus"></i> Create Trip</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form id="form-add">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Rute Awal <span class="text-require">(*)</span></label>
                                            <input type="text" class="form-control" name="rute_awal" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Rute Tujuan <span class="text-require">(*)</span></label>
                                    <input type="text" class="form-control" name="rute_tujuan" required="">
                                </div>
                                <div class="form-group">
                                    <label>Jadwal <span class="text-require">(*)</span></label>
                                    <input type="hidden" name="jadwal-hidden">
                                    <div class="input-group">
                                        <input type="datetime-local" name="jadwal" class="form-control date-data date-data-jadwal" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Transport</label>
                                    <select name="transport" class="form-control choose" id="transport_insert">
                                        <option value=""></option>
                                        <?php
                                        $db      = \Config\Database::connect();
                                        $builder = $db->table('ms_transport');
                                        $thisDb = $builder->get()->getResultArray();

                                        $total = count($thisDb);
                                        for ($val = 0; $val < $total; $val++) {
                                            echo '<option value="' . $thisDb[$val]['transport_id'] . '">' . $thisDb[$val]['transport_type'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-white btn-block"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-booking">
        <div class="modal-dialog" style="width: 30%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Booking Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form id="form-booked">
                    <div class="modal-body">
                        <div class="row">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="id_trip" value="">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Rute </label>
                                    <h4 id="rute-modal"></h4>
                                </div>
                                <div class="form-group">
                                    <label>Quantity [1-10]</label>
                                    <input type="number" name="quantity" class="form-control" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-booked btn-primary btn-block"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>