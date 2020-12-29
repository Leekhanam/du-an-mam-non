@extends('layouts.main') @section('title', 'Thông báo') @section('content')
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
<style>
    @media (min-width: 992px) { 
        .modal-hs {
            max-width: 1200px;
        }
    }
</style>
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
                                <div class="input-group input-group-sm">
                                    <select class="form-control m-input form-control-sm" name="nguoinhan"
                                        id="nguoinhan">
                                        <option value="1">Toàn Trường</option>
                                        <option value="2">Giáo Viên</option>
                                        <option value="3">Phụ Huynh</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button id="show-btn-add-gv"
                                            class="btn btn-outline-accent m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air d-none"
                                            data-toggle="modal" data-target="#m_modal_gv">
                                            <i class="la la-user-plus"></i>
                                        </button>
                                        <button id="show-btn-add-hs"
                                            class="btn btn-outline-accent m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air d-none"
                                            data-toggle="modal" data-target="#m_modal_hs">
                                            <i class="la la-user-plus"></i>
                                        </button>
                                    </div>
                                    <span style="visibility: hidden">Click để thêm người nhận thông báo</span>
                                </div>
                            </h3>

                            <h2 class="m-portlet__head-label m-portlet__head-label--danger" style="cursor: pointer" onclick="toBack()">
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
                                <button class="btn btn-sm m-btn--pill btn-info" id="gui-thong-bao">
                                    Gửi thông báo
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <form action="" method="post" onsubmit="">

                        <div class="form-group">
                            <textarea name="title" class="form-control" placeholder="Tiêu đề ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <textarea name="content" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!--end::Portlet-->
        </div>
    </div>
    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_gv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <table id="table_gv" style="with: 100%">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <input type="checkbox" onclick="checkAll1(this)" />
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
                            @forelse ($gv as $item)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="checkbox checkbox1 checkbox_gv" data-id="{{ $item->user_id }}"/>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="sendToPeoplesGv()">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="m_modal_hs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-hs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DANH SÁCH HỌC SINH</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body container-sm container-md container-lg container-xl">
                    <div class="table-responsive">
                        <table id="table_hs" style="with: 100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" onclick="checkAll2(this)"></th>
                                    <th>STT</th>
                                    <th>Khối</th>
                                    <th>Lớp</th>
                                    <th>Mã</th>
                                    <th>Tên Học sinh</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                </tr>
                            </thead>
                            <thead class="filter">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <select class="form-control" id="field_khoi" style="width: 120px;">
                                            <option value="">Chọn Khối</option>
                                            @foreach ($data->Khoi as $itemKhoi)
                                            <option>{{ $itemKhoi->ten_khoi }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" id="field_lop" style="width: 120px;">
                                            <option value="">Chọn Lớp</option>
                                            @foreach ($data->Khoi as $itemKhoi)
                                            @foreach ($itemKhoi->LopHoc as $itemLopHoc)
                                            <option>{{ $itemLopHoc->ten_lop }}</option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input class="form-control" type="text" id="field_ma" style="width: 70px;"></td>
                                    <td><input class="form-control" type="text" id="field_ten" style="width: 120px;"></td>
                                    <td><input class="form-control" type="text" id="field_ngay_sinh" style="width: 100px;"></td>
                                    <td>
                                        <select class="form-control" id="field_gioi_tinh" style="width: 90px;">
                                            <option value="">Chọn</option>
                                            @foreach (config('common.gioi_tinh') as $value => $key)
                                            <option>{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @forelse ($data->Khoi as $itemKhoi)
                                @forelse ($itemKhoi->LopHoc as $itemLopHoc)
                                @forelse ($itemLopHoc->HocSinh as $itemHocSinh)
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="checkbox checkbox2 checkbox_hs"
                                            data-id="{{ $itemHocSinh->id }}"
                                            data-device="{{ $itemHocSinh->User && $itemHocSinh->User->device ? $itemHocSinh->User->device : 'gg' }}"
                                            data-lop_id="{{ $itemHocSinh->lop_id }}"></td>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td>{{ $itemKhoi->ten_khoi }}</td>
                                    <td>{{ $itemLopHoc->ten_lop }}</td>
                                    <td>{{ $itemHocSinh->ma_hoc_sinh }}</td>
                                    <td>{{ $itemHocSinh->ten }}</td>
                                    <td>{{ $itemHocSinh->ngay_sinh }}</td>
                                    <td>
                                        @foreach (config('common.gioi_tinh') as $key => $value)

                                        @if(isset($itemHocSinh->gioi_tinh) && $itemHocSinh->gioi_tinh == $key)
                                        {{$value}}
                                        @endif

                                        @endforeach
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                                @empty
                                @endforelse
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <label for="">
                        Gửi kèm giáo viên
                        <input type="checkbox" id="gui-kem-giao-vien" name="gui-kem-giao-vien" value="1">
                    </label>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        onclick="sendToPeoplesHs()">OK</button>
                </div>
            </div>
        </div>
    </div>



    <!--end::Modal-->
</div>
@endsection
@section('script')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    const checkAll1 = (e) => {
        $('.checkbox1').not(e).prop('checked', e.checked);
    };
    const checkAll2 = (e) => {
        $('.checkbox2').not(e).prop('checked', e.checked);
    };
    var editor = CKEDITOR.replace('content');
    CKEDITOR.config.height = 300;

    var nguoinhan = 1;
    $('#gui-thong-bao').on('click',function(){
        if (nguoinhan == 1) {
            postDataTT();
        } else if (nguoinhan == 2) {
            postDataGV();
        } else {
            postDataHS();
        }
    })
    $('#nguoinhan').on('change', function () {
        if ($(this).val() == 1) {
            $('#show-btn-add-gv').addClass('d-none');
            $('#show-btn-add-hs').addClass('d-none');
            nguoinhan = $(this).val();
        } else if ($(this).val() == 2) {
            $('#show-btn-add-gv').removeClass('d-none');
            $('#show-btn-add-hs').addClass('d-none');
            nguoinhan = $(this).val();
        } else {
            $('#show-btn-add-gv').addClass('d-none');
            $('#show-btn-add-hs').removeClass('d-none');
            nguoinhan = $(this).val();
        }
    })

    // Gửi Học Sinh
    var dtable;
    $(document).ready(function () {
        dtable = $('#table_hs').DataTable({
            "scrollX": true,
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0, 6]
            }, ]
        });

        $('#field_khoi').on('change', function () {
            dtable
                .column(2).search(this.value)
                .draw();
        });

        $('#field_lop').on('change', function () {
            dtable
                .column(3).search(this.value)
                .draw();
        });

        $('#field_ma').on('keyup change', function () {
            dtable
                .column(4).search(this.value)
                .draw();
        });

        $('#field_ten').on('keyup change', function () {
            dtable
                .column(5).search(this.value)
                .draw();
        });
        $('#field_ngay_sinh').on('keyup change', function () {
            dtable
                .column(6).search(this.value)
                .draw();
        });
        $('#field_gioi_tinh').on('change', function () {
            dtable
                .column(7).search(this.value)
                .draw();
        });
    });

    var toPeoples = [];
    var listDevice = [];
    var lop_id = [];
    var isCheck = false;

    function sendToPeoplesHs() {
        toPeoples = [];
        listDevice = [];
        lop_id = [];
        let statusList = $('input[type=checkbox]:checked.checkbox_hs');
        for (i = 0; i < statusList.length; i++) {
            if (statusList[i].checked && statusList[i].hasAttribute("data-id")) {
                toPeoples.push(parseInt(statusList[i].getAttribute('data-id')))
                listDevice.push(statusList[i].getAttribute('data-device'))

                if (!lop_id.includes(statusList[i].getAttribute('data-lop_id'))) {
                    lop_id.push(statusList[i].getAttribute('data-lop_id'))
                }

            }
        }
        isCheck = $('input[name="gui-kem-giao-vien"]').is(":checked") ? true : false;
    }

    function postDataHS() {
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
                    } else {
                        $("[name='title']").val(value)
                    }
                }
            })
        } else if (!err_content) {
            aLert2("top", "warning", "Hãy nhập Nội Dung Thông Báo", false, 3000, true);
        } else if (toPeoples.length <= 0) {
            aLert2("top", "warning", "Hãy thêm người nhận thông báo", false, 3000, true);
        } else {
            Swal.showLoading()
            $.post("{{ route('sendto_hocsinh') }}", {
                '_token': "{{ csrf_token() }}",
                'title': $("[name='title']").val(),
                'content': editor.getData(),
                'user_id': toPeoples,
                'device': listDevice,
                'lop_id': lop_id,
                'isCheck': isCheck
            }, function (response) {
                location.reload()

            })
            aLert2("center", "success", "Soạn nội dung thành công đang tiến hành gửi!", false, 3500, false);
        }
    }


    //Gửi Giáo Viên
    $(document).ready(function () {
        $("#table_gv").dataTable({
            "scrollX": true,
            select: true,
            responsive: true,
        });
    });

    var toPeoplesGv = [];
    function sendToPeoplesGv() {
        toPeoplesGv = [];
        let statusList = $("input[type=checkbox]:checked.checkbox_gv");
        for (i = 0; i < statusList.length; i++) {
            if (statusList[i].checked && statusList[i].hasAttribute("data-id")) {
                toPeoplesGv.push(parseInt(statusList[i].getAttribute("data-id")));
            }
        }
    }

    function postDataGV() {
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
            aLert2("top", "warning", "Hãy nhập Nội Dung Thông Báo", false, 3000, true);
        } else if (toPeoplesGv.length <= 0) {
            aLert2("top", "warning", "Hãy thêm người nhận thông báo", false, 3000, true);
        } else {
            Swal.showLoading()
            $.post(
            "{{ route('sendto_giaovien') }}",
            {
                _token: "{{ csrf_token() }}",
                title: $("[name='title']").val(),
                content: editor.getData(),
                user_id: toPeoplesGv,
                type: 2
            },
            function (response) {
                location.reload()
            }
            );
            aLert2("center", "success", "Soạn nội dung thành công đang tiến hành gửi!", false, 3500, false);
        }
    }


    // Gửi tòa trường
    function postDataTT() {
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
                    } else {
                        $("[name='title']").val(value)
                    }
                }
            })
        } else if (!err_content) {
            aLert2("top", "warning", "Hãy nhập Nội Dung Thông Báo", false, 3000, true);
        } else {
            Swal.showLoading()
            $.post("{{ route('sendto_toantruong') }}", {
                '_token': "{{ csrf_token() }}",
                'title': $("[name='title']").val(),
                'listId_Gv': "{{ $listId_Gv }}",
                'content': editor.getData()
            }, 
            function (response) {
                location.reload()
            })
            aLert2("center", "success", "Soạn nội dung thành công đang tiến hành gửi!", false, 3500, false);
        }
    }

    function aLert2(position, icon, title, showConfirmButton, timer, showCloseButton){
        Swal.fire({
            position: position,
            icon: icon,
            title: title,
            showConfirmButton: showConfirmButton,
            timer: timer,
            showCloseButton: showCloseButton,
        });
    }

    function toBack(){
        window.location.href = route('thong-bao.index');
    }
</script>
@endsection
