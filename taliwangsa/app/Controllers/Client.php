<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Client extends Controller
{
    protected $db;

    public function __construct()
    {
        helper(['url','form']);

        if(!session()->get('isLoggedIn')){
            return redirect()->to('/login')->send();
        }

        if(session()->get('role') != 'client'){
            return redirect()->to('/login')->send();
        }

        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $clientId = session()->get('user_id');

        $totalActive = $this->db->table('orders')
            ->where('client_id', $clientId)
            ->whereIn('status', ['paid','in_progress','delivered'])
            ->countAllResults();

        $waitingPayment = $this->db->table('orders')
            ->where('client_id', $clientId)
            ->where('status', 'unpaid')
            ->countAllResults();

        $completedThisMonth = $this->db->table('orders')
            ->where('client_id', $clientId)
            ->where('status', 'completed')
            ->where('MONTH(updated_at)', date('m'))
            ->countAllResults();

        $totalSpent = $this->db->table('orders')
            ->selectSum('price')
            ->where('client_id', $clientId)
            ->where('status !=', 'cancelled')
            ->get()
            ->getRow()
            ->price ?? 0;

        $latestOrders = $this->db->table('orders o')
            ->select('o.*, u.name as freelancer_name, u.avatar, s.title as service_title')
            ->join('users u', 'u.id = o.freelancer_id')
            ->join('services s', 's.id = o.service_id')
            ->where('o.client_id', $clientId)
            ->orderBy('o.created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResult();

        return view('client/dashboard', [
            'totalActive' => $totalActive,
            'waitingPayment' => $waitingPayment,
            'completedThisMonth' => $completedThisMonth,
            'totalSpent' => $totalSpent,
            'latestOrders' => $latestOrders,
        ]);
    }

    public function orders()
    {
        $clientId = session()->get('user_id');

        $status = $this->request->getGet('status');

        $builder = $this->db->table('orders o')
            ->select('o.*, u.name as freelancer_name, s.title as service_title')
            ->join('users u', 'u.id = o.freelancer_id')
            ->join('services s', 's.id = o.service_id')
            ->where('o.client_id', $clientId);

        if($status){
            $builder->where('o.status', $status);
        }

        $perPage = 10;
        $page = (int) ($this->request->getGet('page') ?? 1);

        $total = $builder->countAllResults(false);

        $orders = $builder
            ->orderBy('o.created_at', 'DESC')
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResult();

        $pager = service('pager');

        return view('client/orders', [
            'orders' => $orders,
            'status' => $status,
            'pager' => $pager,
            'total' => $total,
            'perPage' => $perPage,
            'page' => $page
        ]);
    }

    public function orderDetail($id)
    {
        $clientId = session()->get('user_id');

        $order = $this->db->table('orders o')
            ->select('o.*, 
                u.name as freelancer_name,
                u.avatar,
                fp.rating_avg,
                s.title as service_title,
                s.description as service_description')
            ->join('users u', 'u.id = o.freelancer_id')
            ->join('freelancer_profiles fp', 'fp.user_id = u.id', 'left')
            ->join('services s', 's.id = o.service_id')
            ->where('o.id', $id)
            ->where('o.client_id', $clientId)
            ->get()
            ->getRow();

        if(!$order){
            return redirect()->to('/dashboard');
        }

        return view('client/order_detail', [
            'order' => $order
        ]);
    }
}