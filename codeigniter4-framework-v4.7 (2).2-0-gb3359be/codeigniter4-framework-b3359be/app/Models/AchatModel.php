<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatModel extends Model
{
    protected $table = 'achat';

    protected $allowedFields = [
        'caisse_id',
        'date_achat'
    ];

    public function createAchat($caisseId)
    {
        $this->insert([
            'caisse_id' => $caisseId
        ]);

        return $this->getInsertID();
    }

    public function getAchatById($id)
    {
        return $this->find($id);
    }
}