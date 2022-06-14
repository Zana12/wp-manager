<?php require_once 'includes/header.inc.php'; ?>

<div class="container px-4 py-5 mt-3" id="featured-3">
    <div class="text-center">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-primary bg-gradient text-white fs-2 mb-3">
            <i class="bi bi-folder-symlink pt-2"></i>
        </div>
        <h1 class="display-5 fw-bold">Symlinks erstellen</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">
                Durch dieses Formular können die zusätzlichen Symlinks für dein Theme und Plugin erstellt werden.
            </p>
        </div>
    </div>
    <div class="row justify-content-center mt-3 mb-3">
        <div class="col-8">
            <?php
                error_reporting(E_ERROR | E_PARSE);
                // Defining variables
                $project = $ressource = "";

                // Checking for a POST request
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $project = $_POST['project'];
                    $ressource = $_POST['ressource'];

                    $target_theme = 'C:/xampp/htdocs/'.$project.'/wp-content/'.$ressource.'/theme';
                    $link_theme = 'C:/xampp/htdocs/'.$project.'/wp-content/themes/'.$ressource.'-theme';

                    $target_plugin = 'C:/xampp/htdocs/'.$project.'/wp-content/'.$ressource.'/plugin';
                    $link_plugin = 'C:/xampp/htdocs/'.$project.'/wp-content/plugins/'.$ressource.'-plugin';

                    $symlink_theme = symlink($target_theme, $link_theme);
                    $symlink_plugin = symlink($target_plugin, $link_plugin);

                    if (file_exists($target_plugin) && is_dir($target_plugin) &&
                        file_exists($target_theme) && is_dir($target_theme)) {
                        if ($symlink_theme && $symlink_plugin) {
                            echo '<div class="alert alert-success alert-dismissible" role="alert">
                                    Symlinks wurde erfolgreich erstellt
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                    Fehler aufgetreten beim erstellen des Symbolic link<br>
                                    Bitte überprüfe nochmal die Ordnern.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible" role="alert">
                                angegebene Ordnern existiert nicht, überprüfe es erst.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                    }
                }
            ?>
        </div>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="row justify-content-center mt-5 pt-2">
        <div class="col-8">
            <div class="mb-4">
                <label class="form-label">Name dein Projektordner in <code>C:\xampp\htdocs\</code></label>
                <input name="project" type="text" class="form-control" placeholder="Projektordner" required>
                <div class="form-text">
                    wie z. B. werk-zwei.de, sk-citylogistik.de usw... je nach dem, wie du die genannt hast in der <code>htdocs</code> Ordner
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Name dein Ressourcen-Ordner in <code>C:\xampp\htdocs\[PROJEKT ORDNER]\wp-content\</code></label>
                <input name="ressource" type="text" class="form-control" placeholder="Ressourcen-Ordner" required>
                <div class="form-text">Damit ist dein Ressourcen-Ordner gemeint, welche dein JS, CSS sowie dein Libs (JS-PLugins) enthält.
                <br>
                wie z. B. medifavoriten, skmh usw...
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary pt-2">Symlinks erstellen</button>
            </div>

        </div>
    </form>
</div>



<?php require_once 'includes/footer.inc.php'; ?>
