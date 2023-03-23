<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MessageGroup;
use App\Models\MessageGroupMember;
use Illuminate\Support\Facades\Auth;

class MessageGroupController extends Controller
{
    public function store(Request $request)
    {
        $data['name'] = $request->name;
        $data['user_id'] = Auth::id();

        $messageGroup = MessageGroup::create($data);

        if ($messageGroup) {
            if(isset($request->user_id) && !empty($request->user_id)) {
                foreach ($request->user_id as $userId) {
                    $memberData['user_id'] = $userId;
                    $memberData['message_group_id'] = $messageGroup->id;
                    $memberData['status'] = 0;

                    MessageGroupMember::create($memberData);
                }
            }
        }

        return back();
    }

  /**
   * It gets all the users except the current user, gets the current user's information, gets all the
   * message groups, and gets the current message group
   * 
   * @param id The id of the group you want to show
   * 
   * @return A view with the users, myInfo, groups, and currentGroup.
   */
    public function show($id)
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $myInfo = User::find(Auth::id());
        $groups = MessageGroup::get();
        $currentGroup = MessageGroup::where('id', $id)->with('message_group_members.user')->first();

        return view('message_groups.index', compact("users", "myInfo", "groups", "currentGroup"));
    }
}
