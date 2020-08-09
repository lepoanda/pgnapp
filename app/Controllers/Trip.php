<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TripModel;

class Trip extends BaseController
{
    public function __construct()
    {
        $this->ticket_model = new TicketModel();
        $this->trip_model = new TripModel();
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
                'title' => 'Add Trip Page | PGN Trip',
                'validation' => \Config\Services::validation(),
                'status' => $role,
                'user_id' => $user_id
            ];
            return view('pages/admin/trip_page', $data);
        } else {
            $data = [
                'title' => 'View Trip Page | PGN Trip',
                'validation' => \Config\Services::validation(),
                'status' => $role,
                'user_id' => $user_id
            ];
            return view('pages/client/trip_page', $data);
        }
    }

    public function get_trip()
    {
        $dataTrip = $this->trip_model->getTrip();
        $total = count($dataTrip);
        for ($i = 0; $i < $total; $i++) {
            if ($dataTrip[$i]['transport'] == 1) {
                $transport = "Bus";
            } elseif ($dataTrip[$i]['transport'] == 2) {
                $transport = "Kapal";
            }
            $result[] = array(
                'trip_id' => $dataTrip[$i]['trip_id'],
                'transport' => $transport,
                'rute_awal' => $dataTrip[$i]['rute_awal'],
                'rute_tujuan' => $dataTrip[$i]['rute_tujuan'],
                'jadwal' => $dataTrip[$i]['jadwal'],
            );
        }
        // dd($result);
        echo json_encode($result);
    }

    public function get_trip_details()
    {
        $id = $this->request->getGet('id');
        $dataTrip = $this->trip_model->getTripbyId($id);

        $ruteAwal = $dataTrip['rute_awal'];
        $ruteTujuan = $dataTrip['rute_tujuan'];
        $result[] = array(
            'rute_awal' => $ruteAwal,
            'rute_tujuan' => $ruteTujuan,
        );
        echo json_encode($result);
    }

    public function booked_trip()
    {
        $quantity = $this->request->getPost('quantity');
        $id = $this->request->getPost('id');
        $id_trip = $this->request->getPost('id_trip');
        $saveTrip = $this->ticket_model->save([
            'booking_code' => $id_trip,
            'users' => $id,
            'status' => '2',
            'total_users' => $quantity,
            'ticket_code' => '0',
        ]);
        if ($saveTrip) {
            $response = "Booking tiket berhasil dengan kode booking: " . $id_trip;
        } else {
            $response = "Booking gagal :(";
        }

        echo json_encode($response);
    }

    public function add_trip()
    {
        $rute_awal = $this->request->getPost('rute_awal');
        $rute_tujuan = $this->request->getPost('rute_tujuan');
        $transport = $this->request->getPost('transport');
        $jadwal = $this->request->getPost('jadwal');
        $addTrip = $this->trip_model->save([
            'trip_id' => 1231,
            'transport' => $transport,
            'rute_awal' => $rute_awal,
            'rute_tujuan' => $rute_tujuan,
            'jadwal' => $jadwal
        ]);
        if ($addTrip) {
            $response = "Add Trip berhasil";
        } else {
            $response = "Add Trip gagal :(";
        }

        echo json_encode($response);
    }

    public function delete_trip()
    {
        $trip_id = $this->request->getGet('trip_id');
        if ($trip_id) {
            $result = $this->trip_model->where('trip_id', $trip_id)->delete();
            $msg = "Trip: " . $trip_id . " berhasil di hapus";
        } else {
            $msg = "Gagal Hapus";
        }

        echo json_encode($msg);
    }

    //--------------------------------------------------------------------

}
