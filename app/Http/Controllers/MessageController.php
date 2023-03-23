<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\MessageGroup;
use Illuminate\Http\Request;
use App\Events\GroupMessageEvent;
use PhpParser\Node\Stmt\TryCatch;
use App\Events\PrivateMessageEvent;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function conversation($userId) {
        $users = User::where('id', '!=', Auth::id())->get();
        $friendInfo = User::findOrFail($userId);
        $myInfo = User::find(Auth::id());
        $groups = MessageGroup::get();
        
        return view('message.conversation', compact("users", "friendInfo", "myInfo", "groups"));
    }

    public function sendMessage(Request $request) {

        $request->validate([
            'message' => 'required',
            'receiver_id' => 'required'
        ]);

        $sender_id = Auth::id();
        $receiver_id = $request->receiver_id;

        $message = new Message();
        $message->message = $request->message;

        if ($message->save()) {
            try {
                $message->users()->attach($sender_id, ['receiver_id' => $receiver_id]);
                $sender = User::where('id', '=', $sender_id)->first();

                //almaceno los datos en un array
                $data = [];
                $data['sender_id'] = $sender_id;
                $data['sender_name'] = $sender->name;
                $data['receiver_id'] = $receiver_id;
                $data['content'] = $message->message;
                $data['created_at'] = $message->created_at;
                $data['message_id'] = $message->id;

                event(new PrivateMessageEvent($data));

                return response()->json([
                    'data' => $data,
                    'success' => true,
                    'message' => 'Message sent successfully'
                ]);
                
            } catch (\Exception $e) {
                $message->delete();
            }
        }
    }

/**
 * It validates the request, creates a new message, attaches the sender to the message, and then
 * broadcasts the message to the group
 * 
 * @param Request request The request object.
 * 
 * @return The message is being returned to the user.
 */

    public function sendGroupMessage(Request $request) {

        $request->validate([
            'message' => 'required',
            'message_group_id' => 'required'
        ]);

        $sender_id = Auth::id();
        $messageGroupId = $request->message_group_id;

        $message = new Message();
        $message->message = $request->message;

        if ($message->save()) {
            try {
                $message->users()->attach($sender_id, ['message_id' => $messageGroupId]);
                $sender = User::where('id', '=', $sender_id)->first();

                
                $data = [];
                $data['sender_id'] = $sender_id;
                $data['sender_name'] = $sender->name;
                $data['content'] = $message->message;
                $data['created_at'] = $message->created_at;
                $data['message_id'] = $message->id;
                $data['group_id'] = $messageGroupId;
                $data['type'] = 2;

                event(new GroupMessageEvent($data));

                return response()->json([
                    'data' => $data,
                    'success' => true,
                    'message' => 'Message sent successfully'
                ]);

            } catch (\Exception $e) {
                $message->delete();
            }
        }
    }
    
}
