@extends('layouts.app', ['page_title' => 'إضافة الفيديو'])
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">


            <form id="fileUploadForm" class="row" enctype="multipart/form-data" method="POST"
                action="{{ route('uploadToServer') }}">
                @csrf
                <div class="col-12 p-0 main-box">
                    <div class="col-12 px-0 card-header">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> إضافة الفيديو
                        </div>
                    </div>
                    <div class="col-12 p-3">
                        <div class="form-group">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 0%"></div>
                            </div>
                        </div>
                        <div class="row text-center my-3">
                            {{-- <livewire:upload-photo-with-preview /> --}}
                            <div class="col-12 text-center">
                                <video width="360" controls src="" id="video_prv"></video>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 p-3 mb-3 mx-auto">
                                <div class="col-12">
                                    الفيديو
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="file" name="video" class="form-control" accept="video/*">
                                </div>
                                @error('video')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col-12 p-3">
                            <button class="btn btn-success btn-lg" id="submitEvaluation">رفع الفيديو</button>
                        </div>
                    </div>
                </div>
            </form>

            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.videos.store') }}">
                @csrf
                <div class="col-12 p-0 main-box">
                    <div class="col-12 px-0 card-header">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> بيانات الفيديو
                        </div>
                    </div>
                    <div class="col-12 p-3">

                        <div class="row my-3">
                            <input type="hidden" name="video_path" id="video_path">
                            <div class="col-12 col-md-6 col-lg-4 p-2">
                                <div class="col-12">
                                    عنوان الفيديو
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="text" name="title" required minlength="3" maxlength="190"
                                        class="form-control" value="{{ old('title') }}">
                                </div>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 p-2">
                                <div class="col-12">
                                    وصف الفيديو
                                </div>
                                <div class="col-12 pt-3">
                                    <textarea name="description" maxlength="2500" class="form-control">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 p-2">
                                <div class="col-12">
                                    ناشر الفيديو <a href="{{ route('admin.users.create') }}"
                                        class="btn btn-primary btn-sm"><span class="la la-plus"></span></a>
                                </div>
                                <div class="col-12 pt-3">
                                    <select name="user_id" required class="form-control select2">
                                        @foreach (App\Models\User::get() as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row my-3">
                            <div class="col-12 col-md-6 col-lg-4 p-2">
                                <div class="col-12">
                                    موقع الفيديو
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="text" name="location" required class="form-control"
                                        value="{{ old('location') }}">
                                </div>
                                @error('location')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 p-2">
                                <div class="col-12">
                                    الرياضة <a href="{{ route('admin.sports.create') }}"
                                        class="btn btn-primary btn-sm"><span class="la la-plus"></span></a>
                                </div>
                                <div class="col-12 pt-3">
                                    <select name="sport_id" required class="form-control select2">
                                        @foreach (App\Models\Sport::get() as $sport)
                                            <option value="{{ $sport->id }}">{{ $sport->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('sport_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 p-2">
                                <div class="col-12">
                                    الحالة
                                </div>
                                <div class="col-12 pt-3">
                                    <select name="status" required class="form-control">
                                        <option value="0">قيد المراجعه</option>
                                        <option value="1">موافقة</option>
                                        <option value="2">رفض</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col-12 p-3">
                            <button class="btn btn-success btn-lg" id="submitEvaluation">حفظ</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <script>
        $(function() {
            $(document).ready(function() {
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function() {
                        var percentage = '0';
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage + '%', function() {
                            $(this).attr("aria-valuenow", percentage) + "%";
                            $(this).attr("value", percentage);
                            return;
                        })
                    },
                    complete: function(data) {
                        $("#video_path").attr('value', data.responseJSON.path);
                        $("#video_prv").attr('src', "/" + data.responseJSON.path);
                    }
                });
            });
        });
    </script>
@endsection
