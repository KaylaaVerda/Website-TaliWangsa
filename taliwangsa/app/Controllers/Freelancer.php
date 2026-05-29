<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Freelancer extends Controller
{
    protected $db;

    public function __construct()
    {
        helper(['url','form']);

        $this->db = \Config\Database::connect();

        if(!session()->get('isLoggedIn')){
            return redirect()->to('/login')->send();
        }

        if(session()->get('role') != 'freelancer'){
            return redirect()->to('/login')->send();
        }
    }

    public function index()
    {
        $userId = session()->get('user_id');

        $walletBalance = 0;

        $activeOrders = $this->db->table('orders')
            ->where('freelancer_id', $userId)
            ->whereIn('status', ['paid','in_progress','delivered'])
            ->countAllResults();

        $monthlyOrders = $this->db->table('orders')
            ->where('freelancer_id', $userId)
            ->where('MONTH(created_at)', date('m'))
            ->countAllResults();

        $totalRevenue = $this->db->table('orders')
            ->selectSum('freelancer_amount')
            ->where('freelancer_id', $userId)
            ->where('status', 'completed')
            ->get()
            ->getRow()
            ->freelancer_amount ?? 0;

        $rating = $this->db->table('freelancer_profiles')
            ->where('user_id', $userId)
            ->get()
            ->getRow();

        $latestOrders = $this->db->table('orders o')
            ->select('o.*, u.name as client_name, u.avatar, s.title as service_title')
            ->join('users u', 'u.id = o.client_id')
            ->join('services s', 's.id = o.service_id')
            ->where('o.freelancer_id', $userId)
            ->orderBy('o.created_at','DESC')
            ->limit(5)
            ->get()
            ->getResult();

        $serviceColumns = $this->db->query("SHOW COLUMNS FROM services")->getResultArray();
        $serviceFields = array_column($serviceColumns, 'Field');
        $serviceKey = in_array('freelancer_profile_id', $serviceFields) ? 'freelancer_profile_id' : (in_array('user_id', $serviceFields) ? 'user_id' : (in_array('freelancer_id', $serviceFields) ? 'freelancer_id' : 'user_id'));

        $services = $this->db->table('services s')
            ->select('s.*, c.name as category_name')
            ->join('categories c', 'c.id = s.category_id', 'left');

        if ($serviceKey === 'freelancer_profile_id') {
            $services = $services->join('freelancer_profiles fp', 'fp.id = s.freelancer_profile_id', 'left')
                ->where('fp.user_id', $userId);
        } elseif ($serviceKey === 'freelancer_id') {
            $services = $services->where('s.freelancer_id', $userId);
        } else {
            $services = $services->where('s.user_id', $userId);
        }

        $services = $services->limit(3)
            ->get()
            ->getResult();

        $chartLabels = [];
        $chartData = [];

        for($i = 6; $i >= 0; $i--){

            $date = date('Y-m-d', strtotime("-$i days"));

            $income = $this->db->table('orders')
                ->selectSum('freelancer_amount')
                ->where('freelancer_id', $userId)
                ->where('DATE(created_at)', $date)
                ->where('status', 'completed')
                ->get()
                ->getRow()
                ->freelancer_amount ?? 0;

            $chartLabels[] = date('d M', strtotime($date));
            $chartData[] = (int)$income;
        }

        return view('freelancer/dashboard', [
            'walletBalance' => $walletBalance,
            'activeOrders' => $activeOrders,
            'monthlyOrders' => $monthlyOrders,
            'totalRevenue' => $totalRevenue,
            'rating' => $rating,
            'latestOrders' => $latestOrders,
            'services' => $services,
            'chartLabels' => json_encode($chartLabels),
            'chartData' => json_encode($chartData)
        ]);
    }

    public function chartData($days)
    {
        $userId = session()->get('user_id');

        $labels = [];
        $data = [];

        for($i = $days - 1; $i >= 0; $i--){

            $date = date('Y-m-d', strtotime("-$i days"));

            $income = $this->db->table('orders')
                ->selectSum('freelancer_amount')
                ->where('freelancer_id', $userId)
                ->where('DATE(created_at)', $date)
                ->where('status', 'completed')
                ->get()
                ->getRow()
                ->freelancer_amount ?? 0;

            $labels[] = date('d M', strtotime($date));
            $data[] = (int)$income;
        }

        return $this->response->setJSON([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function orders()
    {
        $userId = session()->get('user_id');

        $status = $this->request->getGet('status');

        $builder = $this->db->table('orders o')
            ->select('o.*, u.name as client_name, s.title as service_title')
            ->join('users u', 'u.id = o.client_id')
            ->join('services s', 's.id = o.service_id')
            ->where('o.freelancer_id', $userId);

        if($status){
            $builder->where('o.status', $status);
        }

        $orders = $builder
            ->orderBy('o.created_at','DESC')
            ->get()
            ->getResult();

        return view('freelancer/orders', [
            'orders' => $orders,
            'status' => $status
        ]);
    }

    public function services()
    {
        $userId = session()->get('user_id');

        // Detect services foreign key column (user_id, freelancer_id, or freelancer_profile_id)
        $cols = $this->db->query("SHOW COLUMNS FROM services")->getResultArray();
        $fields = array_column($cols, 'Field');
        $usesProfile = false;
        if (in_array('freelancer_profile_id', $fields)) {
            $serviceUserCol = 'freelancer_profile_id';
            $usesProfile = true;
        } elseif (in_array('user_id', $fields)) {
            $serviceUserCol = 'user_id';
        } elseif (in_array('freelancer_id', $fields)) {
            $serviceUserCol = 'freelancer_id';
        } else {
            $serviceUserCol = 'user_id';
        }

        $qb = $this->db->table('services s')
            ->select('s.*, c.name as category_name')
            ->join('categories c', 'c.id = s.category_id');

        if ($usesProfile) {
            $qb->join('freelancer_profiles fp', 'fp.id = s.freelancer_profile_id', 'left')
               ->where('fp.user_id', $userId);
        } elseif ($serviceUserCol === 'freelancer_id') {
            $qb->where('s.freelancer_id', $userId);
        } else {
            $qb->where('s.user_id', $userId);
        }

        $services = $qb->orderBy('s.created_at','DESC')
            ->get()
            ->getResult();

        return view('freelancer/services', [
            'services' => $services
        ]);
    }

    public function createService()
    {
        $categories = $this->db->table('categories')
            ->where('is_active',1)
            ->get()
            ->getResult();

        return view('freelancer/service_form', [
            'categories' => $categories
        ]);
    }

    public function storeService()
    {
        // Detect services foreign key column to insert correctly
        $cols = $this->db->query("SHOW COLUMNS FROM services")->getResultArray();
        $fields = array_column($cols, 'Field');
        $usesProfile = in_array('freelancer_profile_id', $fields);

        $insert = [
            'category_id' => $this->request->getPost('category_id'),
            'title' => $this->request->getPost('title'),
            'slug' => url_title($this->request->getPost('title'), '-', true),
            'description' => $this->request->getPost('description'),
            'price_start' => $this->request->getPost('price_start'),
            'price_end' => $this->request->getPost('price_end'),
            'delivery_days' => $this->request->getPost('delivery_days'),
            'revision_count' => $this->request->getPost('revision_count'),
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($usesProfile) {
            $userId = session()->get('user_id');
            // ensure freelancer profile exists and get its id
            $fp = $this->db->table('freelancer_profiles')->where('user_id', $userId)->get()->getRow();
            if (!$fp) {
                $this->db->table('freelancer_profiles')->insert([
                    'user_id' => $userId,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                $fpId = $this->db->insertID();
            } else {
                $fpId = $fp->id;
            }

            $insert['freelancer_profile_id'] = $fpId;
        } else {
            $insert['user_id'] = session()->get('user_id');
        }

        $this->db->table('services')->insert($insert);

        return redirect()->to('/freelancer/services');
    }

    public function wallet()
    {
        $transactions = [];

        $totalIncome = 0;
        $totalWithdraw = 0;
        $incomingCount = 0;
        $withdrawCount = 0;

        for($i=1; $i<=10; $i++){

            $type = $i % 2 == 0 ? 'Masuk' : 'Keluar';
            $amount = rand(100000,900000);

            if($type == 'Masuk'){
                $totalIncome += $amount;
                $incomingCount++;
            }else{
                $totalWithdraw += $amount;
                $withdrawCount++;
            }

            $transactions[] = [
                'date' => date('d M Y', strtotime("-$i days")),
                'description' => 'Pembayaran Project #'.$i,
                'type' => $type,
                'amount' => $amount,
                'status' => 'Berhasil'
            ];
        }

        $balance = $totalIncome - $totalWithdraw;

        return view('freelancer/wallet', [
            'transactions' => $transactions,
            'balance' => $balance,
            'totalIncome' => $totalIncome,
            'totalWithdraw' => $totalWithdraw,
            'incomingCount' => $incomingCount,
            'withdrawCount' => $withdrawCount
        ]);
    }

    public function profile()
    {
        $userId = session()->get('user_id');

        $profile = $this->db->table('freelancer_profiles fp')
            ->select('fp.*, u.name, u.email, u.avatar')
            ->join('users u', 'u.id = fp.user_id')
            ->where('fp.user_id', $userId)
            ->get()
            ->getRow();

        if (!$profile) {
            $user = $this->db->table('users')
                ->select('name, email, avatar')
                ->where('id', $userId)
                ->get()
                ->getRow();

            $profile = (object) [
                'name' => $user->name ?? '',
                'email' => $user->email ?? '',
                'avatar' => $user->avatar ?? '',
                'headline' => '',
                'bio' => '',
                'skills' => '',
                'hourly_rate' => 0,
                'availability' => 0,
            ];
        }

        return view('freelancer/profile', [
            'profile' => $profile
        ]);
    }

    public function updateProfile()
    {
        $userId = session()->get('user_id');

        $existing = $this->db->table('freelancer_profiles')
            ->where('user_id', $userId)
            ->get()
            ->getRow();

        $profileData = [
            'headline' => $this->request->getPost('headline'),
            'bio' => $this->request->getPost('bio'),
            'skills' => $this->request->getPost('skills'),
            'hourly_rate' => $this->request->getPost('hourly_rate'),
            'availability' => $this->request->getPost('availability') ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($existing) {
            $this->db->table('freelancer_profiles')
                ->where('user_id', $userId)
                ->update($profileData);
        } else {
            $profileData['user_id'] = $userId;
            $profileData['created_at'] = date('Y-m-d H:i:s');
            $this->db->table('freelancer_profiles')->insert($profileData);
        }

        $this->db->table('users')
            ->where('id', $userId)
            ->update([
                'name' => $this->request->getPost('name')
            ]);

        return redirect()->to('/freelancer/profile');
    }
}