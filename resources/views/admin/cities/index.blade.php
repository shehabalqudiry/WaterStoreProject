@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">المحافظات</div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUpdate">
        اضافة
        </button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم المحافظة</th>
                    <th scope="col">تحكم</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cities as $city)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $city->name }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Update{{ $city->id }}">
                            تعديل
                        </button>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="Update{{ $city->id }}" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title"><i class="la la-frown-o"></i> تعديل {{ $city->name }}</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('cities.update', $city->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="modal-body text-center">
                                    <input type="text" class="form-control" name="name" value="{{ $city->name }}" placeholder="اسم المحافظة">
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
            <form action="{{ route('cities.store') }}" method="post">
                @csrf
                <div class="modal-body text-center">
                    <input type="text" class="form-control" name="name" placeholder="اسم المحافظة">
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
