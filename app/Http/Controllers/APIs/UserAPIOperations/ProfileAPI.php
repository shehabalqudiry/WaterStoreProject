<?php

namespace App\Http\Controllers\APIs\UserAPIOperations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepoInterface\APIs\UserAPIOperations\ProfileAPIInterface;

class ProfileAPI extends Controller
{
    protected $ProfileAPIInterface;

    public function __construct(ProfileAPIInterface $ProfileAPIInterface)
    {
        return $this->ProfileAPIInterface = $ProfileAPIInterface;
    }


    public function profile(Request $request)
    {
        return $this->ProfileAPIInterface->profile($request);
    }

    public function update_account(Request $request)
    {
        return $this->ProfileAPIInterface->update_account($request);
    }

    public function upload_video(Request $request)
    {
        return $this->ProfileAPIInterface->upload_video($request);
    }

    public function make_follow(Request $request)
    {
        return $this->ProfileAPIInterface->make_follow($request);
    }

    public function addresses(Request $request)
    {
        return $this->ProfileAPIInterface->addresses($request);
    }

    public function add_address(Request $request)
    {
        return $this->ProfileAPIInterface->add_address($request);
    }

    public function update_address(Request $request)
    {
        return $this->ProfileAPIInterface->update_address($request);
    }

    public function delete_address(Request $request)
    {
        return $this->ProfileAPIInterface->delete_address($request);
    }

    public function deleteaccount(Request $request)
    {
        return $this->ProfileAPIInterface->deleteaccount($request);
    }
}
