<?php

namespace App\controllers;

use App\models\QueryBuilder;

class HomeController {

    private QueryBuilder $builder;

    public function __construct(QueryBuilder $builder) {
        $this->builder = $builder;
    }

    public function index() {
        echo 'this is index ' ;
    }

    public function about() {
        echo 'about';
    }
}