<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<script src="js/trip.js"></script>

<body>
    <div class="container">
        <h1>List Trip</h1>
        <input type="hidden" id="user_id" value="<?= $user_id ?>">
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