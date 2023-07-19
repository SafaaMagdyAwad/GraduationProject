<?php
namespace App\Http\Controllers;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class ApiMessageController extends Controller
{
 public function send(Request $request, $sender_id ,$receiver_id){
        
         Messages::create([
            "sender_id" =>$sender_id ,
            "receiver_id" => $receiver_id,
            "message" => $request->message,
        ]);
        return response()->json([
            "msg" => "تم ارسال الرساله بنجاح ",
        ], 201);
    }
    public function reseve(Request $request, $sender_id ,$receiver_id){
        
         $messagesTrue = Messages::where("sender_id", $sender_id)
            ->where("receiver_id", $receiver_id)
            ->exists();
        if(!$messagesTrue){
            return response()->json([
            "msg" => "there are no messages between you yet ",
        ], 301);
        }else{
            
           return  Messages::where("sender_id", $sender_id)
            ->where("receiver_id", $receiver_id)
            ->get();
            
        }
            
        
        
         
    }
}