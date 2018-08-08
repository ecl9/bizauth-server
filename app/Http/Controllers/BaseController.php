<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $page = 1;
    protected $size = 1;
    protected $q = '';

    public function __construct()
    {
        if(isset($_GET['size'])){
            $this->size = $_GET['size'];
        }

        if(isset($_GET['page'])){
            $this->page = $_GET['page'];
        }

        if(isset($_GET['q'])){
            $this->q = $_GET['q'];
        }
    }
}
