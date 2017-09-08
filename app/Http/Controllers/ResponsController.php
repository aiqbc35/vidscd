<?php

namespace App\Http\Controllers;

class ResponsController extends Controller
{
    protected $statusCode;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function responsError( $message = 'No Fount' )
    {
        return $this->respons([
            'status'    =>  'fail',
            'code'  =>  $this->getStatusCode(),
            'message'   =>  $message
        ]);
    }

    public function respons($data)
    {
        return \Response::json($data);
    }


}
