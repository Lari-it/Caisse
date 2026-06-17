<?= view('templates/header') ?>

<h2>Saisie des achats</h2>

<?php if (! empty($erreur)): ?>
    <div class="alerte-erreur"><?= esc($erreur) ?></div>
<?php endif; ?>
<?php if (! empty($message)): ?>
    <div class="alerte-ok"><?= esc($message) ?></div>
<?php endif; ?>

<form class="inline" action="<?= site_url('achat/ajouter') ?>" method="post">
    <label for="produit_id">Produit</label>
    <select id="produit_id" name="produit_id" required>
        <option value="">-- Choisir --</option>
        <?php foreach ($produits as $produit): ?>
            <option value="<?= esc($produit['id']) ?>">
                <?= esc($produit['designation']) ?> (stock: <?= esc($produit['stock']) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <label for="quantite">Quantité</label>
    <input type="number" id="quantite" name="quantite" min="1" value="1" required>

    <button type="submit">Valider</button>
</form>

<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Prix Unit</th>
            <th>Qté</th>
            <th>Montant</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($panier as $ligne): ?>
            <tr>
                <td><?= esc($ligne['designation']) ?></td>
                <td><?= esc($ligne['prix_unitaire']) ?></td>
                <td><?= esc($ligne['quantite']) ?></td>
                <td><?= esc($ligne['prix_unitaire'] * $ligne['quantite']) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="total-row">
            <td colspan="3">Total</td>
            <td><?= esc($total) ?></td>
        </tr>
    </tbody>
</table>

<form action="<?= site_url('achat/cloturer') ?>" method="post" style="margin-top:20px;">
    <button type="submit" class="btn-danger">Clôturer achat</button>
</form>

<?= view('templates/footer') ?>