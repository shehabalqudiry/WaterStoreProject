<?php

namespace App\Repository\APIs;

use App\Models\Cart;
use App\Models\User;
use App\Traits\GeneralTrait;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\RepoInterface\APIs\AuthInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthRepository implements AuthInterface
{
    use GeneralTrait;

    public function register($request)
    {
        $rules = [
            'name'=>"nullable|max:255",
            'phone'=>"required|unique:users,phone",
            'password'=>"required|min:8|max:255",
            'fcm_token'=>"nullable",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        try {
            $user = User::create([
                "type"=>$request->type ?? 0,
                "name"=>$request->name,
                "phone"=>$request->phone,
                "password"=> Hash::make($request->password),
                "fcm_token"=>$request->fcm_token,
                "long"=>$request->long,
                "lat"=>$request->lat,
            ]);
            Cart::create([
                'user_id' => $user->id
            ]);

            if (!$user) {
                return $this->returnError('001', 'حدث خطأ اثناء انشاء الحساب');
            }

            if ($request->photo) {
                $user->update(['photo' =>uploadImage('profiles', $request->photo)]);
            }

            $credentials = $request->only(['phone', 'password']);
            $token = auth('user')->attempt($credentials);

            $token = $user->createToken($request->ip())->plainTextToken;

            $user->api_key = $token;
            $data = new UserResource($user);
            return $this->returnData('data', $data, 'تمت العملية بنجاح');
        } catch (\Exception $e) {
            return $this->returnError('001', $e->getMessage());
        }
    }


    public function login($request)
    {
        try {
            $rules = [
                    "phone"     => "required",
                    "password"  => "required",
                    "fcm_token" => "nullable",

                ];

            $validator = Validator::make($request->all(), $rules, [
                    'phone.required' => 'حقل الهاتف مطلوب',
                    'password.required' => 'حقل كلمة السر مطلوب',
                ]);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            if (!auth('user')->attempt($request->only('phone', 'password'))) {
                return $this->returnError(402, "خطأ في رقم الهاتف او كلمة المرور");
            }

            $user = User::find(auth('user')->user()->id);
            if($user->deleted_at != null)
            {
                $errormessage = 'حساب محذوف';
                return $this->returnError('019',$errormessage);
            }
            if($user->status != 1)
            {
                $errormessage = 'تم إيقاف الحساب مؤقتا تواصل مع الادارة لحل الامر';
                return $this->returnError('020',$errormessage);
            }
            $user->update([
                'fcm_token'=> $request->fcm_token,
            ]);
            $token = $user->createToken($request->password)->plainTextToken;
            $user->api_key = $token;
            $data = new UserResource($user);
            return $this->returnData('data', $data, 'تسجيل دخول ناجح');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function logout($request)
    {
        auth('user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return "Done";
    }

    public function sendReset($request)
    {
        $data = $request->all();

        $rules = [
            'phone' => "required|exists:users,phone",
        ];
        //validation
        $validator = validator()->make($data, $rules);

        //validation failure

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $code = rand(111111, 999999);
            $update = $user->update(['pin_code' => $code]);
            if ($update) {
                // sendCode($user->phone, $code);
            }
            $data = [
                'pin_code' => $user->pin_code,
            ];
            return $this->returnData('data', $data, "تم ارسال الكود بنجاح");
        }

        return $this->returnError("CODE00", "البيانات غير صحيحة");
    }

    public function checkCode($request)
    {
        $rules = [
            'phone' => "required|exists:users,phone",
            'pin_code' => "required",
        ];
        //validation
        $validator = validator()->make($request->all(), $rules);

        //validation failure

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $user = User::where(['phone' => $request->phone, 'pin_code' => $request->pin_code])->first();
        if ($user) {
            return $this->returnSuccessMessage("الكود صحيح", "CODE01");
        }

        return $this->returnError("CODE00", "الكود غير صحيح");
    }

    public function reset($request)
    {
        $rules = [
            'phone' => "required|exists:users,phone",
            'pin_code' => "required",
            'password' => "required|min:8",
        ];
        //validation
        $validator = validator()->make($request->all(), $rules);

        //validation failure

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $user = User::where(['phone' => $request->phone, 'pin_code' => $request->pin_code])->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password),
                'pin_code' => null,
            ]);
            return $this->returnData('data', $user, "تم تغير كلمة المرور بنجاح");
        }

        return $this->returnError("CODE00", "الكود غير صحيح");
    }
}
