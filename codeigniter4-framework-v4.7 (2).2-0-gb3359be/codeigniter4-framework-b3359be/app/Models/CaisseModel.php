<?php

namespace App\Models;

use CodeIgniter\Model;

class CaisseModel extends Model
{
    protected $table = 'caisse';

    protected $allowedFields = [
        'numero'
    ];

    public function getAllCaisses()
    {
        return $this->findAll();
    }

    public function getCaisseById($id)
    {
        return $this->find($id);
    }
}