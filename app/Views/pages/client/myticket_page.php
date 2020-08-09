<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<script src="js/ticket.js"></script>

<body>
    <div class="container">
        <div class="row">
            <div class="container panel panel-body col-md-6" align="center">
                <h2>Mana Ticketnya?</h2>
                <form id="form-ticket" method="get">
                    <div class="form-group">
                        <input type="text" id="kode_booking" name="kode_booking" placeholder="Input Kode Booking...">
                        <button type="submit" id="btn-search" class="btn btn-success"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            <table class="table table-striped">
                <tbody id="ticket">

                </tbody>
            </table>
        </div>
</body>
<style>
    .row .container {
        margin-top: 5%;
        width: 30%;
        border-radius: 15px;
    }

    .container .panel {
        background-color: whitesmoke;
    }


    @media screen and (max-width: 650px) {
        .row .container {
            margin-top: 5%;
            width: 30%;
            border-radius: 15px;
        }
    }
</style>
<?= $this->endSection(); ?>