<?php

namespace plugin\ipay\app\controller;

use plugin\admin\app\controller\BaseController;
use support\Request;
use plugin\ipay\app\model\PayChannel;

class ChannelController extends BaseController
{
    public function index(Request $request)
    {
        $channels = PayChannel::with('type')->paginate();
        return $this->success([
            'items' => $channels->items(),
            'total' => $channels->total(),
            'current_page' => $channels->currentPage(),
        ]);
    }


    public function create(Request $request)
    {
        $data = $request->all();
        $v = validator($data, [
            'name' => 'required',
            'code' => 'required|unique:pay_channels',
            'type_code' => 'required',
        ], [
            'name.required' => '请输入通道名称',
            'code.required' => '请输入通道编码',
            'type_code.required' => '请选择通道类型',
            'code.unique' => '通道编码已存在',
        ]);
        if ($v->fails()) {
            return $this->error($v->errors()->first());
        }
        PayChannel::create($data);
        return $this->message('创建成功');
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $v = validator($data, [
            'name' => 'required',
            'code' => 'required|unique:pay_channels,code,' . $request->post('id'),
            'type_code' => 'required',
        ], [
            'name.required' => '请输入通道名称',
            'code.required' => '请输入通道编码',
            'type_code.required' => '请选择通道类型',
            'code.unique' => '通道编码已存在',
        ]);
        if ($v->fails()) {
            return $this->error($v->errors()->first());
        }
        $channel = PayChannel::find($data['id']);
        $channel->where('id', $data['id'])->update($data);
        return $this->message('更新成功');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        PayChannel::where('id', $id)->delete();
        return $this->message('删除成功');
    }
}
