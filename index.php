<?php require_once 'includes/header.inc.php'; ?>

<div class="container px-4 py-5 mt-5" id="featured-3">
    <div class="row g-5 py-5 row-cols-1 row-cols-lg-2">
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-primary bg-gradient text-white fs-2 mb-3">
                <i class="bi bi-folder-symlink pt-2"></i>
            </div>
            <h2>Symlinks</h2>
            <p>
                Möchten Sie sogenannte Symlinks in Windows erstellen, sind hierfür nur wenige Klicks erforderlich.
            </p>
            <a href="symlinks.php" class="btn btn-primary icon-link d-inline-flex align-items-center">
                Symlinks erstellen
            </a>
        </div>
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-primary bg-gradient text-white fs-2 mb-3">
                <i class="bi bi-shield-check pt-2"></i>
            </div>
            <h2>WP Backendschutz</h2>
            <p>
                Um sicher zu stellen das kein Zugriff von extern auf den Login zu den Backends der
                Wordpress-Seiten möglich ist muss ein zusätzlicher Schutz hierfür eingerichtet werden.
            </p>
            <a href="wp-backend.php" class="btn btn-primary icon-link d-inline-flex align-items-center">
                Backendschutz erstellen
            </a>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.inc.php'; ?>
