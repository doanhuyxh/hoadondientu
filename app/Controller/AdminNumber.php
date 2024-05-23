<?php

class AdminNumber extends Controller
{
function index()
{
    return $this->Views("Share/AdminLayout", ['subview' => 'AdminNumber/index']);
}
}