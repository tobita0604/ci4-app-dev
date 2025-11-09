<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Dashboard Controller
 * 
 * Handles the admin dashboard display and related functionality
 * Compatible with CodeIgniter 4.6.1 and PHP 8.3
 */
class DashboardController extends BaseController
{
    /**
     * Display the admin dashboard
     * 
     * @return string
     */
    public function index(): string
    {
        $data = [
            'title' => 'Dashboard',
            'pagetitle' => 'Dashboards',
        ];

        return view('admin/dashboard', $data);
    }

    /**
     * Display analytics dashboard
     * 
     * @return string
     */
    public function analytics(): string
    {
        $data = [
            'title' => 'Analytics',
            'pagetitle' => 'Dashboards',
        ];

        return view('admin/dashboard-analytics', $data);
    }
}
