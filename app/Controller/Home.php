<?php

class Home extends Controller
{
    public function index()
    {
        return $this->Views("Share/Layout", ['subview'=> 'Home/index']);
    }

}
