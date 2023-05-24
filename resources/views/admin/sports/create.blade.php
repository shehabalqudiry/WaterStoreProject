@extends('layouts.app', ['page_title' => 'إضافة مستخدم جديد'])
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">


            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.sports.store') }}">
                @csrf
                <div class="col-12 p-0 main-box">
                    <div class="col-12 px-0 card-header">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> إضافة مستخدم جديد
                        </div>
                    </div>
                    <div class="col-12 p-3">
                        <div class="row text-center my-3">
                            <livewire:upload-photo-with-preview />
                            <div class="col-12 p-2">
                                <div class="col-12">
                                    الاسم
                                </div>
                                <div class="col-8 pt-3 mx-auto">
                                    <input type="text" name="title" placeholder="اسم الرياضة" required minlength="3" maxlength="190"
                                        class="form-control" value="{{ old('title') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 p-3">
                    <button class="btn btn-success" id="submitEvaluation">حفظ</button>
                </div>
            </form>
        </div>
    </div>
@endsection
