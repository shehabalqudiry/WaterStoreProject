@extends('layouts.app', ['page_title' => 'تعديل المستخدم'])
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">


            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.sports.update', $sport) }}">
                @csrf
                @method('PUT')
                <div class="col-12 p-0 main-box">
                    <div class="col-12 px-0 card-header">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> تعديل المستخدم
                        </div>
                    </div>
                    <div class="col-12 p-3">
                        <div class="row text-center">
                            <livewire:upload-photo-with-preview :user="$sport" />
                            <div class="col-12 p-2">
                                <div class="col-12">
                                    الاسم
                                </div>
                                <div class="col-8 mx-auto pt-3">
                                    <input type="text" name="title" required minlength="3" maxlength="190"
                                        class="form-control" value="{{ $sport->title }}">
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
