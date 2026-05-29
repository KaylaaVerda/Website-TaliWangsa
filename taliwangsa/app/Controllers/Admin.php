<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
    protected $db;

    public function __construct()
    {
        helper(['url', 'form']);

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->send();
        }

        if (session()->get('role') != 'admin') {
            return redirect()->to('/login')->send();
        }

        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $totalUsers = $this->db->table('users')->countAllResults();

        $totalFreelancer = $this->db->table('users')
            ->where('role', 'freelancer')
            ->countAllResults();

        $totalClient = $this->db->table('users')
            ->where('role', 'client')
            ->countAllResults();

        $totalOrders = $this->db->table('orders')
            ->countAllResults();

        $activeOrders = $this->db->table('orders')
            ->whereIn('status', ['paid', 'in_progress', 'delivered'])
            ->countAllResults();

        $totalTransactions = $this->db->table('orders')
            ->selectSum('price')
            ->where('status', 'completed')
            ->get()
            ->getRow()
            ->price ?? 0;

        $openDisputes = $this->db->table('disputes')
            ->where('status', 'open')
            ->countAllResults();

        $latestOrders = $this->db->table('orders o')
            ->select('o.*, 
                c.name as client_name,
                f.name as freelancer_name')
            ->join('users c', 'c.id = o.client_id')
            ->join('users f', 'f.id = o.freelancer_id')
            ->orderBy('o.created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResult();

        $latestDisputes = $this->db->table('disputes d')
            ->select('d.*, 
                u.name as reporter_name,
                o.order_number')
            ->join('users u', 'u.id = d.raised_by')
            ->join('orders o', 'o.id = d.order_id')
            ->where('d.status', 'open')
            ->limit(5)
            ->get()
            ->getResult();

        $categoryStats = $this->db->table('categories c')
            ->select('
                c.name,
                COUNT(DISTINCT s.id) as total_services,
                COUNT(o.id) as total_orders
            ')
            ->join('services s', 's.category_id = c.id', 'left')
            ->join('orders o', 'o.service_id = s.id', 'left')
            ->groupBy('c.id')
            ->get()
            ->getResult();

        $registerLabels = [];
        $registerData = [];

        for ($i = 29; $i >= 0; $i--) {

            $date = date('Y-m-d', strtotime("-$i days"));

            $count = $this->db->table('users')
                ->where('DATE(created_at)', $date)
                ->countAllResults();

            $registerLabels[] = date('d M', strtotime($date));
            $registerData[] = $count;
        }

        $incomeChart = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            'data' => [2500000, 3200000, 4100000, 3800000, 5500000, 6200000]
        ];

        return view('admin/dashboard', [
            'totalUsers' => $totalUsers,
            'totalFreelancer' => $totalFreelancer,
            'totalClient' => $totalClient,
            'totalOrders' => $totalOrders,
            'activeOrders' => $activeOrders,
            'totalTransactions' => $totalTransactions,
            'openDisputes' => $openDisputes,
            'latestOrders' => $latestOrders,
            'latestDisputes' => $latestDisputes,
            'categoryStats' => $categoryStats,
            'registerLabels' => json_encode($registerLabels),
            'registerData' => json_encode($registerData),
            'incomeChart' => json_encode($incomeChart)
        ]);
    }

    public function users()
    {
        $role = $this->request->getGet('role');
        $search = $this->request->getGet('search');

        $builder = $this->db->table('users');

        if ($role) {
            $builder->where('role', $role);
        }

        if ($search) {
            $builder->groupStart()
                ->like('name', $search)
                ->orLike('email', $search)
                ->groupEnd();
        }

        $users = $builder
            ->orderBy('created_at', 'DESC')
            ->limit(15)
            ->get()
            ->getResult();

        return view('admin/users', [
            'users' => $users,
            'role' => $role,
            'search' => $search
        ]);
    }

    public function orders()
    {
        $status = $this->request->getGet('status');

        $builder = $this->db->table('orders o')
            ->select('
                o.*,
                c.name as client_name,
                f.name as freelancer_name,
                s.title as service_title
            ')
            ->join('users c', 'c.id = o.client_id')
            ->join('users f', 'f.id = o.freelancer_id')
            ->join('services s', 's.id = o.service_id');

        if ($status) {
            $builder->where('o.status', $status);
        }

        $orders = $builder
            ->orderBy('o.created_at', 'DESC')
            ->limit(15)
            ->get()
            ->getResult();

        return view('admin/orders', [
            'orders' => $orders,
            'status' => $status
        ]);
    }

    public function updateOrderStatus()
    {
        $orderId = $this->request->getPost('order_id');
        $status = $this->request->getPost('status');

        if ($orderId && $status) {
            $this->db->table('orders')
                ->where('id', $orderId)
                ->update([
                    'status' => $status,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }

        return redirect()->back()
            ->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function disputes()
    {
        $status = $this->request->getGet('status');

        $builder = $this->db->table('disputes d')
            ->select('
                d.*,
                u.name as reporter_name,
                o.order_number
            ')
            ->join('users u', 'u.id = d.raised_by')
            ->join('orders o', 'o.id = d.order_id');

        if ($status) {
            $builder->where('d.status', $status);
        }

        $disputes = $builder
            ->orderBy('d.created_at', 'DESC')
            ->get()
            ->getResult();

        return view('admin/disputes', [
            'disputes' => $disputes
        ]);
    }

    public function updateDisputeStatus($id)
    {
        $this->db->table('disputes')
            ->where('id', $id)
            ->update([
                'status' => $this->request->getPost('status'),
                'admin_note' => $this->request->getPost('admin_note'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return redirect()->back()
            ->with('success', 'Dispute berhasil diperbarui');
    }

    public function categories()
    {
        $categories = $this->db->table('categories')
            ->orderBy('categories.order', 'ASC')
            ->get()
            ->getResult();

        return view('admin/categories', [
            'categories' => $categories
        ]);
    }

    public function storeCategory()
    {
        $this->db->table('categories')->insert([
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'order' => $this->request->getPost('order') ?: 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function updateCategory($id)
    {
        $this->db->table('categories')
            ->where('id', $id)
            ->update([
                'name' => $this->request->getPost('name'),
                'slug' => $this->request->getPost('slug'),
                'description' => $this->request->getPost('description'),
                'is_active' => $this->request->getPost('is_active') ? 1 : 0,
                'order' => $this->request->getPost('order') ?: 0,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return redirect()->back()
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function deleteCategory($id)
    {
        $this->db->table('categories')
            ->where('id', $id)
            ->delete();

        return redirect()->back()
            ->with('success', 'Kategori berhasil dihapus');
    }

    public function settings()
    {
        if ($this->request->getMethod() === 'post') {

            session()->setFlashdata('success', 'Pengaturan berhasil disimpan');

            return redirect()->back();
        }

        return view('admin/settings', [
            'settings' => [
                'platform_name' => 'TaliWangsa',
                'tagline' => 'Platform Freelancer Indonesia',
                'contact_email' => 'admin@taliwangsa.com',
                'whatsapp_number' => '08123456789',
                'fee_percent' => 10,
                'min_withdrawal' => 50000
            ]
        ]);
    }
}