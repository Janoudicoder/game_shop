<?php

if (isset($_SESSION['melding'])) {
    echo '<p style="color: red;">' . $_SESSION['melding'] . '</p>';
    unset($_SESSION['melding']);
  }



?>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="./php/login.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Gebruikernaam</label>
                                <input type="text" class="form-control" id="username" name="gebruiker_naam" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Wachtwoord</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">Bekijk</button>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-paper-plane"></i> Login
                            </button>
                        </form>
                        <br>
                        <form method="POST" action="index.php?page=signup">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-paper-plane"></i> Aanmelden
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.textContent = type === 'password' ? 'Bekijk' : 'Verberg';
    });
</script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>