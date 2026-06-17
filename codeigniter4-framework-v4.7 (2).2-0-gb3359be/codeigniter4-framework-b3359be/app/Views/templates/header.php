<?php $caisseNumero = session('caisse_numero'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Caisse Supermarché</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f4f5f7; margin:0; color:#222; }
        .topbar { background:#1f3a5f; color:#fff; padding:14px 24px; display:flex; justify-content:space-between; align-items:center; }
        .topbar .titre { font-size:18px; font-weight:bold; }
        .topbar .caisse-active { background:#2c5282; padding:6px 12px; border-radius:4px; font-size:14px; }
        .menu { background:#16263f; padding:8px 24px; }
        .menu a { color:#cbd5e0; text-decoration:none; margin-right:18px; font-size:14px; }
        .menu a:hover { color:#fff; }
        .container { max-width: 760px; margin: 30px auto; background:#fff; padding:24px; border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.1); }
        table { width:100%; border-collapse: collapse; margin-top:16px; }
        th, td { border:1px solid #e2e8f0; padding:8px 10px; text-align:left; font-size:14px; }
        th { background:#f1f5f9; }
        .total-row td { font-weight:bold; background:#f8fafc; }
        input, select { padding:6px 8px; border:1px solid #cbd5e0; border-radius:4px; }
        button { background:#2c5282; color:#fff; border:none; padding:8px 16px; border-radius:4px; cursor:pointer; font-size:14px; }
        button:hover { background:#1f3a5f; }
        .btn-danger { background:#c53030; }
        .btn-danger:hover { background:#9b2c2c; }
        .alerte-erreur { background:#fed7d7; color:#9b2c2c; padding:10px; border-radius:4px; margin-bottom:14px; }
        .alerte-ok { background:#c6f6d5; color:#276749; padding:10px; border-radius:4px; margin-bottom:14px; }
        form.inline { display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
        label { font-size:14px; margin-right:4px; }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="titre">Caisse Supermarché — ITUniversity Promo 18</div>
        <?php if ($caisseNumero): ?>
            <div class="caisse-active">CAISSE ACTIVE : CAISSE <?= esc($caisseNumero) ?></div>
        <?php endif; ?>
    </div>

    <?php if (session('isLoggedIn')): ?>
    <div class="menu">
        <a href="<?= site_url('achat') ?>">Saisie des achats</a>
        <a href="<?= site_url('caisse') ?>">Changer de caisse</a>
        <a href="<?= site_url('logout') ?>">Déconnexion (<?= esc(session('login')) ?>)</a>
    </div>
    <?php endif; ?>

    <div class="container">
