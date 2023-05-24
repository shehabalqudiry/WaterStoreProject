<?php

namespace App\RepoInterface\APIs;

interface ChatAPIInterface
{
    public function create_room($request);
    public function add_room_users($request);
    public function delete_room_user($request);
    public function add_room_admins($request);
    public function delete_room_admin($request);
    public function rooms($request);
    public function get_room($request);
    public function update_room($request);
    public function delete_room($request);
}
