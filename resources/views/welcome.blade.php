<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
        @if (request()->city)
        {{ App\Models\City::where('id', request()->city)->first()->name ?? ' كل المحافظات' }}
        @endif
        @if (request()->type)
         {{ App\Models\Type::where('id', request()->type)->first()->name ?? 'الكل ' }}
        @endif
    </title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('assets') }}/css/ready.css">
	<link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.css"/>
    <style>
        .main-panel {
            position: relative;
            width: 100%;
            min-height: 100%;
            float: left;
            background: #f2f3f8;
        }
    </style>
</head>
<body>
	<div class="wrapper">
		<div class="main-panel">
            <div class="content">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">الوحدات</div>
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
                                    @forelse ($projects as $project)
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
                                    @empty
                                    لاتوجد بيانات
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
				</div>
			</div>
            @include('layouts.footer')
		</div>
	</div>

</body>
<script src="{{ asset('assets') }}/js/core/jquery.3.2.1.min.js"></script>
<script src="{{ asset('assets') }}/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
<script src="{{ asset('assets') }}/js/plugin/chartist/chartist.min.js"></script>
<script src="{{ asset('assets') }}/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="{{ asset('assets') }}/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="{{ asset('assets') }}/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="{{ asset('assets') }}/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ asset('assets') }}/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="{{ asset('assets') }}/js/plugin/chart-circle/circles.min.js"></script>
<script src="{{ asset('assets') }}/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/ready.min.js"></script>

{{-- <script src="{{ asset('assets') }}/js/demo.js"></script> --}}
<script src="https://cdn.rtlcss.com/bootstrap/v4.0.0/js/bootstrap.min.js"></script>

</html>
