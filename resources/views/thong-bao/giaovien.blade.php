@extends('layouts.main') @section('title', 'Thông báo') @section('content')
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css" />
@endsection
<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="flaticon-statistics"></i>
                            </span>
                            <h3 class="m-portlet__head-text text-sussces">
                                <span>Click để thêm người nhận thông báo</span>
                                <button class="btn btn-outline-accent m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air" data-toggle="modal" data-target="#m_modal_4">
                                    <i class="la la-user-plus"></i>
                                </button> 
                            </h3>
                                   
                            <h2 class="m-portlet__head-label m-portlet__head-label--accent" style="cursor: pointer" onclick="toBack()">
                                <span class="m-portlet__head-icon text-warning">
                                    <i class="flaticon-bell"></i>
                                </span>
                                <span>Thông báo</span>
                            </h2>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm"
                            role="tablist">
                            <li class="nav-item m-tabs__item">
                                <button class="btn btn-sm m-btn--pill btn-info" id="gui-thong-bao" onclick="postData()">
                                    Gửi thông báo
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <form method="POST" onsubmit="return false" id="formContent">
                        <div class="form-group">
                            <textarea name="title" class="form-control" placeholder="Tiêu đề ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <textarea name="content" class="form-control" id="content" class="ckeditor"></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!--end::Portlet-->
        </div>
    </div>
    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DANH SÁCH GIÁO VIÊN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="table_id" style="with: 100%">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <input type="checkbox" onclick="checkAll(this)" />
                                </th>
                                <th>STT</th>
                                <th>Mã định danh</th>
                                <th>Tên giáo viên</th>
                                <th>Ngày sinh</th>
                                <th>Số điện thoại</th>
                                <th>Giới tính</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp 
                            @forelse ($data as $item)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="checkbox" data-id="{{ $item->user_id }}" />
                                </td>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $item->ma_gv }}</td>
                                <td>{{ $item->ten }}</td>
                                <td>{{ $item->ngay_sinh }}</td>
                                <td>{{ $item->dien_thoai }}</td>
                                <td>
                                    @foreach (config('common.gioi_tinh') as $key => $value) 
                                    @if(isset($item->gioi_tinh) && $item->gioi_tinh == $key)
                                    {{ $value }}
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                            @empty @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="sendToPeoples()">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->
</div>
@endsection @section('script')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function () {
        $("#table_id").dataTable({
            select: true,
            responsive: true,
        });
    });
    var editor = CKEDITOR.replace("content");
    CKEDITOR.config.height = 300;

    const checkAll = (e) => {
        $(e).parents("table").find(".checkbox").not(e).prop("checked", e.checked);
    };

    var toPeoples = [];
    function sendToPeoples() {
        var statusList = $("input[type=checkbox]:checked");
        for (i = 0; i < statusList.length; i++) {
            if (statusList[i].checked && statusList[i].hasAttribute("data-id")) {
            toPeoples.push(parseInt(statusList[i].getAttribute("data-id")));
            }
        }
    }

    function postData() {
        let err_title = $("[name='title']").val() == "" ? false : true;
        let err_content = editor.getData() == "" ? false : true;
        if (!err_title) {
            Swal.fire({
            title: 'Tiêu đề!',
            input: 'text',
            showCloseButton: true,
            showCancelButton: true,
            inputValidator: (value) => {
                    if (!value) {
                        return 'Hãy nhập Tiêu đề!'  
                    }else{
                        $("[name='title']").val(value)
                    }
                }
            })
        } else if (!err_content) {
            Swal.fire({
            position: "top",
            icon: "warning",
            title: "Hãy nhập Nội Dung Thông Báo",
            showConfirmButton: false,
            timer: 3000,
            showCloseButton: true,
            });
        } else if (toPeoples.length <= 0) {
            Swal.fire({
            position: "top",
            icon: "warning",
            title: "Hãy thêm người nhận thông báo",
            showConfirmButton: false,
            timer: 3000,
            showCloseButton: true,
            });
        } else {
            Swal.showLoading()
            $.post(
            "{{ route('sendto_giaovien') }}",
            {
                _token: "{{ csrf_token() }}",
                title: $("[name='title']").val(),
                content: editor.getData(),
                user_id: toPeoples,
                type: 2
            },
            function (response) {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Gửi thông báo thành công!',
                showConfirmButton: false,
                timer: 1500
                })
                console.log(response);
                location.reload()
            }
            );
        }
    }
    function toBack(){
        window.location.href = route('thong-bao.index');
    }
</script>
@endsection
