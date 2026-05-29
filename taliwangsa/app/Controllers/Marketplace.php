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

        $builder = $this->db->table('services s')
            ->select('s.*, c.name as category_name, c.slug as category_slug, fp.rating_avg')
            ->join('categories c', 'c.id = s.category_id');

        if ($usesProfile) {
            $builder->join('freelancer_profiles fp', 'fp.id = s.freelancer_profile_id', 'left')
                ->join('users u', 'u.id = fp.user_id', 'left')
                ->select('u.name as freelancer_name, u.avatar, fp.user_id as freelancer_user_id');
        } else {
            $builder->join('users u', "u.id = s." . $serviceUserCol)
                ->join('freelancer_profiles fp', 'fp.user_id = u.id', 'left')
                ->select('u.name as freelancer_name, u.avatar, u.id as user_id');
        }

        $builder->where('s.is_active', 1);

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

        // Setup pager (use a valid template)
        $pager = service('pager');
        $pagerLinks = $pager->makeLinks($currentPage, $perPage, $totalResults, 'default_full', 1);

        // categories sort column may be 'order' or 'sort_order'
        $catCols = $this->db->query("SHOW COLUMNS FROM categories")->getResultArray();
        $catFields = array_column($catCols, 'Field');
        $catOrderCol = in_array('order', $catFields) ? 'order' : (in_array('sort_order', $catFields) ? 'sort_order' : 'id');

        $categories = $this->db->table('categories')
            ->where('is_active', 1)
            ->orderBy($catOrderCol, 'ASC')
            ->get()
            ->getResult();

        return view('marketplace/index', [
            'services' => $services,
            'categories' => $categories,
            'search' => $search,
            'category' => $category,
            'pager' => $pager,
            'pagerLinks' => $pagerLinks,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
            'totalResults' => $totalResults
        ]);
    }

    public function serviceDetail($serviceId)
    {
        // Detect services foreign key column (support freelancer_profile_id)
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
            ->select('s.*, c.name as category_name');

        if ($usesProfile) {
            $qb->join('freelancer_profiles fp', 'fp.id = s.freelancer_profile_id', 'left')
               ->join('users u', 'u.id = fp.user_id', 'left')
               ->select('u.name as freelancer_name, u.avatar, u.email, fp.user_id as freelancer_user_id, fp.rating_avg as freelancer_rating_avg');
        } else {
            $qb->join('users u', "u.id = s." . $serviceUserCol)
               ->join('freelancer_profiles fp', 'fp.user_id = u.id', 'left')
               ->select('u.name as freelancer_name, u.avatar, u.email, u.id as freelancer_user_id, fp.rating_avg as freelancer_rating_avg');
        }

        $service = $qb->join('categories c', 'c.id = s.category_id')
            ->where('s.id', $serviceId)
            ->where('s.is_active', 1)
            ->get()
            ->getFirstRow();

        if (!$service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Total completed orders for this service
        $totalCompleted = $this->db->table('orders')
            ->where('service_id', $serviceId)
            ->where('status', 'completed')
            ->countAllResults();

        // Fetch reviews: prefer `reviews` table if exists
        $hasReviewsTable = (bool) $this->db->query("SHOW TABLES LIKE 'reviews'")->getNumRows();
        if ($hasReviewsTable) {
            $reviews = $this->db->table('reviews r')
                ->select('r.rating, r.comment as review, u.name as reviewer_name')
                ->join('users u', 'u.id = r.reviewer_id')
                ->where('r.reviewee_id', $service->freelancer_user_id)
                ->orderBy('r.created_at', 'DESC')
                ->get()
                ->getResult();
        } else {
            // Fallback: check if orders table has review/rating
            $orderCols = $this->db->query("SHOW COLUMNS FROM orders")->getResultArray();
            $orderFields = array_column($orderCols, 'Field');
            if (in_array('review', $orderFields) && in_array('rating', $orderFields)) {
                $reviews = $this->db->table('orders o')
                    ->select('o.review as review, o.rating, u.name as reviewer_name')
                    ->join('users u', 'u.id = o.client_id')
                    ->where('o.service_id', $serviceId)
                    ->where('o.review !=', null)
                    ->orderBy('o.updated_at', 'DESC')
                    ->get()
                    ->getResult();
            } else {
                $reviews = [];
            }
        }

        // attach totalCompleted to service object for view convenience
        $service->total_completed = $totalCompleted;

        return view('marketplace/service_detail', [
            'service' => $service,
            'reviews' => $reviews
        ]);
    }
}
