<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller{
    // public function index(){
    //     // echo "string";
    //     $Data     = M('Data');// 实例化Data数据模型
    //     $result     = $Data->find(3);
    //     $this->assign('result',$result);
    //     $this->display();
    // }
    public function insert(){


        $data['name'] = I('post.name');
        $data['stuid'] = I('post.stuid');
        $data['college'] = I('post.college');
        $data['email'] = I('post.email');
        $data['tel'] = I('post.tel');
        $data['create_time'] = time();
        $user = M('user');

        $id = $data['stuid'];
        $res = $user->find($id);
        if ($res) {
          $data['status']  = 2;
          $this->ajaxReturn($data,"json");
          exit;
        }

        $res = $user->add($data);
        if ($res) {
          $data['status']  = 1;
          $data['content'] = '报名成功';

        } else {
          $data['status']  = 2;
          $data['content'] = '报名失败';

        }
        $this->ajaxReturn($data,"json");
        exit;


    }
    // public function read(){
    //     $this->display();
    //
    // }
    public function find(){
        $User = M('User');
        $res = $User->find($_POST['stuid']);
        if ($res) {
          $json =  json_encode($res);
          echo $json;
          //echo $res['name'];
            // $this->assign('res',$res);
            // $this->display();
        }
        // else {
        //     $this->error('非法输入 请联系管理员！');
        // }


    }

}
?>
