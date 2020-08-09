<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<script src="js/ticket.js"></script>

<body>
    <div class="container">
        <h1>List Ticket</h1>
        <input type="hidden" id="user_id" value="<?= $user_id ?>">
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Booking Code</th>
                        <th scope="col">Rute Keberangkatan</th>
                        <th scope="col">Users</th>
                        <th scope="col">Slot</th>
                        <th scope="col">Ticket Code</th>
                        <th scope="col">Status</th>
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
    <div class="modal fade" id="modal-details">
        <div class="modal-dialog" style="width: 30%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Booking Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form id="form-details">
                    <div class="modal-body">
                        <div class="row">
                            <input type="number" name="id_trip" value="">
                            <input type="text" name="genCode" value="">
                            <input type="number" name="ticket_id" value="">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Rute </label>
                                    <h4 id="rute-modal"></h4>
                                </div>
                                <div class="form-group">
                                    <label> User </label>
                                    <h4 id="username-modal"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-details btn-primary btn-block"><i class="fa fa-save"></i> Approved</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>