<?php

class Admin extends Controller
{

    function index()
    {

        return $this->Views("Share/AdminLayout", ['subview' => 'Admin/index']);

    }

}