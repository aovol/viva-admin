<?php

namespace plugin\event\app\controller;

use support\Request;

class EventController
{
    public function index()
    {
        return view('event/index', ['name' => 'event']);
    }

}
