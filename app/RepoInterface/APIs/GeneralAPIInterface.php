<?php

namespace App\RepoInterface\APIs;

interface GeneralAPIInterface
{
    public function home($request);
    public function offers($request);
    public function payment_methods($request);
    public function mosques($request);
    public function settings($request);
    public function contact($request);
    public function terms_and_conditions($request);
    public function about($request);
    public function privacy($request);
    public function faqs($request);

}
