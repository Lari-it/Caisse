<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailAchatModel extends Model
{
    protected $table = 'detail_achat';

    protected $allowedFields = [
        'achat_id',
        'produit_id',
        'quantite',
        'prix_unitaire'
    ];

    public function addProduitToAchat(
        $achatId,
        $produitId,
        $quantite,
        $prix
    )
    {
        return $this->insert([
            'achat_id'      => $achatId,
            'produit_id'    => $produitId,
            'quantite'      => $quantite,
            'prix_unitaire' => $prix
        ]);
    }

    public function getProduitsAchat($achatId)
    {
        return $this->db
            ->table('detail_achat da')
            ->select('
                da.*,
                p.designation
            ')
            ->join(
                'produit p',
                'p.id = da.produit_id'
            )
            ->where(
                'da.achat_id',
                $achatId
            )
            ->get()
            ->getResultArray();
    }

    public function calculTotal($achatId)
    {
        $details = $this->where(
            'achat_id',
            $achatId
        )->findAll();

        $total = 0;

        foreach($details as $detail)
        {
            $total +=
                $detail['quantite']
                *
                $detail['prix_unitaire'];
        }

        return $total;
    }
}