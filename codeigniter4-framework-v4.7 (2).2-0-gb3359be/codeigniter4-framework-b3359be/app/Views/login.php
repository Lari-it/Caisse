<?= view('templates/header') ?>

<h2>Connexion</h2>

<?php if (! empty($erreur)): ?>
    <div class="alerte-erreur"><?= esc($erreur) ?></div>
<?php endif; ?>

<form action="<?= site_url('login/connexion') ?>" method="post">
    <p>
        <label for="login">Identifiant</label><br>
        <input type="text" id="login" name="login" required>
    </p>
    <p>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password" required>
    </p>
    <button type="submit">Se connecter</button>
</form>

<p style="font-size:12px;color:#888;margin-top:14px;">
    Comptes de démo : admin / admin123 — caissier / caissier123
</p>

<?= view('templates/footer') ?>
