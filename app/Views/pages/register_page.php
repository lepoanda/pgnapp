<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<body>
    <!-- MAIN CONTENT -->
    <div class="container">
        <div class="row">
            <div class="container panel panel-body col-md-6" align="center">
                <h2 class="center">Register</h2>
                <?php
                if (session()->getFlashdata('msg')) {
                    echo '<div class ="alert alert-danger">' . session()->getFlashdata('msg') . '</div>';
                }
                ?>
                <!-- cek regis -->
                <form id="form-regis" method="post" action="/register/regisValidate">
                    <?= csrf_field(); ?>
                    <div class="form-group" align="left">
                        <label>Username</label>
                        <input type="text" id="username" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                    </div>
                    <div class="form-group" align="left">
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-login" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
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

    body {
        background-color: seagreen;
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