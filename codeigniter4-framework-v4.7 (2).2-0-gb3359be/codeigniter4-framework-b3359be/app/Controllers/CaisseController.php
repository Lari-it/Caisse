<?php

namespace App\Controllers;

use App\Models\CaisseModel;

class CaisseController extends BaseController
{
    /**
     * GET /caisse
     * Affiche la liste des caisses disponibles (issue de CaisseModel::getAllCaisses()).
     */
    public function index()
    {
        if (! session('isLoggedIn')) {
            return redirect()->to('login');
        }

        $caisseModel = new CaisseModel();

        return view('choix_caisse', [
            'caisses' => $caisseModel->getAllCaisses(),
            'erreur'  => session()->getFlashdata('erreur'),
        ]);
    }

    /**
     * POST /caisse/choisir
     * Enregistre la caisse choisie en session (caisse_id, caisse_numero).
     */
    public function choisir()
    {
        if (! session('isLoggedIn')) {
            return redirect()->to('login');
        }

        $caisseId = $this->request->getPost('caisse_id');

        if (empty($caisseId)) {
            session()->setFlashdata('erreur', 'Veuillez choisir une caisse.');
            return redirect()->to('caisse');
        }

        $caisseModel = new CaisseModel();
        $caisse      = $caisseModel->getCaisseById($caisseId);

        if (! $caisse) {
            session()->setFlashdata('erreur', 'Caisse introuvable.');
            return redirect()->to('caisse');
        }

        // Défensif : vérifier que les champs attendus sont présents
        $caisseIdReel = $caisse['id'] ?? null;
        $caisseNumero = $caisse['numero'] ?? null;

        if (empty($caisseIdReel) || $caisseNumero === null) {
            session()->setFlashdata('erreur', 'Données de la caisse manquantes ou invalides.');
            return redirect()->to('caisse');
        }

        session()->set([
            'caisse_id'     => $caisseIdReel,
            'caisse_numero' => $caisseNumero,
        ]);

        // On efface un éventuel achat resté en session (cas d'un changement de caisse)
        session()->remove('achat_id');

        return redirect()->to('achat');
    }
}