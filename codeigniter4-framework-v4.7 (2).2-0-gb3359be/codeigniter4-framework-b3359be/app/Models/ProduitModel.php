<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduitModel extends Model
{
    protected $table = 'produit';

    protected $allowedFields = [
        'designation',
        'prix',
        'stock'
    ];

    public function getAllProduits()
    {
        return $this->findAll();
    }

    public function getProduitById($id)
    {
        return $this->find($id);
    }

    public function updateStock($id, $nouveauStock)
    {
        return $this->update($id, [
            'stock' => $nouveauStock
        ]);
    }
}