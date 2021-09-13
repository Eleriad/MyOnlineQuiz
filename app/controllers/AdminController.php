<?php

class AdminController extends Controller
{
    public function index()
    {
        $this->view('admin/index');
    }

    public function views()
    {
        $totalViews = $this->model('Page')->getAllWebsiteViews();
        $allPagesViews = $this->model('Page')->getAllPageViews();
        $this->view('admin/views', ["totalViews" => $totalViews, "allPagesViews" => $allPagesViews]);
    }
}