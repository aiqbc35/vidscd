<?php
namespace App\Http\Controllers\Admin;

use App\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CodeController
{
    static private $sqlCode;
    static private $newCode;
    static private $day = [1,7,30,90,360];
    static private $type = 30;

    public function index ()
    {
        $id = $_GET['id'];
        $day = self::$day;

        if (!in_array($id,$day)) {
            exit('NO PAGE');
        }

        $list = Code::with('adminuser')->where('type','=',$id)->get();

        return view('Admin.code',[
            'list' => $list,
            'name' => 'Code',
            'id'    => $id
        ]);
    }


    public function addCode (Request $request)
    {

        $id = $request->input('id');

        if ($id > 0) {
            $day = self::$day;

            if (!in_array($id,$day)) {
                return array(
                    'status' => 3,
                    'msg'   => '不存在的项目'
                );
            }
            self::$type = $id;
            self::$sqlCode = Code::select('code')->get();
            self::duoToone();
            $result = self::getCode();
            if ($result) {
                $data['status'] = 1;
                $data['msg'] = '新增成功';
            }else{
                $data['status'] = 2;
                $data['msg'] = '新增失败';
            }
            return $data;

        }


    }


    static private function duoToone ()
    {
        $code = self::$sqlCode;
        $newcode = array();

        foreach ($code as $value){
            $newcode[] = $value->code;
        }

        return self::$newCode = $newcode;

    }

    static private function getCode ()
    {
        $code = array();
        $oldcode = self::$newCode;
        $num = 40;
        $time = time();
        $type = self::$type;

        for ($i=1;$i<=$num;$i++){
            $de = self::make_coupon_card();
            if (!in_array($de,$oldcode)) {
                $code[$i]['code'] = $de;
                $code[$i]['addtime'] = $time;
                $code[$i]['type'] = $type;
            }else{
                $i++;
            }
        }
        $result = DB::table('code')->insert($code);

        if ($result) {
            return true;
        }
        return false;
    }


    static protected function make_coupon_card() {
        $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand = $code[rand(0,25)]
            .strtoupper(dechex(date('m')))
            .date('d').substr(time(),-5)
            .substr(microtime(),2,5)
            .sprintf('%02d',rand(0,99));
        for(
            $a = md5( $rand, true ),
            $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
            $d = '',
            $f = 0;
            $f < 8;
            $g = ord( $a[ $f ] ),
            $d .= $s[ ( $g ^ ord( $a[ $f + 8 ] ) ) - $g & 0x1F ],
            $f++
        );
        return $d;
    }

}