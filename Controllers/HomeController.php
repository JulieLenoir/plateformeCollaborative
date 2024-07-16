<?php

class HomeController extends Controller
{

    public function index()
    {

        $this->render('home/index');
    }

    public function error(){

        $this->render('home/error');
    }
}
