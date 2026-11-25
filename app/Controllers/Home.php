<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('login');
    }
    public function Dashboard()
    {
        return view('index');
    }
    public function getNextEnquiryNo(){
    $db  = \Config\Database::connect();
    $qry = $db->query("SELECT enquiry_no FROM marketing_enquiry ORDER BY id DESC LIMIT 1");
    $row = $qry->getRow();
    $last = $row ? $row->enquiry_no : 0;

    echo $last + 1; // sirf number return kar raha hai
}
public function getNextProsNo(){
    $db  = \Config\Database::connect();
    $qry = $db->query("SELECT prospect_no FROM prospect_sales ORDER BY prospect_no DESC LIMIT 1");
    $row = $qry->getRow();
    $last = $row ? $row->prospect_no : 0;

    echo $last + 1; // sirf number return kar raha hai
}
}
