<?php

namespace App\Controllers;

use App\Models\CaisseModel;
use App\Models\ProduitModel;
use App\Models\AchatModel;
use App\Models\DetailAchatModel;

class TestModels extends BaseController
{
    public function index()
    {
        echo "<pre>";

        echo "===== PRODUITS =====\n";
        $produitModel = new ProduitModel();
        print_r($produitModel->getAllProduits());

        echo "\n===== CAISSES =====\n";
        $caisseModel = new CaisseModel();
        print_r($caisseModel->getAllCaisses());

        echo "\n===== CREATION ACHAT =====\n";
        $achatModel = new AchatModel();
        $idAchat = $achatModel->createAchat(1);
        echo "ID Achat = " . $idAchat . "\n";

        echo "\n===== DETAIL ACHAT =====\n";
        $detailModel = new DetailAchatModel();

        $detailModel->addProduitToAchat(
            $idAchat,
            1,
            2,
            3000
        );

        $detailModel->addProduitToAchat(
            $idAchat,
            2,
            1,
            12000
        );

        print_r($detailModel->getProduitsAchat($idAchat));

        echo "\n===== TOTAL =====\n";
        echo $detailModel->calculTotal($idAchat);

        echo "</pre>";
    }
}