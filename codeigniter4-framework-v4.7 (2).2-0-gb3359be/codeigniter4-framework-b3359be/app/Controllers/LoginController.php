<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    /**
     * Comptes "en dur" pour la démo.
     * Le modèle de données du sujet ne définit pas de table UTILISATEUR,
     * donc on simule l'authentification avec un tableau PHP.
     * (Si une vraie table est ajoutée plus tard, il suffira de remplacer
     * ce tableau par un appel à un UserModel.)
     */
    private array $utilisateurs = [
        'admin'    => 'admin123',
        'caissier' => 'caissier123',
    ];

    /**
     * GET /login
     * Affiche le formulaire de connexion.
     */
    public function index()
    {
        if (session('isLoggedIn')) {
            return redirect()->to('caisse');
        }

        return view('login', [
            'erreur' => session()->getFlashdata('erreur'),
        ]);
    }

    /**
     * POST /login/connexion
     * Vérifie les identifiants et ouvre la session.
     */
    public function connexion()
    {
        $login      = $this->request->getPost('login');
        $motDePasse = $this->request->getPost('password');

        if (isset($this->utilisateurs[$login]) && $this->utilisateurs[$login] === $motDePasse) {
            session()->set([
                'isLoggedIn' => true,
                'login'      => $login,
            ]);

            return redirect()->to('caisse');
        }

        session()->setFlashdata('erreur', 'Identifiant ou mot de passe incorrect.');
        return redirect()->to('login');
    }

    /**
     * GET /logout
     * Ferme la session et revient au login.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
