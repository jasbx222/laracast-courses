<?php 





namespace App\Traites;


trait ApiResponse{




protected function error($message , $code=500) {

    return response()->json([
        'message'=>$message,
        'code'=>$code
    ]);

}
protected function success($message ,$data=[], $code=500) {

    return response()->json([
        'message'=>$message,
        'code'=>$code,
        'data'=>$data
    ]);

}

 

protected function user_not_found($message,$code){
    return response()->json(
     [   'message'=> $message,
     'status_code'=>$code
     
     
    ]
    );
}



}