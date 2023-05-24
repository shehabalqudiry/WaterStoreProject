<?php

namespace App\Repository\Users;

use App\Models\User;
use App\Models\Sport;
use App\Models\Video;
use App\Models\ChatRoom;
use App\Helpers\AgoraHelper;
use App\Traits\GeneralTrait;
use App\RepoInterface\Users\ChatInterface;
use Illuminate\Support\Facades\Validator;

class ChatRepository implements ChatInterface
{
    use GeneralTrait;

    public function index($request)
    {
        $chats = ChatRoom::where(function ($q) use ($request) {
            if ($request->q!=null) {
                $q->where('name', 'LIKE', "%$request->q%");
            }
        })->latest()->paginate();

        return view('admin.chats.index', compact('chats'));
    }

    public function create($request)
    {
        return view('admin.chats.create');
    }
    public function store($request)
    {
        $user = User::findOrFail($request->owner);

        $rules = [
            'name'=>"required|max:191",
            'status'=>"required|in:0,1,2",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user->chats()->create([
                "name"            => $request->name,
                "status"          => $request->status,
            ]);
            if ($request->photo) {
                $chat->update(['photo' =>uploadImage('chats', $request->photo)]);
            }
            flash()->success('تم اضافة البيانات', 'عملية ناجحة');
            return redirect()->route('admin.chats.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }


    public function edit($chat)
    {
        return view('admin.chats.edit', compact('chat'));
    }

    public function update($request, $chat)
    {
        $user = User::findOrFail($request->owner);

        $rules = [
            'name'=>"required|max:191",
            'status'=>"required|in:0,1,2",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $chat->update([
                "name"            => $request->name,
                "status"          => $request->status,
            ]);
            if ($request->photo) {
                $chat->update(['photo' =>uploadImage('chats', $request->photo)]);
            }
            flash()->success('تم اضافة البيانات', 'عملية ناجحة');
            return redirect()->route('admin.chats.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }


    public function updateStatus($request, $chat)
    {
        $rules = [
            'status'=>"required|in:0,1,2",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $chat->update([
                "status"          => $request->status,
            ]);

            flash()->success('تم تعديل الحالة', 'عملية ناجحة');
            return back();
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }


    public function destroy($request, $chat)
    {
        try {
            $chat->delete();

            flash()->success('تم حذف البيانات', 'عملية ناجحة');
            return back();
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }
}
