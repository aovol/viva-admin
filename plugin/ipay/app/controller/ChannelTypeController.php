<?php

namespace plugin\ipay\app\controller;

use plugin\admin\app\controller\BaseController;
use support\Request;
use plugin\ipay\app\model\PayChannelType;

class ChannelTypeController extends BaseController
{
    public function index(Request $request)
    {
        $types = PayChannelType::paginate();

        return $this->success([
            'items' => $types->items(),
            'total' => $types->total(),
            'current_page' => $types->currentPage(),
        ]);
    }

    public function create(Request $request)
    {
        $v = validator($request->all(), [
            'name' => 'required',
            'code' => 'required|unique:pay_channel_types',
        ]);
        if ($v->fails()) {
            return $this->error($v->errors()->first());
        }
        $data = $request->all();
        PayChannelType::create($data);
        return $this->message('创建成功');
    }

    public function update(Request $request)
    {
        $v = validator($request->all(), [
            'name' => 'required',
            'code' => 'required|unique:pay_channel_types,code,' . $request->post('id'),
        ]);
        if ($v->fails()) {
            return $this->error($v->errors()->first());
        }
        $data = $request->all();
        PayChannelType::where('id', $data['id'])->update($data);
        return $this->message('更新成功');
    }

    public function delete(Request $request)
    {
        $data = $request->all();
        PayChannelType::where('id', $data['id'])->delete();
        return $this->message('删除成功');
    }
}
