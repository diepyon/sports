<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchingController extends Controller
{
    public function index(Request $request) 
    {   
        $userId = $request->userId;
        $sports = $request->sports;//sportsのID
        $date = $request->date;
        $location = $request->location;

        //postしてきたユーザー情報の情報をusersテーブルからレコードごと取得
        $userRecord = DB::table('users')->where('id',$userId);
        $sportsRecord =  DB::table('sports')->where('id',$sports);
        
        //存在しない情報が飛んで来たら強制終了
        if($userRecord->first()==null)  return 'そのユーザーIDは存在しません。';
        if($sportsRecord->first()==null)  return 'そのスポーツIDは存在しません。';
        
        $roomRecord = DB::table('chat_rooms')->where([
            ['sports_id', '=', $sports],
            ['event_day', '=', $date],
            ['location', '=', $location],
            ['locked', '=', true],//ロックされている
        ])->first();

        //同じIDのユーザーが連続でマッチングボタンを押したり、
        //戻ってマッチングボタンを2たび押したりするのをフロント側でブロックする必要がある
        if($roomRecord == null ){
            $chatID = DB::table('chat_rooms')->insertGetId([
                'sports_id' => $sports,
                'event_day' => $date,
                'location' => $location,
                'room_name' => $date.' '.$sportsRecord->first()->sports_name,
                'count_per' => 1,
            ]);
            $userRecord->update(['chat_rooms_id'=> $chatID]);
            $roomRecord = DB::table('chat_rooms')->where('id',$chatID)->first();

        }else{
            //部屋があるとき

            //chatroomsテーブル内より希望条件にマッチした部屋のidを取得し、
            //usersテーブルにおける投稿者のchat_rooms_idカラムに格納
            $userRecord->update(['chat_rooms_id'=> $roomRecord->id]);
  
            $CurrentNumberOfPeople = $roomRecord->count_per;//現在条件がマッチしたルームにいる人数
            $RequiredNumerOfPeople = $sportsRecord->first()->per;//該当スポーツの必要人数
            
            if($CurrentNumberOfPeople === $RequiredNumerOfPeople - 1) //-1しないと既定人数より1人多くなる
            DB::table('chat_rooms')->where('id',$roomRecord->id)->update(['locked'=> 0]);//人数がそろったのでチャット開始（このルームにこれ以上人は詰め込まない）
            DB::table('chat_rooms')->where('id',$roomRecord->id)->update(['count_per'=> $roomRecord->count_per + 1]);//chatroomsテーブルにおけるcount_parを1増やす

            //count_per更新後のchat_roomsテーブルのレコードを取得
            $roomRecord = DB::table('chat_rooms')->where('id',$roomRecord->id)->first();
        }
        //ここにユーザー情報（全部）と所属するルームのレコード（全部）を返す
        $info = array(
            'user' => $userRecord->first(),
            'room' => $roomRecord,
        );
        return $info;
    }
}
