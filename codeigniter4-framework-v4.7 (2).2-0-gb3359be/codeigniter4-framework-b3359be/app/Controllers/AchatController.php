<?php

namespace App\Controllers;

use App\Models\AchatModel;
use App\Models\ProduitModel;
use App\Models\DetailAchatModel;

class AchatController extends BaseController
{
    /**
     * GET /achat
     * Affiche les produits disponibles + le panier de l'achat en cours + le total.
     */
    public function index()
    {
        if (! session('isLoggedIn')) {
            return redirect()->to('login');
        }

        if (! session('caisse_id')) {
            return redirect()->to('caisse');
        }

        $achatId = $this->achatEnCours();

        $produitModel = new ProduitModel();
        $detailModel  = new DetailAchatModel();

        return view('achat', [
            'produits' => $produitModel->getAllProduits(),
            'panier'   => $detailModel->getProduitsAchat($achatId),
            'total'    => $detailModel->calculTotal($achatId),
            'message'  => session()->getFlashdata('message'),
            'erreur'   => session()->getFlashdata('erreur'),
        ]);
    }

    /**
     * POST /achat/ajouter
     * Ajoute un produit (et une quantité) à l'achat en cours, met à jour le stock.
     */
    public function ajouterProduit()
    {
        if (! session('caisse_id')) {
            return redirect()->to('caisse');
        }

        $produitId = $this->request->getPost('produit_id');
        $quantite  = (int) $this->request->getPost('quantite');

        if (empty($produitId) || $quantite <= 0) {
            session()->setFlashdata('erreur', 'Choisis un produit et une quantité valide.');
            return redirect()->to('achat');
        }

        $produitModel = new ProduitModel();
        $produit      = $produitModel->getProduitById($produitId);

        if (! $produit) {
            session()->setFlashdata('erreur', 'Produit introuvable.');
            return redirect()->to('achat');
        }

        // Défensif : s'assurer que les clés existent avant d'y accéder
        $stockActuel = isset($produit['stock']) ? (int) $produit['stock'] : 0;
        $produitIdReel = $produit['id'] ?? null;
        $prixUnitaire = isset($produit['prix']) ? $produit['prix'] : 0;

        if ($quantite > $stockActuel) {
            session()->setFlashdata('erreur', 'Stock insuffisant pour ce produit.');
            return redirect()->to('achat');
        }

        $achatId     = $this->achatEnCours();
        $detailModel = new DetailAchatModel();

        // En cas d'anomalie, éviter d'insérer des valeurs nulles
        if (empty($produitIdReel)) {
            session()->setFlashdata('erreur', 'Identifiant produit invalide.');
            return redirect()->to('achat');
        }

        $detailModel->addProduitToAchat(
            $achatId,
            $produitIdReel,
            $quantite,
            $prixUnitaire
        );

        $nouveauStock = max(0, $stockActuel - $quantite);
        $produitModel->updateStock($produitIdReel, $nouveauStock);

        session()->setFlashdata('message', 'Produit ajouté au panier.');
        return redirect()->to('achat');
    }

    /**
     * POST /achat/cloturer
     * Termine l'achat du client courant : le panier est vidé pour le prochain client.
     */
    public function cloturer()
    {
        if (! session('caisse_id')) {
            return redirect()->to('caisse');
        }

        if (session('achat_id')) {
            session()->setFlashdata('message', 'Achat clôturé avec succès. Le panier est prêt pour un nouveau client.');
        }

        // On retire l'achat en cours de la session : le prochain accès à /achat
        // déclenchera la création d'un nouvel achat (= nouveau client).
        session()->remove('achat_id');

        return redirect()->to('achat');
    }

    /**
     * Retourne l'id de l'achat en cours pour la caisse active.
     * Crée un nouvel achat (via AchatModel::createAchat) si aucun n'est
     * encore enregistré en session.
     */
    private function achatEnCours(): int
    {
        $achatId = session('achat_id');

        if (! $achatId) {
            $achatModel = new AchatModel();
            $achatId    = $achatModel->createAchat(session('caisse_id'));
            session()->set('achat_id', $achatId);
        }

        return (int) $achatId;
    }
}