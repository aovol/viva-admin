<?php

namespace app\controller;

abstract class BaseController
{
    public function message($data = [], $msg = '', $code = 0)
    {
        $bag = [
            'code' => $code,
        ];
        if ($msg) {
            $bag['msg'] = $msg;
        }
        if ($data) {
            if (is_string($data) && !$msg) {
                $bag['msg'] = $data;
            } else {
                $bag['data'] = $data;
            }
        }

        return json($bag);
    }

    public function error($msg = '', $code = 400)
    {
        return $this->message([], $msg, $code);
    }

    public function success($data = [], $msg = '', $code = 0)
    {
        return $this->message($data, $msg, $code);
    }
}
