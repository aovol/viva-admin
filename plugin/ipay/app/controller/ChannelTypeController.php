<?php

namespace plugin\ipay\app\controller;

use plugin\admin\app\controller\BaseController;
use support\Request;
use plugin\ipay\app\model\PayChannelType;

class ChannelTypeController extends BaseController
{
    public function index(Request $request)
    {
        $types = PayChannelType::getTree();

        return $this->success($types);
    }

    public function create(Request $request)
    {
        $v = validator($request->all(), [
            'name' => 'required',
            'code' => 'required|unique:pay_channel_types',
        ], [
            'name.required' => '请输入通道类型名称',
            'code.required' => '请输入通道类型编码',
            'code.unique' => '通道类型编码已存在',
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
        $data = $request->all();
        $v = validator($data, [
            'name' => 'required',
            'code' => 'required|unique:pay_channel_types,code,' . $request->post('id'),
        ], [
            'name.required' => '请输入通道类型名称',
            'code.required' => '请输入通道类型编码',
            'code.unique' => '通道类型编码已存在',
        ]);
        if ($v->fails()) {
            return $this->error($v->errors()->first());
        }

        $type = PayChannelType::find($data['id']);
        if (isset($data['parent_id']) && $type->id == $data['parent_id']) {
            return $this->error('父级类型不能为当前类型');
        }
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
