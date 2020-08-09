<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/dashboard">PGN-TRIP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                if ($status == 0) {
                    echo    '<li class="nav-item">
                                <a class="nav-link" href="/login">Login</a>
                            </li>';
                    echo    '<li class="nav-item">
                                <a class="nav-link" href="/register">Register</a>
                            </li>';
                } elseif ($status == 1) {
                    echo    '<li class="nav-item">
                                <a class="nav-link" href="/trip">Add Trip</a>
                            </li>';
                    echo    '<li class="nav-item">
                                <a class="nav-link" href="/ticket">View List</a>
                            </li>';
                    echo    '<li class="nav-item">
                                <a class="nav-link" href="/logout">Logout</a>
                            </li>';
                } elseif ($status == 2) {
                    echo    '<li class="nav-item">
                                <a class="nav-link" href="/trip">View Trip</a>
                            </li>';
                    echo    '<li class="nav-item">
                                <a class="nav-link" href="/ticket">My Ticket</a>
                            </li>';
                    echo    '<li class="nav-item">
                                <a class="nav-link" href="/logout">Logout</a>
                            </li>';
                }
                ?>

            </ul>
        </div>
    </div>
</nav>