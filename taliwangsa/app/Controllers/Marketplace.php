<?php

namespace App\Controllers;

class Marketplace extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['url', 'form']);
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $category = $this->request->getGet('category');

        $builder = $this->db->table('services s')
            ->select('s.*, u.name as freelancer_name, u.avatar, u.id as user_id, c.name as category_name, c.slug as category_slug, fp.rating_avg')
            ->join('users u', 'u.id = s.user_id')
            ->join('categories c', 'c.id = s.category_id')
            ->join('freelancer_profiles fp', 'fp.user_id = u.id', 'left')
            ->where('s.is_active', 1);

        if ($search) {
            $builder->groupStart()
                ->like('s.title', $search)
                ->orLike('s.description', $search)
                ->orLike('c.name', $search)
                ->groupEnd();
        }

        if ($category) {
            $builder->where('c.slug', $category);
        }

        // Count total results before pagination
        $totalResults = $builder->countAllResults(false);

        $perPage = 12;
        $currentPage = (int) ($this->request->getGet('page') ?? 1);
        $offset = ($currentPage - 1) * $perPage;

        $services = $builder
            ->orderBy('s.created_at', 'DESC')
            ->limit($perPage, $offset)
            ->get()
            ->getResult();

        // Setup pager
        $pager = service('pager');
        $pager->makeLinks($currentPage, $perPage, $totalResults, 'default', 1);

        $categories = $this->db->table('categories')
            ->where('is_active', 1)
            ->orderBy('order', 'ASC')
            ->get()
            ->getResult();

        return view('marketplace/index', [
            'services' => $services,
            'categories' => $categories,
            'search' => $search,
            'category' => $category,
            'pager' => $pager,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
            'totalResults' => $totalResults
        ]);
    }

    public function serviceDetail($serviceId)
    {
        $service = $this->db->table('services s')
            ->select('s.*, u.name as freelancer_name, u.avatar, u.email, c.name as category_name, fp.*, 
                    (SELECT COUNT(*) FROM orders WHERE service_id = s.id AND status = "completed") as total_completed')
            ->join('users u', 'u.id = s.user_id')
            ->join('categories c', 'c.id = s.category_id')
            ->join('freelancer_profiles fp', 'fp.user_id = u.id', 'left')
            ->where('s.id', $serviceId)
            ->where('s.is_active', 1)
            ->get()
            ->getFirstRow();

        if (!$service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $reviews = $this->db->table('orders o')
            ->select('o.review, o.rating, u.name as reviewer_name')
            ->join('users u', 'u.id = o.user_id')
            ->where('o.service_id', $serviceId)
            ->where('o.review !=', null)
            ->orderBy('o.updated_at', 'DESC')
            ->get()
            ->getResult();

        return view('marketplace/service_detail', [
            'service' => $service,
            'reviews' => $reviews
        ]);
    }
}
