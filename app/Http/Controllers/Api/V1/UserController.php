<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    //
    public function login(Request $request)
    {
        try{
            $mobile = $request->input('mobile', '');
            if (empty($mobile)) return $this->response(400, '手机号码必须填写');
            $password = $request->input('password', '');
            if (empty($password)) return $this->response(400, '密码必须填写');



            $user = User::where('mobile', $mobile)->where('status', 1)->first();
            if (empty($user)) return $this->response(400, '用户尚未注册');


            if ($user->password != md5($password)) return $this->response(400, '密码错误');


            $user->token = md5($user->mobile . $user->id . time());
            if (empty($user->save())) return $this->response(400, '登录失败');
            return $this->response(200, '登录成功', [
                'token' => $user->token
            ]);
        }catch (\Throwable $e){
            return $this->response(500, $e->getMessage());
        }
    }
}
