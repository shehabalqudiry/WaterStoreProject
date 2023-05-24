<?php

namespace App\RepoInterface\APIs\UserAPIOperations;

interface ProfileAPIInterface
{
    public function update_account($request);
    public function profile($request);
    public function addresses($request);
    public function add_address($request);
    public function update_address($request);
    public function delete_address($request);
    public function deleteaccount($request);

}
