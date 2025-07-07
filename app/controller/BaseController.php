<?php

namespace app\controller;

use Webman\App;

class BaseController
{
    protected $request;

    public function __construct()
    {
        $this->request = App::request();
    }
}
