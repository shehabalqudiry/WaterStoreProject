@extends('layouts.app')
@section('title')
@if (request()->city)
{{ App\Models\City::where('id', request()->city)->first()->name ?? ' كل المحافظات' }}
@endif
@if (request()->type)
 {{ App\Models\Type::where('id', request()->type)->first()->name ?? 'الكل ' }}
@endif
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">الوحدات</div>

        <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#modalUpdate">
        اضافة
        </button>
    </div>
    <div class="card-body">
        <div class="form-group">
            <form action="" method="get">
                <select name="city" onchange="submit()" class="form-control d-inline-block w-25">
                    <option value="">الكل</option>
                    @foreach (App\Models\City::get() as $cityS)
                    <option {{ request()->city == $cityS->id ? 'selected' : '' }} value="{{ $cityS->id }}">{{ $cityS->name }}</option>
                    @endforeach
                </select>
                <select name="type" onchange="submit()" class="form-control d-inline-block w-25">
                    <option value="">الكل</option>
                    @foreach (App\Models\Type::get() as $typeS)
                    <option {{ request()->type == $typeS->id ? 'selected' : '' }} value="{{ $typeS->id }}">{{ $typeS->name }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <table class="table table-bordered datatable">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">نوع الوحدة</th>
                    <th scope="col">الـدور</th>
                    <th scope="col">الـبيان</th>
                    <th scope="col">المـوقع</th>
                    <th scope="col">تأمين دخول الصفقة</th>
                    <th scope="col">المساحة</th>
                    <th scope="col">السعر الأساسي</th>
                    <th scope="col">سعر البيع</th>
                    {{-- <th scope="col">تحكم</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $project->unit_type }}</td>
                    <td>{{ $project->floor }}</td>
                    <td>{{ $project->statement }}</td>
                    <td>{{ $project->location }}</td>
                    <td>{{ $project->rent_insurance }}</td>
                    <td>{{ $project->area }}</td>
                    <td>{{ $project->rent }}</td>
                    <td>{{ $project->sale_price }}</td>
                    {{-- <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Update{{ $project->id }}">
                            تعديل
                        </button>
                    </td> --}}
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="Update{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title"><i class="la la-frown-o"></i> تعديل {{ $project->name }}</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('projects.update', $project->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="modal-body text-center">
                                    <input type="text" class="form-control" name="name" value="{{ $project->name }}" placeholder="انواع البيانات">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                    <button type="submit" class="btn btn-success" >تحديث</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><i class="la la-frown-o"></i> اضافة</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('projects.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body text-center">
                    <div class="row form-group">
                        <label>الملف</label>
                        <input type="file" class="form-control" name="fileImport" >
                    </div>
                    <div class="row form-group">
                        <label>المحافظة</label>

                        <select class="form-control" name="city_id" required>
                            @foreach (App\Models\City::get() as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row form-group">
                        <label>نوع الوحدات</label>

                        <select class="form-control" name="type_id">
                            @foreach (App\Models\Type::get() as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-success" >اضافة</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
