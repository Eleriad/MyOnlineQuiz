<?php

class AdminController extends Controller
{
    /**
     * Function that displays the Index Page of the Admin Session
     * Allows the Administrator to add, modify of delete a question, a category of a level and to look at all users pseudo, mail and role
     * @return view
     */
    public function index()
    {
        $this->view('admin/index', ["title" => "Admin - Dashboard"]);
    }

    /**
     * Function that give all information about website pages' views
     * @return view with numbers of views for each page and total view's number
     */
    public function views()
    {
        $totalViews = $this->model('PageView')->getAllWebsiteViews();
        $allPagesViews = $this->model('PageView')->getAllPageViews();
        $this->view('admin/views', ["title" => "Admin - Views", "totalViews" => $totalViews, "allPagesViews" => $allPagesViews]);
    }
}