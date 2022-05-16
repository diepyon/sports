<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index(Request $request){
        $chat_rooms_id  = $request->chat_rooms_id;//postされてくるchatroomのID
        //チャットルームに所属するユーザーたちの情報
        $users = DB::table('users')->where('chat_rooms_id',$chat_rooms_id )->get();
        
        //チャットが解放されているかどうか
        $locked =  DB::table('chat_rooms')->where('id',$chat_rooms_id )->first()->locked;

        //このチャットルームに所属するユーザーたちの発言
        $posts = DB::table('chat_posts')->where('chat_rooms_id',$chat_rooms_id)->get();

        foreach($posts as $post){
            $post->user_name = DB::table('users')->where('id',$post->users_id)->first()->name;
        }
   
        $info = array(
            'users' => $users,
            'locked' => $locked,
            'post' => $posts,
        );
       return $info;
    }
    public function post(Request $request){
        $userId = $request->userId;
        $post = $request->post;
        $chat_rooms_id = DB::table('users')->where('id',$userId )->first()->chat_rooms_id;

        DB::table('chat_posts')->insert([
            'users_id' =>  $userId,
            'post' => $post,
            'chat_rooms_id'=>$chat_rooms_id,
            'created_at' => now(),
            'updated_at' => now()            
        ]);    
        return 'succsess';
    }
}
