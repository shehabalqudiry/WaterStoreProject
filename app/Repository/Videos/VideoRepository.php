<?php

namespace App\Repository\Videos;

use App\Models\Video;
use Illuminate\Http\Request;
use App\RepoInterface\Videos\VideoInterface;
use Illuminate\Support\Facades\Validator;

class VideoRepository implements VideoInterface
{
    public function index($request)
    {
        $videos = Video::where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
            if ($request->q!=null) {
                $q->where('title', 'LIKE', '%'.$request->q.'%')->orWhere('description', 'LIKE', '%'.$request->q.'%');
            }
        })->latest()->paginate();
        return view('admin.videos.index', compact('videos'));
    }


    public function create()
    {
        return view('admin.videos.create');
    }

    public function uploadToServer($request)
    {
        $request->validate([
            'video' => 'required|mimes:3gp,avi,mp4,wmv,m3u8,mov'
        ]);
        $video_path = uploadImage("videos", $request->video);

        return response()->json(['success'=>'Successfully uploaded.', 'path' => $video_path]);
    }

    public function store($request)
    {
        $rules = [
            'title'=>"required|max:255",
            'location'=>"required",
            'sport_id'=>"required",
            'user_id'=>"required",
            'video_path'=> "required",
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $video = Video::create([
                "title"=>$request->title,
                "description"=>$request->description,
                "location"=>$request->location,
                "sport_id"=>$request->sport_id,
                "user_id"=>$request->user_id,
                "path"=> $request->video_path,
                "status"=>$request->status,
            ]);

            if (!$video) {
                flash()->error('حدث خطأ اثناء انشاء الحساب', 'عملية فاشلة');
                return back();
            }
            flash()->success('تم إضافة المستخدم', 'عملية ناجحة');
            return redirect()->route('admin.videos.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    public function show($video)
    {
        return view('admin.videos.show', compact('video'));
    }

    public function edit($video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update($request, $video)
    {
        $rules = [
            'title'=>"required|max:255",
            'location'=>"required",
            'sport_id'=>"required",
            'user_id'=>"required",
            'video_path'=> "required",x
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $video->update([
                "title"=>$request->title,
                "description"=>$request->description,
                "location"=>$request->location,
                "sport_id"=>$request->sport_id,
                "user_id"=>$request->user_id,
                "path"=> $request->video_path,
                "status"=>$request->status,
            ]);

            flash()->success('تم تعديل بيانات المستخدم', 'عملية ناجحة');
            return redirect()->route('admin.videos.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    public function updateStatus($request, $video)
    {
        $rules = [
            'status'=>"required|in:0,1,2",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $video->update([
                "status"          => $request->status,
            ]);

            flash()->success('تم تعديل بيانات المستخدم', 'عملية ناجحة');
            return redirect()->route('admin.videos.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    public function destroy($video)
    {
    }
}
