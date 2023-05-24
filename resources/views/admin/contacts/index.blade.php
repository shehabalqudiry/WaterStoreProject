@extends('layouts.app')
@section('content')
    <style type="text/css">
        .ticket-resolved {
            background: #effff0 !important;
        }
    </style>
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 main-box">

            <div class="col-12 px-0">
                <div class="col-12 p-0 row">
                    <div class="col-12 col-lg-4 py-3 px-3">
                        <span class="fas fa-contacts"></span> الاتصالات
                    </div>
                    <div class="col-12 col-lg-4 p-2">
                    </div>
                </div>
                <div class="col-12 divider" style="min-height: 2px;"></div>
            </div>

            {{-- <div class="col-12 py-2 px-2 row">
                <div class="col-12 col-lg-4 p-2">
                    <form method="GET">
                        <input type="text" name="q" class="form-control" placeholder="بحث ... ">
                    </form>
                </div>
            </div> --}}
            <div class="col-12 p-3" style="overflow:auto">
                <div class="col-12 p-0" style="min-width:1100px;">


                    <table class="table table-bordered  table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>المستخدم</th>
                                <th>محتوى التذكرة</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr id="ticket_{{ $contact->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>

                                        @if ($contact->user_id != null)

                                            <a href="{{ route('admin.users.show', $contact->user) }}"
                                                class="d-inline-block text-center">
                                                <img src="{{ $contact->user->getUserAvatar() }}"
                                                    style="width: 45px;height: 45px;display: inline-block;border-radius: 50%!important;padding: 3px;"
                                                    class="mx-auto" alt="صورة المستخدم">
                                                <span style="display: inline-block;position: relative;top: 6px; "
                                                    class="px-2 pt-0  text-start kufi">{{ $contact->user->name }}</span>
                                            </a>
                                        @else
                                            <img src="https://manager.almadarisp.com/user/img/user.png"
                                                style="width: 45px;height: 45px;display: inline-block;border-radius: 50%!important;padding: 3px;"
                                                class="mx-auto" alt="صورة المستخدم">
                                            <span style="display: inline-block;position: relative;top: 6px; "
                                                class="px-2 pt-0  text-start kufi">{{ $contact->name }}<br>{{ $contact->email }}<br>{{ $contact->phone }}</span>


                                        @endif
                                    </td>
                                    <td>
                                        {{ mb_strimwidth($contact->message, 0, 80, '...') }}
                                    </td>

                                    <td>
                                    <a href="{{ route('admin.contacts.show', $contact) }}">
                                        <span class="btn  btn-success btn-sm font-1 mx-1">
                                            <span class="la la-eye"></span> عرض
                                        </span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                                        class="d-inline-block">@csrf @method('DELETE')
                                        <button class="btn  btn-outline-danger btn-sm font-1 mx-1"
                                            onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
                                            <span class="la la-trash"></span> حذف
                                        </button>
                                    </form>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 p-3">
                {{ $contacts->appends(request()->query())->render() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('.toggle-contact-resolving').on('change', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                method: "POST",
                url: "{{ route('admin.contacts.resolve') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(res) {
                if (res.status == "DONE") {
                    $('#ticket_' + id).addClass('ticket-resolved');
                } else {
                    $('#ticket_' + id).removeClass('ticket-resolved');
                }
            });
        });
    </script>
@endsection
