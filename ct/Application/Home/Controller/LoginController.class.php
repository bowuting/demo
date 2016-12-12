<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {


    public function login(){
        if (!empty(session('uid'))) {
            $this->success('您已经登录 正在跳转！',__APP__.'/Home/Index/index');
        } else {
            if (I('post.')) {
                //得到表单数据
                $form_username = trim(I('post.username'));
                $form_passwd   = trim(I('post.passwd'));

                //数据库实例化
                $m = M('user');
                $con['user_name'] = $form_username;
                $res = $m->where($con)->find();

                //得到数据库数据
                $db_salt = $res['user_salt'];
                $db_passwd = $res['user_passwd'];
                $db_userid = $res['user_id'];
                $passwd = md5(md5($form_passwd . $db_salt));

                //判断密码 设置session
                if ($db_passwd === $passwd) {
                    session('uid',$db_userid);
                    $this->success('登录成功 正在跳转',__APP__.'/Home/Index/index');
                } else {
                    $this->error('用户名或密码错误！');
                }

            } else {
              $this->display();
            }
        }

    }

    public function logout(){
      session('uid',null);
      $this->success('您已安全退出！',__APP__.'/Home/Login/login');
    }

    public function register(){

        if (I('post.')) {
            $username = trim(I('post.username'));
            $passwd   = trim(I('post.passwd'));
            $salt     = salt();
            $passwd  .= $salt;
            $passwd   = md5(md5($passwd));

            $m = M('user');
            $data['user_name'] = $username;
            $data['user_salt'] = $salt;
            $data['user_passwd'] = $passwd;
            $data['user_createtime'] = time();

            $res = $m->add($data);
            if ($res > 0) {
                session('uid',$res);
                $this->success('注册成功 正在为您跳转！',__APP__.'/Home/Index/index',2);
            } else {
                $this->error('注册失败 请稍后再试！');
            }

        } else {
            $this->display();
        }
    }



}
