<?php require_once 'includes/header.inc.php'; ?>

<div class="container px-4 py-5 mt-3 mb-5 pb-5" id="featured-3">
    <div class="text-center">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-primary bg-gradient text-white fs-2 mb-3">
            <i class="bi bi-shield-check pt-2"></i>
        </div>
        <h1 class="display-5 fw-bold">WP Backendschutz</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">
                Um sicher zu stellen das kein Zugriff von extern auf den Login zu den Backends der
                Wordpress-Seiten möglich ist muss ein zusätzlicher Schutz hierfür eingerichtet werden.
            </p>
        </div>
    </div>
    <div class="row justify-content-center mt-3 mb-3">
        <div class="col-8">
            <?php
            $username = $password = $project = '';
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $username = $_POST['username'];
                $password = $_POST['password'];
                $project = $_POST['project'];
                $zip = new ZipArchive;

                $filename = './temp/'.$project.'_'.date('Ymd').'.zip';
                if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              Die .zip Datei konnte nicht erstellt werden. Probiere es nochmal aus!
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>';
                } else {
                    echo '<div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between mb-2" role="alert">
                              <div>Die .zip Datei wurde erfolgreich erstellt.</div>
                              <div><a class="btn btn-outline-primary" href="'.$filename.'" download>'.str_replace("./temp/", "", $filename).' Herunterladen</a></div>
                           </div>';
                }
                $encrypted_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 11]);
                $htaccess = '<Files wp-login.php>
    AuthType Basic
    Require valid-user
    AuthName "Bitte Anmelden"
    AuthUserFile /var/www/'.$project.'/htdocs/.htpasswd
    Order deny,allow
    Deny from all
    Allow from 194.99.93.249
    Allow from 192.168.0.0/16
    Allow from 10.0.0.0/8
    Satisfy Any
</Files>';
                $htaccess_text = '&ltFiles wp-login.php&gt<br>
    AuthType Basic<br>
    Require valid-user<br>
    AuthName "Bitte Anmelden"<br>
    AuthUserFile /var/www/'.$project.'/htdocs/.htpasswd<br>
    Order deny,allow<br>
    Deny from all<br>
    Allow from 194.99.93.249<br>
    Allow from 192.168.0.0/16<br>
    Allow from 10.0.0.0/8<br>
    Satisfy Any<br>
&lt/Files&gt';
                $htpasswd = $username.':'.$encrypted_password;

                $zip->addFromString(".htaccess", $htaccess);
                $zip->addFromString(".htpasswd", $htpasswd);
                $zip->close();

                echo '<div class="card text-bg-light mb-3">
                          <div class="card-header">.htaccess</div>
                          <div class="card-body">
                            <p class="card-text">
                                <code>'.$htaccess_text.'</code>
                            </p>
                          </div>
                        </div>';
                echo '<div class="card text-bg-light mb-3">
                          <div class="card-header">.htpasswd</div>
                          <div class="card-body">
                            <p class="card-text">
                                <code>'.$htpasswd.'</code>
                            </p>
                          </div>
                        </div>';
                echo '<div class="card text-bg-light mb-3">
                          <div class="card-header">Zugriffsdaten für PMP</div>
                          <div class="card-body">
                            <h5 class="card-title">Wordpress Backend externe Logins</h5>
                            <p class="card-text">
                                <b>Benutzername: </b> '.$username.'<br/>
                                <b>Passwort: </b>'.$password.'
                            </p>
                          </div>
                        </div>';
            }
            ?>
        </div>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="row justify-content-center mt-5 pt-2">
        <div class="col-8">
            <div class="mb-4">
                <label class="form-label">Benutzername</label>
                <input name="username" type="text" class="form-control" placeholder="Benutzername" required>
            </div>

            <div class="input-group mb-4">
                <input id="password" name="password" type="text" class="form-control" placeholder="Generiere eine Passwort" readonly aria-label="Passwort" aria-describedby="generate_password" required>
                <button class="btn btn-outline-primary" type="button" id="generate_password" onclick="generatePassword()">Generiere eine Passwort</button>
            </div>

            <div class="mb-4">
                <label class="form-label">Projektbezeichnung auf dem Server</label>
                <input name="project" type="text" class="form-control" placeholder="Projektbezeichnung auf dem Server" required>
                <div class="form-text">Damit sind die Projekten auf die <code>www18-</code> und <code>www15-Server</code> gemeint.
                    <br>
                    wie z. B. <code>test.sklogistik.de</code>, <code>sk-citylogistik.de</code> usw...
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary pt-2">.htpasswd & .htaccess erstellen</button>
            </div>
        </div>
    </form>
</div>
<script>
    function generatePassword() {
        let chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        let passwordLength = 7;
        let password = "";

        for (let i = 0; i <= passwordLength; i++) {
            let randomNumber = Math.floor(Math.random() * chars.length);
            password += chars.substring(randomNumber, randomNumber +1);
        }

        document.getElementById("password").value = password;
    }
</script>


<?php require_once 'includes/footer.inc.php'; ?>
