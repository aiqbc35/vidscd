<?php

namespace App\Http\Controllers;

use App\AdminUser;
use App\Code;
use App\CodeLog;
use App\Link;
use App\Notice;
use App\Service;
use App\Transformer\VideoTransformer;
use App\Video;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends ResponsController
{
    protected $videoTransformer;

    private static $userinfoCookieName = 'COOKIE-TOKEN';   //用户缓存

    /**
     * ApiController constructor.
     * @param $videoTransformer
     */
    public function __construct(VideoTransformer $videoTransformer)
    {
        $this->videoTransformer = $videoTransformer;
    }

    /**
     * @return mixed
     */
    public function getHome(Request $request)
    {
        //Cache::forget('homeList');
        if (Cache::has('homeList')) {
            $list = Cache::get('homeList');
        } else {
            $limit = $request->get('limit');
            $list = $this->homeList($limit);
            Cache::put('homeList', $list, 1440);
        }
        if ($list) {
            return $this->respons([
                'status' => 'success',
                'data' => $list
            ]);
        } else {
            return $this->setStatusCode(404)->responsError();
        }
    }

    public function getMobileHome(Request $request)
    {
        //Cache::forget('homeList');
        if (Cache::has('mobileHomeList')) {
            $list = Cache::get('mobileHomeList');
        } else {
            $limit = $request->get('limit');
            $list = $this->homeList($limit);
            Cache::put('mobileHomeList', $list, 1440);
        }
        if ($list) {
            return $this->respons([
                'status' => 'success',
                'data' => $list
            ]);
        } else {
            return $this->setStatusCode(404)->responsError();
        }
    }

    public function updateMobileUserInfo(Request $request)
    {
        if ($request->isMethod('post')) {

            $email = $request->get('email');
            $pwd = $request->get('passwd');
            $newpwd = $request->get('newpwd');
            if (empty($email) || $pwd == '') {
                return $this->setStatusCode(404)->responsError('邮箱以及密码不能为空');
            }else if (self::checkEmail($email) == false){
                return $this->setStatusCode(404)->responsError('邮箱格式不合法');
            }


            $password = md5($pwd);

            $user_id = Session::get('user_id');

            $info = AdminUser::where('id','=',$user_id)
                ->where('password','=',$password)
                ->first();

            if (empty($info)) {
                return $this->setStatusCode(404)->responsError('密码错误！');
            }

            $info->username = $email;

            if ($newpwd) {
                $info->password = md5($newpwd);
            }

            $result = $info->save();

            if ($result) {
                Session::forget('user_id');

                $this->autoLogin();
                return $this->respons([
                    'status' => 'success',
                    'message'   =>  '修改成功'
                ]);
            }else{
                return $this->setStatusCode(101)->responsError('修改失败');
            }


        }else{
            return $this->setStatusCode(404)->responsError('请合法请求');
        }
    }

    public function getVideoAndRand(Request $request)
    {
        $id = $request->get('id');
        if (empty($id)) {
            return $this->setStatusCode(404)->responsError('请选择视频');
        }

        $video = Video::where('status','=',1)
            ->where('id','=',$id)
            ->first();

        if (empty($video)) {
            return $this->setStatusCode(404)->responsError('没有这个视频');
        }

        $videolink = self::getVideService();
        $imglink = self::getImagesService();

        if ($video->type == 1) {
            $isLogin = $this->autoLogin();
            if ($isLogin) {
                return $this->setStatusCode(101)->responsError($isLogin);
            }

            $userinfo = Cookie::get(self::$userinfoCookieName);

            if ($userinfo['vip'] == false) {
                return $this->setStatusCode(102)->responsError('您还不是VIP，请升级至VIP再观看，现在VIP惊爆价只需18元');
            }

            $videolink = self::getVipVideoService();
        }
        $randVideo = $this->randVideo();
        return $this->respons([
            'status' => 'success',
            'video' =>  $this->videoTransformer->tranuform($video->toArray()),
            'imglink'   =>  $imglink,
            'videolink' =>  $videolink,
            'randvideo' => $randVideo
        ]);

    }

    private function randVideo()
    {
        if (!Cache::has('videoKey')) {
            $video = Video::where('status', '=', 1)->get();
            $key = array();
            foreach ($video as $value) {
                $key[] = $value->id;
            }
            Cache::put('videoKey', $key, 1440);
        }
        $key = Cache::get('videoKey');
        $newkey = array_rand($key,12);
        $info = DB::table('video')->whereIn('id',$newkey)->get();

        $result = $this->mapArrayFun($info);

        return $result;
    }

    protected function mapArrayFun($item)
    {
        $data = array();
        foreach ($item as $key=>$value){
            $data[$key]['vid'] =  $value->id;
            $data[$key]['video']    = $value->link;
            $data[$key]['img']    = $value->image;
            $data[$key]['title']    = $value->name;
            $data[$key]['scan']    = $value->hit;
            $data[$key]['addtime']    = date("Y-m-d",$value->addtime);
        }
        return $data;
    }

    /**
     * 随机调取视频服务器
     * @param Request $request
     * @return mixed
     */
    static public function getVideService ()
    {
        if (Cache::has('videoServer')) {
            $serviceList = Cache::get('videoServer');
            $list = explode("||",$serviceList);
            return $list[array_rand($list,1)];
        }else{
            $ret = Service::find(3);
            Cache::put('videoServer',$ret->video,3600);
            return self::getVideService();
        }

    }

    static private function getVipVideoService ()
    {
        if (Cache::has('vipVideoServer')) {
            $images = Cache::get('vipVideoServer');
            $list = explode("||",$images);
            return $list[array_rand($list,1)];
        }else{
            $ret = Service::find(3);
            Cache::put('vipVideoServer',$ret->vipvideo,3600);
            return self::getVipVideoService();
        }
    }
    /**
     * 修改密码
     * @param Request $request
     * @return mixed
     */
    public function upPasswd (Request $request)
    {
        if ($request->isMethod('post')) {

            $newpwd = $request->get('newpwd');
            $pwd = $request->get('passwd');

            if (empty($pwd) || $newpwd == '') {
                return $this->setStatusCode(101)->responsError('参数不能为空');
            }

            $pwd = md5($pwd);
            $user_id = Session::get('user_id');

            $info = AdminUser::where('id','=',$user_id)
                ->where('password','=',$pwd)
                ->first();

            if (empty($info)) {
                return $this->setStatusCode(404)->responsError('密码错误');
            }

            $info->password = md5($newpwd);

            $ret = $info->save();
            if ($ret) {
                return $this->respons([
                    'status' => 'success',
                    'message'   =>  '修改成功'
                ]);
            }else{
                return $this->setStatusCode(103)->responsError('修改失败');
            }

        }else{
            return $this->setStatusCode(404)->responsError('请勿非法请求');
        }
    }

    /**
     * 修改邮箱
     * @param Request $request
     * @return mixed
     */
    public function upEmail(Request $request)
    {
        if ($request->isMethod('post')) {

            $email = $request->get('email');
            $pwd = $request->get('passwd');

            if (self::checkEmail($email) == false) {
                return $this->setStatusCode(101)->responsError('邮箱格式错误');
            }
            if ($pwd == '') {
                return $this->setStatusCode(404)->responsError('密码不能为空');
            }
            $pwd = md5($pwd);
            $userid = Session::get('user_id');

            $info = AdminUser::where('id','=',$userid)
                ->where('password','=',$pwd)
                ->first();

            if (empty($info)) {
                return $this->setStatusCode(102)->responsError('密码错误');
            }

            $isemail = AdminUser::where('username','=',$email)->first();

            if (isset($isemail->username)) {
                return $this->setStatusCode(404)->responsError('邮箱已存在');
            }
            $info->username = $email;
            $ret = $info->save();

            if ($ret) {
                Session::forget('user_id');

                $this->autoLogin();
                return $this->respons([
                    'status'    =>  'success',
                    'message'   =>  '修改成功'
                ]);
            }else{
                return $this->setStatusCode(404)->responsError('修改失败');
            }
        }else{
            return $this->setStatusCode(404)->responsError('请合法请求');
        }
    }

    /**
     * 激活激活码
     * @param Request $request
     * @return mixed
     */
    public function codeAction(Request $request)
    {
        if ($request->isMethod('post')) {

            $code = $request->get('code');

            if (empty($code)) {
                return $this->setStatusCode(101)->responsError('激活码不能为空');
            }

            if (!Session::has('user_id')) {
                return $this->setStatusCode(102)->responsError('您已退出,请重新登陆！');
            }
            $id = Session::get('user_id');

            $info = AdminUser::where('id','=',$id)->first();
            if (empty($info)) {
                return $this->setStatusCode(404)->responsError('用户不存在');
            }
            if ($info->type == 1) {
                return $this->setStatusCode(101)->responsError('您已是VIP会员。');
            }
            $getCode = Code::where('code','=',$code)->first();
            if (empty($getCode)) {
                return $this->setStatusCode(404)->responsError('激活码不存在');
            }
            if ($getCode->status == 1) {
                return $this->setStatusCode(404)->responsError('激活码已被使用');
            }
            $getCode->status = 1;
            $getCode->updatetime = time();
            $getCode->upuser = $info->id;
            $ret = $getCode->save();

            if (!$ret){
                return $this->setStatusCode(404)->responsError('激活失败');
            }

            $stoptime = strtotime('+'.$getCode->type.' day');

            $ret = CodeLog::create([
                'user_id'   =>  $info->id,
                'code_id'   =>  $getCode->id,
                'code'  =>  $getCode->code,
                'type'  =>  $getCode->type,
                'username'  =>  $info->username,
                'addtime'   =>  date('Y-m-d'),
                'stoptime'  => date('Y-m-d H:i:s',$stoptime)
            ]);

            if (!$ret) {
                return $this->setStatusCode(404)->responsError('激活失败');
            }

            $info->type = 1;
            $info->vipstoptime = $stoptime;
            $info->viptype = 1;
            $ret = $info->save();

            if (!$ret) {
                return $this->setStatusCode(404)->responsError('激活失败');
            }

            Session::forget('user_id');

            $this->autoLogin();

            return $this->respons([
                'status' => 'success',
                'message'   =>  '激活成功！'
            ]);

        }else{
            return $this->setStatusCode(404)->responsError('请合法请求');
        }
    }

    /**
     * 获取用户信息
     * @return mixed
     */
    public function getUserStatus()
    {
        $key = self::$userinfoCookieName;
        $result = $this->autoLogin();

        if ($result != false) {
            return $this->setStatusCode(404)->responsError($result);
        }
        $info = Cookie::get($key);

        return $this->respons([
            'status'    =>  'success',
            'data'      =>  $info
        ]);

    }

    /**
     * 自动登陆
     * @return bool|string
     */
    private function autoLogin()
    {
            $user_id = Session::get('user_id');
            $key = self::$userinfoCookieName;
            $data = '';

            if (empty($user_id)) {
                if (!Cookie::has($key)) {
                    return $data = '您还没有登陆';
                }
                $info = Cookie::get($key);

                $user = AdminUser::where('id','=',$info['id'])->first();
                if (!isset($user->id) || $user->id == '') {
                    return $data = '没有这个用户';
                }

                $this->userPutCache($user);
                Session::put('user_id',$user->id);
            }
        return false;

    }
    /**
     * 获取视频列表
     * @param Request $request
     * @return mixed
     */
    public function getVideoListPage(Request $request)
    {
        $type = $request->get('type');
        $limit = $request->get('limit');
        $page = 12;

        if ($type == '') {
            return $this->setStatusCode(101)->responsError('类型不能为空');
        }

        $total = $this->countVideo($type);

        $limitPage = $limit * $page;

        $list = $this->getVideoList($type, $limitPage, $page);

        if (empty($total) || $list == '') {
            return $this->setStatusCode(404)->responsError('无数据');
        }

        $imglink = self::getImagesService();
        $msg = array(
            'status'    =>  'success',
            'data'  =>  array(
                'total' => $total,
                'list' => $this->videoTransformer->tranuformCollction($list->toArray()),
                'imgLink' => $imglink,
                'limit' =>  $limit,
                'page'  =>  $page
            )
        );
        return $this->respons($msg);
    }

    /**
     * 用户登陆
     * @param Request $request
     * @return mixed
     */
    public function loginUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $email = $request->get('email');
            $passwd = $request->get('passwd');

            $checkuser = self::checkUser($email, $passwd);
            if ($checkuser != false) {
                return $this->setStatusCode(404)->responsError($checkuser);
            }
            $passwd = md5($passwd);

            $info = AdminUser::where('username', '=', $email)
                ->where('password', '=', $passwd)
                ->first();
            if (!isset($info->username)) {
                return $this->setStatusCode(404)->responsError('用户名或密码错误！');
            }
            self::userPutCache($info);

            return $this->respons([
                'status' => 'success',
                'message' => '登陆成功'
            ]);

        } else {
            return $this->setStatusCode(404)->responsError('请合法访问');
        }
    }

    /**
     * 缓存用户信息
     * @param $info
     */
    private static function userPutCache($info)
    {
        if (!empty($info)) {
            $cacheName = self::$userinfoCookieName;
            Cookie::queue($cacheName, [
                'id' => $info->id,
                'username' => $info->username,
                'vip' => isset($info->viptype) ? (boolean)$info->viptype : false,
                'viptime' => isset($info->vipstoptime) && $info->vipstoptime != '' ? date('Y-m-d',$info->vipstoptime) : '',
                'logintime' => isset($info->logintime) && $info->logintime != '' ? date('Y-m-d',$info->logintime) : ''
            ], 3600);
        }
    }

    /**
     * 创建新用户
     * @param Request $request
     * @return mixed
     */
    public function createUser(Request $request)
    {
        if ($request->isMethod('post')) {

            $email = $request->get('email');
            $passwd = $request->get('passwd');
            $isMobile = 'mobile';
            if ($request->get('type') == 'pc') {
                $isMobile = 'pc';
            }

            $checkuser = self::checkUser($email, $passwd);
            if ($checkuser != false) {
                return $this->setStatusCode(404)->responsError($checkuser);
            }

            $info = AdminUser::where('username', '=', $email)->first();
            if (isset($info->username)) {
                return $this->setStatusCode(102)->responsError('邮箱已存在，请确认您输入的邮箱');
            }
            $result = AdminUser::create([
                'username' => $email,
                'password' => md5($passwd),
                'addtime' => time(),
                'ismobile' => $isMobile
            ]);

            if ($result) {
                self::userPutCache($result);
                return $this->respons([
                    'status' => 'success',
                    'message' => '注册成功！'
                ]);
            } else {
                return $this->setStatusCode(101)->responsError('提交失败，请稍后再试！');
            }

        } else {
            return $this->setStatusCode(402)->responsError('请合法请求');
        }
    }


    private static function checkUser($email, $passwd)
    {
        $isEmail = self::checkEmail($email);
        $data = '';
        if (!$isEmail) {
            $data = '请输入正确的邮箱地址';
        }
        if (empty($passwd)) {
            $data = '密码不能为空';
        }
        if ($data) {
            return $data;
        }
        return false;
    }

    /**
     * 验证邮箱是否合规
     * @param $email
     * @return bool
     */
    static protected function checkEmail($email)
    {
        $mode = "/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/";
        if (preg_match($mode, $email)) {
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    private function homeList($limit)
    {

        //        1、获取点击最多的4个视频；
        $banner = $this->getVideoList('', 0, 4, array('con' => 'hit', 'type' => 'desc'));
//        2、获取公告；
        $notice = $this->getNoticeList();
//        3、获取视频列表；
        $public = $this->getVideoList(0, 0, $limit);
        $private = $this->getVideoList(1, 0, $limit);
//        4、获取友情链接；
        $links = $this->getLinksList();
        return array(
            'banner' => $this->videoTransformer->tranuformCollction($banner->toArray()),
            'notice' => $notice,
            'free' => $this->videoTransformer->tranuformCollction($public->toArray()),
            'vip' => $this->videoTransformer->tranuformCollction($private->toArray()),
            'links' => $links,
            'imgLink' => self::getImagesService()
        );
    }

    /**
     * 获取图片服务器
     * @return mixed
     */
    static protected function getImagesService()
    {

        if (Cache::has('imagesServer')) {
            $serviceList = Cache::get('imagesServer');
            $list = explode("||", $serviceList);
            return $list[array_rand($list, 1)];
        } else {
            $ret = Service::find(3);
            Cache::put('imagesServer', $ret->images, 3600);
            return self::getImagesService();
        }

    }


    private function getLinksList()
    {
        $list = Link::orderBy('sort', 'asc')->get();
        return $list;
    }

    /**
     * 获取通知
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getNoticeList()
    {
        $list = Notice::orderBy('id', 'desc')
            ->offset(0)
            ->limit(3)
            ->get();
        return $list;
    }

    /**
     * 获取视频列表
     * @param int $type
     * @param int $statar
     * @param int $limit
     * @param array $order
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getVideoList($type = 0, $statar = 0, $limit = 10, $order = array('con' => 'addtime', 'type' => 'desc'))
    {
        $result = Video::where('status', '=', 1)
            ->where('type', '=', $type)
            ->orderBy($order['con'], $order['type'])
            ->offset($statar)
            ->limit($limit)
            ->get();
        return $result;
    }

    /**
     * 统计视频数量
     * @param $type
     * @return int
     */
    private function countVideo($type)
    {
        return Video::where('status', '=', 1)
            ->where('type', '=', $type)
            ->count();
    }

}
