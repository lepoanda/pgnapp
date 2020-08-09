<?php

namespace App\Controllers;

use App\Models\TicketModel;

class Ticket extends BaseController
{
    public function __construct()
    {
        $this->ticket_model = new TicketModel();
    }
    public function index()
    {
        Session();
        if (session()->get('status') != "login") {
            return redirect()->to('/login');
        }
        $role = session()->get('role');
        $user_id = session()->get('id');

        if ($role == '1') {
            $data = [
                'title' => 'View List Page | PGN Trip',
                'validation' => \Config\Services::validation(),
                'status' => $role,
                'user_id' => $user_id
            ];
            return view('pages/admin/viewlist_ticket_page', $data);
        } else {
            $data = [
                'title' => 'My Ticket Page | PGN Trip',
                'validation' => \Config\Services::validation(),
                'status' => $role,
                'user_id' => $user_id
            ];
            return view('pages/client/myticket_page', $data);
        }
    }

    public function get_ticket()
    {
        $keyword = $this->request->getVar();
        $ticket = $this->ticket_model->getVerif($keyword);

        if ($ticket['status'] == 1) {
            $status = "Ticket sudah di approverd dengan kode ticket: " . $ticket['ticket_code'];
        } else {
            $status = "Ticket kamu belum di approved..";
        }

        echo json_encode($status);
    }

    public function get_ticket_list()
    {
        $dataTicket = $this->ticket_model->getTicket();
        $total = count($dataTicket);
        for ($i = 0; $i < $total; $i++) {
            if ($dataTicket[$i]['status'] == 1) {
                $status = "Verified";
            } elseif ($dataTicket[$i]['status'] == 2) {
                $status = "Pending";
            }
            $result[] = array(
                'ticket_id' => $dataTicket[$i]['ticket_id'],
                'booking_code' => $dataTicket[$i]['booking_code'],
                'rute_awal' => $dataTicket[$i]['rute_awal'],
                'users' => $dataTicket[$i]['username'],
                'total_users' => $dataTicket[$i]['total_users'],
                'ticket_code' => $dataTicket[$i]['ticket_code'],
                'status' => $status,
            );
        }
        //dd($result);
        echo json_encode($result);
    }

    public function get_ticket_details()
    {
        $ticket_id = $this->request->getGet('ticket_id');
        $booking_code = $this->request->getGet('booking_code');

        $dataTicket = $this->ticket_model->getTicket($ticket_id);

        $ruteAwal = $dataTicket[0]['rute_awal'];
        $ruteTujuan = $dataTicket[0]['rute_tujuan'];
        $username = $dataTicket[0]['username'];
        $ticket_id = $dataTicket[0]['ticket_id'];

        $result[] = array(
            'rute_awal' => $ruteAwal,
            'rute_tujuan' => $ruteTujuan,
            'username' => $username,
            'ticket_id' => $ticket_id,
            'trip_id' => $booking_code
        );
        echo json_encode($result);
    }

    public function approved()
    {
        $id = $this->request->getPost('ticket_id');
        $id_trip = $this->request->getPost('id_trip');
        $genCode = $this->request->getPost('genCode');

        $db      = \Config\Database::connect();
        $builder = $db->table('ticket');
        $data = [
            'status' => 1,
            'ticket_code'  => $genCode,
        ];

        $builder->where('ticket_id', $id);
        $builder->update($data);

        echo json_encode("berhasil");
    }

    //--------------------------------------------------------------------

}
