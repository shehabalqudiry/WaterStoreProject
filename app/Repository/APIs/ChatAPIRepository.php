<?php

namespace App\Repository\APIs;

use App\Models\User;
use App\Models\Sport;
use App\Models\Video;
use App\Models\ChatRoom;
use App\Helpers\AgoraHelper;
use App\Models\ChatRoomUser;
use App\Traits\GeneralTrait;
use App\Models\ChatRoomAdmin;
use App\RepoInterface\APIs\ChatAPIInterface;
use Illuminate\Support\Facades\Validator;

class ChatAPIRepository implements ChatAPIInterface
{
    use GeneralTrait;

    public function create_room($request)
    {
        $rules = [
            'name'=>"required|max:255",
            'photo' => 'required|mimes:png,jpg,jpeg|max:1024'
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError("CHAT00", $validator->errors()->first());
        }

        $room = $request->user()->chats()->create([
            'name'      => $request->name,
            'status'    => 0,
            'photo'     => uploadImage("chats/photos", $request->photo),
        ]);

        return $this->returnSuccessMessage('تم انشاء المجموعه بنجاح في انتظار موافقة الادارة', "CHAT01");
    }
    public function add_room_users($request)
    {
        $room = $request->user()->chats()->where('id', $request->room_id)->first();
        if ($room->status == 0) {
            return $this->returnError("CHAT02", 'الغرفة قيد المراجعه في انتظار موافقة الادارة');
        }
        if ($request->group_users) {
            $room->users()->sync($request->group_users);
            foreach ($room->users()->get() as $user) {
                sendmessage($user->fcm_token, "تمت دعوتك الي المجموعه : $room->name", "قام " . $request->user()->name . " بدعوتك الي المجموعه: $room->name");
            }
        }
        return $this->returnSuccessMessage('تمت الاضافة بنجاح', "CHAT12");
    }

    public function delete_room_user($request)
    {
        $rules = [
            'user_id'=>"required",
            'room_id'=>"required|exists:chat_rooms,id",
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError("CHAT00", $validator->errors()->first());
        }
        $room = ChatRoom::where('id', $request->room_id)->first();
        $user = User::find($request->user_id);
        if ($room->status == 0) {
            return $this->returnError("CHAT02", 'الغرفة قيد المراجعه في انتظار موافقة الادارة');
        }
        if ($request->user_id) {
            ChatRoomUser::where(['user_id' => $request->user_id, 'chat_room_id' => $request->room_id])->first()->delete();
            sendmessage($user->fcm_token, "تم الخروج من المجموعه", "تم الخروج من المجموعه");
            return $this->returnSuccessMessage('تم الخروج من المجموعه', "CHAT15");
        }
        return $this->returnError("CHAT02", 'حدث خطأ');
    }
    public function add_room_admins($request)
    {
        $rules = [
            'admin_id'=>"required",
            'room_id'=>"required|exists:chat_rooms,id",
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError("CHAT00", $validator->errors()->first());
        }
        $room = ChatRoom::where('id', $request->room_id)->first();
        $user = User::find($request->admin_id);
        if ($room->status == 0) {
            return $this->returnError("CHAT02", 'الغرفة قيد المراجعه في انتظار موافقة الادارة');
        }
        if ($request->admin_id) {
            ChatRoomAdmin::where(['admin_id' => $request->admin_id, 'chat_room_id' => $request->room_id])->first()->delete();
            sendmessage($user->fcm_token, "تم الخروج من المجموعه", "تم الخروج من المجموعه");
            return $this->returnSuccessMessage('تم الخروج من المجموعه', "CHAT15");
        }
        return $this->returnError("CHAT02", 'حدث خطأ');
    }

    public function delete_room_admin($request)
    {
        // $room = $request->user()->chats()->where('id', $request->room_id)->first();
        // if ($room and $room->status == 0) {
        //     return $this->returnError("CHAT03", 'الغرفة قيد المراجعه في انتظار موافقة الادارة');
        // }
        // if ($request->admin_id) {
        //     $room->admins()->sync($request->group_admins);
        //     foreach ($room->admins()->get() as $admin) {
        //         sendmessage($admin->fcm_token, "تمت ازالتك من المجموعه : $room->name", "قام " . $request->user()->name . " بإزالتك من  دور مسئول في مجموعته: $room->name");
        //     }
        // }
        return $this->returnSuccessMessage('تمت الاضافة بنجاح', "CHAT13");
    }

    public function rooms($request)
    {
        $rooms = ChatRoom::where('user_id', $request->user()->id)->orWhereHas('users', function ($query) use ($request) {
            return $query->where('user_id', $request->user()->id);
        })->orWhereHas('admins', function ($query) use ($request) {
            return $query->where('user_id', $request->user()->id);
        })->with('users', 'admins', 'owner')->latest()->get();
        $data = $rooms;
        return $this->returnData('data', $data, '');
    }

    public function get_room($request)
    {
        $rooms = $request->user()->chats()->where('id', $request->room_id)->with('users', 'admins', 'owner');
        if ($room->status == 0) {
            return $this->returnError("CHAT04", 'الغرفة قيد المراجعه في انتظار موافقة الادارة');
        }
        $data = $rooms->first();
        return $this->returnData('data', $data, '');
    }

    public function update_room($request)
    {
        $data = [];
        return $this->returnData('data', $data, '');
    }


    public function delete_room($request)
    {
        $rules = [
            'room_id'=>"required|exists:chat_rooms,id",
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError($validator);
        }
        $room = $request->user()->chats()->where('id', $request->room_id)->delete();
        return $this->returnSuccessMessage('تمت حذف المجموعه بنجاح');
    }
}
