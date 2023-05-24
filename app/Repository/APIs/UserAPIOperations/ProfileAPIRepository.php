<?php

namespace App\Repository\APIs\UserAPIOperations;

use Hash;
use App\Models\User;
use App\Models\Video;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use App\RepoInterface\APIs\UserAPIOperations\ProfileAPIInterface;

class ProfileAPIRepository implements ProfileAPIInterface
{
    use GeneralTrait;


    public function profile($request)
    {
        if ($request->user_id) {
            $user = User::find($request->user_id);
            if (!$user) {
                return $this->returnError(404, 'المستخدم غير موجود');
            }
        } else {
            $user = $request->user();
        }

        $data = [
            'my_data' => $user,
        ];

        return $this->returnData('data', $data, 'الصفحة الشخصية');
    }

    public function update_account($request)
    {
        $user = auth('user_api')->user();
        $rules = [
            'name'=>"nullable|max:255",
            'email'=>"nullable|unique:users,email,". $user->id,
            'phone'=>"nullable|unique:users,phone,". $user->id,
            'password'=>"nullable|min:8|max:255",
            'fcm_token'=>"nullable",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError("0000", $validator->errors()->first());
        }
        try {
            $user->update([
                "name"          => $request->name ?? $user->name,
                "email"         => $request->email ?? $user->email,
                "phone"         => $request->phone ?? $user->phone,
                "password"      => $request->password ? Hash::make($request->password) : $user->password,
                "fcm_token"     => $request->fcm_token  ?? $user->fcm_token,
                "long"          => $request->long ?? $user->long,
                "lat"           => $request->lat ?? $user->lat,
            ]);


            if ($request->photo) {
                $user->update(['photo' =>uploadImage('profiles', $request->photo)]);
            }

            return $this->returnSuccessMessage('تم التعديل بنجاح', "0000");
        } catch (\Exception $e) {
            return $this->returnError('001', $e->getMessage());
        }
    }

    public function addresses($request)
    {
        $user = $request->user();
        $data = $user->addresses()->get();
        return $this->returnData('data', $data, 'العناوين');
    }
    public function add_address($request)
    {
        $user = $request->user();
        $data = $user->addresses()->create([
            "user_id"   => $user->id,
            "country"   => $request->country,
            "city"      => $request->city,
            "region"    => $request->region,
            "street"    => $request->street,
            "lat"       => $request->lat,
            "lon"       => $request->lon,
        ]);
        return $this->returnData('data', $data, 'تم اضافة العنوان بنجاح');
    }
    public function update_address($request)
    {
        $user = $request->user();

        $address = $user->addresses()->where('id', $request->address_id)->update([
            "country"   => $request->country,
            "city"      => $request->city,
            "region"    => $request->region,
            "street"    => $request->street,
            "lat"       => $request->lat,
            "lon"       => $request->lon,
        ]);
        $data = $user->addresses()->get();
        return $this->returnData('data', $data, 'تم تعديل العنوان');
    }
    public function delete_address($request)
    {
        $user = $request->user();
        $address = $user->addresses()->where('id', $request->address_id)->first()->delete();
        $data = $user->addresses()->get();
        return $this->returnData('data', $data, 'تم حذف العنوان');
    }

    public function deleteaccount($request)
    {
        $user = $request->user();

        if($user)
        {
            if($user->deleted_at != null)
            {
                $errormessage = 'تم ازالة الحساب مسبقاً';
                return $this->returnSuccessMessage($errormessage);
            }
            $user->deleted_at = now();
            $user->save();
            $user->currentAccessToken()->delete();
            $errormessage = 'تم ازالة الحساب';
            return $this->returnSuccessMessage($errormessage);
        }
        else
        {
            $errormessage ='البيانات غير صحيحة';
            return $this->returnError(404,$errormessage);
        }

    }
}
