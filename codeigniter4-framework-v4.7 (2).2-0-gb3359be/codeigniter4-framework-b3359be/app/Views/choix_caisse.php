<?= view('templates/header') ?>

<h2>Choisir Caisse</h2>

<?php if (! empty($erreur)): ?>
    <div class="alerte-erreur"><?= esc($erreur) ?></div>
<?php endif; ?>

<form action="<?= site_url('caisse/choisir') ?>" method="post">
    <p>
        <select name="caisse_id" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach ($caisses as $caisse): ?>
                <option value="<?= esc($caisse['id']) ?>">Caisse <?= esc($caisse['numero']) ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <button type="submit">Valider</button>
</form>

<?= view('templates/footer') ?>
