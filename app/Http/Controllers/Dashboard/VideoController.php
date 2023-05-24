<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepoInterface\Videos\VideoInterface;

class VideoController extends Controller
{
    protected $VideoInterface;

    public function __construct(VideoInterface $VideoInterface)
    {
        return $this->VideoInterface = $VideoInterface;
    }

    public function index(Request $request)
    {
        return $this->VideoInterface->index($request);
    }

    public function create()
    {
        return $this->VideoInterface->create();
    }

    public function store(Request $request)
    {
        return $this->VideoInterface->store($request);
    }

    public function show(Video $video)
    {
        return $this->VideoInterface->show($video);
    }

    public function edit(Video $video)
    {
        return $this->VideoInterface->edit($video);
    }

    public function update(Request $request, Video $video)
    {
        return $this->VideoInterface->update($request, $video);
    }

    public function updateStatus(Request $request, Video $video)
    {
        return $this->VideoInterface->updateStatus($request, $video);
    }

    public function uploadToServer(Request $request)
    {
        return $this->VideoInterface->uploadToServer($request);
    }

    public function destroy(Video $video)
    {
        return $this->VideoInterface->destroy($video);
    }
}
