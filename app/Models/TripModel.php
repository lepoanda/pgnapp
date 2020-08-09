<?php

namespace App\Models;

use CodeIgniter\Model;

class TripModel extends Model
{
    protected $table = 'trip';
    protected $allowedFields = ['trip_id', 'transport', 'rute_awal', 'rute_tujuan', 'jadwal'];

    public function getTrip()
    {
        $query = $this->findAll();
        return $query;
    }

    public function getTripbyId($id)
    {
        return $this->where(['trip_id' => $id])->first();
    }
}
