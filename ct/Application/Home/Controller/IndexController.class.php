<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){


        $this->display();
    }
    public function news(){
      $this->display();
    }
    public function albums(){
      $this->display();
    }
    public function albums_2(){
      $this->display();
    }
    public function create(){
      if (I('post.')) {
        # code...

      $data['studentID'] = I('post.id');
      $data['stuname'] = I('post.name');
      if (I('post.gender') == '男') {
        $data['gender'] = '1';
      } else {
        $data['gender'] = '2';
      }

      $data['math'] = I('post.math');
      $data['English'] = I('post.english');
      $data['physics'] = I('post.physics');
      $data['computer'] = I('post.computer');
      $data['psychology'] = I('post.psychology');
      $data['sports'] = I('post.sports');
      $data['total'] = I('post.math') + I('post.english') + I('post.physics') + I('post.computer') + I('post.psychology') + I('post.sports');

        }
        $m = M('score');
        $res = $m->add($data);
        if ($res > 0) {
        $this->success('添加成功！');
      } else {
        $this->error('添加失败！');
      }
    }
    public function ims(){

      if (!empty(session('uid'))) {
          $m = M('score');
          if (I('get.')) {
            if (I('get.stuid') == 'all') {

              $res = $m->where('1')->select();
              $this->assign('res',$res);
              $this->display();
              exit;

            } else {
              $con['studentID'] = I('get.stuid');
              $res = $m->where($con)->select();
              $this->assign('res',$res);
              $this->display();
              exit;
              // dump($res);
            }
          } else {
            $m = M('score');
            $res = $m->where('1')->select();
            $this->assign('res',$res);
            $this->display();
            exit;

          }
      } else {
          $this->error('请先登录！',__APP__.'/Home/Login/login');
      }
    }

}
