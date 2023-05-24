<?php

namespace App\Repository\APIs;

use App\Models\Offer;
use App\Models\Slider;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Mosque;
use App\Models\Product;
use App\Traits\GeneralTrait;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Validator;
use App\RepoInterface\APIs\GeneralAPIInterface;

class GeneralAPIRepository implements GeneralAPIInterface
{
    use GeneralTrait;

    public function home($request)
    {
        $products = Product::where('status', 0)->where(function ($q) use ($request) {
            if ($request->company_id !== null) {
                $q->where('company_id', $request->company_id);
            }

            if ($request->user() !== null) {
                $q->where([['long', '<=>', $request->user()->long], ['lat', '<=>', $request->user()->lat]]);
            }

            if ($request->q !== null) {
                $q->whereLike('title', "%$request->q%")->orWhereLike('description', "%$request->q%");
            }
        })->where('type', 0)->latest()->get();

        $products2 = Product::where('status', 0)->where(function ($q) use ($request) {
            if ($request->company_id !== null) {
                $q->where('company_id', $request->company_id);
            }

            if ($request->user() !== null) {
                $q->where([['long', '<=>', $request->user()->long], ['lat', '<=>', $request->user()->lat]]);
            }

            if ($request->q !== null) {
                $q->whereLike('title', "%$request->q%")->orWhereLike('description', "%$request->q%");
            }
        })->where('type', 1)->latest()->get();

        $data = [
            "long" => number_format(auth('user_api')->user()->long ?? 0, 8),
            "lat" => number_format(auth('user_api')->user()->lat ?? 0, 8),
            "Sliders" => Slider::latest()->get(),
            "Companies" => Company::latest()->get(),
            "HomeProducts" => $products,
            "MosqueProducts" => $products2
        ];
        return $this->returnData('data', $data, 'الرئيسية');
    }

    public function payment_methods($request)
    {
        $data = PaymentMethod::latest()->get();
        return $this->returnData('data', $data, 'طرق الدفع');
    }

    public function mosques($request)
    {
        $data = Mosque::latest()->get();
        return $this->returnData('data', $data, 'المساجد');
    }

    public function offers($request)
    {
        $data = Offer::latest()->get();
        return $this->returnData('data', $data, 'العروض');
    }

    public function settings($request)
    {
        $data = settings();
        return $this->returnData('data', $data, 'الاعدادات');
    }

    public function contact($request)
    {
        $rules = [
            'name'=>"required|min:3|max:190",
            'email'=>"nullable|email",
            "phone"=>"required",
            "message"=>"required|min:3|max:10000",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        Contact::create([
            'user_id'=>auth()->check() ? auth()->id() : null,
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=> /*"قادم من : ".urldecode(url()->previous())."\n\nالرسالة : ".*/$request->message
        ]);

        return $this->returnSuccessMessage('تم استلام رسالتك بنجاح وسنتواصل معك في أقرب وقت', 'تحت المراجعه');
    }

    public function faqs($request)
    {
        $data = settings()->faqs ?? "NA";
        return $this->returnData('data', $data, 'الاسئلة الشائعه');
    }

    public function terms_and_conditions($request)
    {
        $data = settings()->terms_and_conditions ?? "NA";
        return $this->returnData('data', $data, 'الشروط والاحكام');
    }


    public function privacy($request)
    {
        $data = settings()->privacy_page ?? "NA";
        return $this->returnData('data', $data, 'سياسة الخصوصية والاستخدام');
    }

    public function about($request)
    {
        $data = [
            "about"            => settings()->bio ?? "NA",
        ];

        return $this->returnData('data', $data, 'من نحن');
    }

}
