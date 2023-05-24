<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepoInterface\APIs\GeneralAPIInterface;

class GeneralAPI extends Controller
{
    protected $GeneralAPIInterface;

    public function __construct(GeneralAPIInterface $GeneralAPIInterface)
    {
        return $this->GeneralAPIInterface = $GeneralAPIInterface;
    }


    public function home(Request $request)
    {
        return $this->GeneralAPIInterface->home($request);
    }

    public function payment_methods(Request $request)
    {
        return $this->GeneralAPIInterface->payment_methods($request);
    }
    public function mosques(Request $request)
    {
        return $this->GeneralAPIInterface->mosques($request);
    }


    public function offers(Request $request)
    {
        return $this->GeneralAPIInterface->offers($request);
    }

    public function settings(Request $request)
    {
        return $this->GeneralAPIInterface->settings($request);
    }

    public function about(Request $request)
    {
        return $this->GeneralAPIInterface->about($request);
    }

    public function privacy(Request $request)
    {
        return $this->GeneralAPIInterface->privacy($request);
    }

    public function faqs(Request $request)
    {
        return $this->GeneralAPIInterface->faqs($request);
    }

    public function terms_and_conditions(Request $request)
    {
        return $this->GeneralAPIInterface->terms_and_conditions($request);
    }

    public function contact(Request $request)
    {
        return $this->GeneralAPIInterface->contact($request);
    }

}
