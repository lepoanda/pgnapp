<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table = 'ticket';
    protected $allowedFields = ['ticket_id', 'booking_code', 'users', 'status', 'total_users', 'ticket_code'];

    public function getVerif($params)
    {
        return $this->where(['booking_code' => $params])->first();
    }

    public function getTicket($params = false)
    {
        if ($params == false) {
            $this->select('*, t.rute_awal, t.rute_tujuan, u.username');
            $this->join('trip as t', 't.trip_id = booking_code', 'left');
            $this->join('users as u', 'u.user_id = users', 'left');
            return $this->findAll();
        } else {
            $this->select('*, t.rute_awal, t.rute_tujuan, u.username');
            $this->join('trip as t', 't.trip_id = booking_code', 'left');
            $this->join('users as u', 'u.user_id = users', 'left');
            $this->where('ticket_id', $params);
            return $this->findAll();
        }
    }
}
