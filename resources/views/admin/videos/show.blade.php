@extends('layouts.app')
@section('content')
    <div class="col-12 py-3">
        <div class="container">
            <div class="p-3 main-box mx-auto" style="width:100%;max-width: 100%;">
                <div class="d-flex align-items-center justify-content-center py-4">
                    <div class="col-12 d-flex justify-content-center align-items-center mx-auto " style="width:100%">
                        <div class="col-12 p-0 text-center">
                            <video controls src="{{ asset($video->path) }}" style="width:80%;max-width: 100%;"
                                class="d-inline-block"></video>
                            <div class="col-12 font-3 text-center py-2">
                                {{ $video->title }}
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-12 p-0">
                    <table class="table table-bordered table-striped rounded table-hover">
                        <tbody>
                            <tr>
                                <td>العنوان</td>
                                <td>{{ $video->title }}</td>
                            </tr>

                            <tr>
                                <td>نبذة</td>
                                <td>
                                    {{ $video->description }}
                                </td>
                            </tr>

                            <tr>
                                <td>تحكم</td>
                                <td>
                                    @if ($video->status == 2)
                                        <form action="{{ route('admin.videos.updateStatus', $video->id) }}"
                                            class="btn btn-sm" method="post" id="updateAc{{ $video->id }}"
                                            onclick="document.getElementById('updateAc{{ $video->id }}').submit()">
                                            {{-- @method('PUT') --}}
                                            @csrf
                                            <button href='#' class="btn btn-sm btn-outline-success">
                                                <i class="la la-check" aria-hidden="true"></i> قبول
                                            </button>
                                            <input name="status" hidden value="1">
                                            {{-- </div> --}}
                                        </form>
                                    @endif
                                    @if ($video->status == 1)
                                        <form action="{{ route('admin.videos.updateStatus', $video->id) }}"
                                            class="btn btn-sm" method="post" id="updateRe{{ $video->id }}"
                                            onclick="document.getElementById('updateRe{{ $video->id }}').submit()">
                                            {{-- @method('PUT') --}}
                                            @csrf
                                            <button href='#' class="btn btn-sm btn-outline-danger">
                                                <i class="la la-times" aria-hidden="true"></i> رفض
                                            </button>
                                            <input name="status" hidden value="2">
                                            {{-- </div> --}}
                                        </form>
                                    @endif
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>

                <div class="row d-flex justify-content-center my-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4 class="card-title text-success">التعليقات</h4>
                            </div>
                            <div class="card-body">
                                @forelse ($video->comments as $comment)
                                    <!-- Comment Row -->
                                    <div class="d-flex flex-row comment-row m-t-0">
                                        <div class="p-2"><img
                                                src="{{ $comment->user->photo ?? 'https://i.imgur.com/Ur43esv.jpg' }}"
                                                alt="user" width="50" class="rounded-circle"></div>
                                        <div class="comment-text w-100">
                                            <h6 class="font-medium">{{ $comment->user->name ?? 'Deleted User' }}</h6>
                                            <span class="m-b-15 d-block">{{ $comment->comment }}</span>
                                            <div class="comment-footer"> <span
                                                    class="text-muted float-right">{{ $comment->created_at }}</span>
                                            </div>
                                        </div>
                                    </div> <!-- Comment Row -->
                                @empty
                                    لاتوجد تعليقات
                                @endforelse
                            </div> <!-- Card -->
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center my-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4 class="card-title text-danger">الابلاغات عن الفيديو</h4>
                            </div>
                            <div class="card-body">
                                @forelse ($video->reports as $report)
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row m-t-0">
                                    <div class="p-2"><img
                                            src="{{ $report->user->photo ?? 'https://i.imgur.com/Ur43esv.jpg' }}"
                                            alt="user" width="50" class="rounded-circle"></div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">{{ $report->user->name ?? 'Deleted User' }}</h6>
                                        <span class="m-b-15 d-block">{{ $report->report }}</span>
                                        <div class="comment-footer"> <span
                                                class="text-muted float-right">{{ $report->created_at }}</span>
                                        </div>
                                    </div>
                                </div> <!-- Comment Row -->
                            @empty
                                لاتوجد ابلاغات
                            @endforelse
                            </div> <!-- Card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
