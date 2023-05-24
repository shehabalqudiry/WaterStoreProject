<?php

namespace App\Repository\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\RepoInterface\Users\UserInterface;
use Illuminate\Support\Facades\Validator;

class UserRepository implements UserInterface
{
    public function index($request)
    {
        $users = User::where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
            if ($request->q!=null) {
                $q->where('name', 'LIKE', '%'.$request->q.'%')->orWhere('phone', 'LIKE', '%'.$request->q.'%');
            }
        })->latest()->get();
        return view('admin.users.index', compact('users'));
    }


    public function best($request)
    {
        $users = User::where('best', '!=', null)->latest('updated_at')->paginate();
        return view('admin.users.best', compact('users'));
    }

    public function post_best($request)
    {
        $rules = [
            'user_id' => "required|exists:users,id",
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $user = User::findOrFail($request->user_id)->update([
                "best" => 1,
                "updated_at" => now(),
            ]);

            if (!$user) {
                flash()->error('حدث خطأ اثناء انشاء الحساب', 'عملية فاشلة');
                return back();
            }

            flash()->success('تم إضافة المستخدم إلي القائمة', 'عملية ناجحة');
            return redirect()->route('admin.users.best');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    public function delete_best($request)
    {
        $rules = [
            'user_id' => "required|exists:users,id",
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $user = User::findOrFail($request->user_id)->update([
                "best" => null,
            ]);

            if (!$user) {
                flash()->error('حدث خطأ', 'عملية فاشلة');
                return back();
            }

            flash()->success('تم حذف المستخدم من القائمة', 'عملية ناجحة');
            return redirect()->route('admin.users.best');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }


    public function create()
    {
        return view('admin.users.create');
    }

    public function store($request)
    {
        $rules = [
            'name'=>"required|max:255",
            'berth_day'=>"nullable|date_format:Y-m-d",
            'gender'=>"required|in:male,female",
            'phone'=>"required|unique:users,phone",
            'password'=>"required|min:8|max:255",
            'fcm_token'=>"nullable",
            'facebook'=>"nullable|url",
            'twitter'=>"nullable|url",
            'instagram'=>"nullable|url",
            'youtube'=>"nullable|url",
            'snapchat'=>"nullable|url",
            'telegram'=>"nullable|url",
            'whatsapp'=>"nullable|url",
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $user = User::create([
                "name"=>$request->name,
                "status"=>$request->status,
                "phone"=>$request->phone,
                "password"=>\Hash::make($request->password),
                "type"=>$request->type ?? 0,
                "photo"=> $request->photo ? uploadImage("users", $request->photo) : "default.png",
            ]);

            if (!$user) {
                flash()->error('حدث خطأ اثناء انشاء الحساب', 'عملية فاشلة');
                return back();
            }
            if ($request->photo) {
                $user->update(['photo' =>uploadImage('profiles', $request->photo)]);
            }
            flash()->success('تم إضافة المستخدم', 'عملية ناجحة');
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    public function show($user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit($user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update($request, $user)
    {
        $rules = [
            'name'=>"required|max:255",
            'phone'=>"required|unique:users,phone," . $user->id,
            'password'=>"nullable|min:8|max:120",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user->update([
                "name"          => $request->name,
                "status"          => $request->status,
                "phone"         => $request->phone,
                "email"         => $request->email,
                "password"      => $request->password ? \Hash::make($request->password) : $user->password,
                "photo"         => $request->photo ? uploadImage("users", $request->photo) : $user->photo,
                "type"          => $request->type ?? 0,
            ]);

            if ($request->photo) {
                $user->update(['photo' =>uploadImage('profiles', $request->photo)]);
            }
            flash()->success('تم تعديل بيانات المستخدم', 'عملية ناجحة');
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    public function destroy($user)
    {
        try {
            $user->delete();
            flash()->success('تم حذف المستخدم', 'عملية ناجحة');
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    public function sendNotify($request)
    {
        try {
            if ($request->users == 'All') {
                foreach (User::get() as $user) {
                    sendmessage($user->fcm_token, $request->title, $request->body);
                }
            } else {
                $user = User::find($request->users);
                sendmessage($user->fcm_token, $request->title, $request->body);
            }

            flash()->success('تم الإرسال بنجاح', 'عملية ناجحة');
            return back();
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }
}
