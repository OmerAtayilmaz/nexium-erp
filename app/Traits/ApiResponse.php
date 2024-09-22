<?php
namespace App\Traits;



trait ApiResponse  {
    
    protected function ok($data, $message = 'Success', $status = 200){

        return response()->json([
            'status' => 'success',
            'data' => $data,
           'message' => $message
        ],$status);
    }

    protected function error($message = 'Error', $status = 400){
        
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => null,
        ], $status);
    }
}