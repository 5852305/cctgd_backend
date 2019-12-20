<?php
function route_class(){
    return str_replace('.','-', Route::currentRouteName());
}

function success ($msg = '', $data = '', array $header = []){
    $code = 0;
    if (is_array($msg)) {
        $code = $msg['code'];
        $msg = $msg['msg'];
    }
    $result = [
        'code' => $code,
        'msg' => $msg,
        'data' => $data,
    ];
    $header['Access-Control-Allow-Origin'] = '*';
    $header['Access-Control-Allow-Headers'] = 'X-Requested-With,Content-Type,XX-Device-Type,XX-Token';
    $header['Access-Control-Allow-Methods'] = 'GET,POST,PATCH,PUT,DELETE,OPTIONS';
    return response()->json($result, $code > 0 ? $code : 200)
        ->withHeaders($header);
}
function error ($msg = '', $data = '', array $header = []){
    $code = 1;
    if (is_array($msg)) {
        $code = $msg['code'];
        $msg = $msg['msg'];
    }
    $result = [
        'code' => $code,
        'msg' => $msg,
        'data' => $data,
    ];
    $header['Access-Control-Allow-Origin'] = '*';
    $header['Access-Control-Allow-Headers'] = 'X-Requested-With,Content-Type,XX-Device-Type,XX-Token';
    $header['Access-Control-Allow-Methods'] = 'GET,POST,PATCH,PUT,DELETE,OPTIONS';
    return response()->json($result, $code > 0 ? $code : 200)
        ->withHeaders($header);
}
