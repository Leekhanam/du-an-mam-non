@extends('layouts.main')
@section('title', "Quản lý điểm danh về")
@section('style')
<style>
    .thong-tin-hoc-sinh-cua-lop {
        font-size: 11px
    }

    .thong-tin-hoc-sinh-cua-lop th,
    .thong-tin-hoc-sinh-cua-lop td {
        padding: 0.22rem !important;
    }

    .search {
        padding: 0.35rem 0.8rem !important;
        height: 25px;
    }

    .style-button {
        padding: 0.45rem 1.15rem;
    }

    .thong-tin-hoc-sinh-cua-lop thead th {
        border: 1px solid #f4f5f8 !important;
    }

    th[rowspan='2'] {
        text-align: center;
        line-height: 50px;
    }

    .btn {
        font-family: Arial, Helvetica, sans-serif
    }

    .scoll-table {
        height: 440px;
        overflow: auto;
    }

    .bottom {
        position: fixed;
        bottom: 50px;
    }

    table.dataTable thead td {
        border-bottom: 1px solid #d1cccc;
    }

    #table-hoc-sinh_wrapper>.row:first-child {
        display: none;
    }

    .danh-sach-khoi-lop .m-accordion__item-title,
    .m-accordion__item-mode,
    .m-dropdown__content ul li span {
        color: black;
        font-size: 12px !important;
    }

    .danh-sach-khoi-lop .m-accordion__item {
        color: black;

        border-bottom: 1px solid #eee5e5 !important;
        margin-bottom: 0rem !important
    }

    .la-plus {
        font-size: 20px;
        font-weight: bold;
        color: #19be19;
        cursor: pointer;
    }

    .m-accordion .m-accordion__item .m-accordion__item-head {
        padding: 0.5rem 1rem;
    }

    .collapsed {
        position: relative;
    }

    .la-ellipsis-v:hover .dropdown__wrapper {
        display: block !important;
    }

    .m-nav .m-nav__item>.m-nav__link .m-nav__link-text {
        width: 85% !important;
    }

    .m-accordion .m-accordion__item {
        overflow: visible !important;
    }

    .m-accordion .m-accordion__item .m-accordion__item-head {
        overflow: visible !important;
    }

    .chuc-nang-lop {
        margin-bottom: 0px !important;
    }

    .thong-tin-xep-lop {
        padding: 0.2rem 2.2rem !important
    }

    .error {
        color: red;
    }

    .lop_hoc .m-nav__link {
        padding: 5px 0px !important
    }

    .lop_hoc .m-nav__link-text {
        padding-left: 23px !important;
    }

    i:hover {
        cursor: pointer;
    }

</style>
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="m-content">
    <div id="preload" class="preload-container text-center" style="display: none">
        <img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
    </div>
    <div class="m-portlet">
        <div class="m-portlet__body row ">
            <div class="col-md-3 danh-sach-khoi-lop">
                <div class="m-portlet m-portlet--full-height">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <div class="row">
                                    <h4 class="m-portlet__head-text col-md-10">
                                        Năm học: {{$namhoc->name}}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">

                        <!--begin::Section-->
                        <div class="m-accordion m-accordion--default m-accordion--solid m-accordion--section  m-accordion--toggle-arrow"
                            id="" role="tablist">

                            <!--begin::Item-->
                            <div id="danh_sach_khoi_lop">
                                @foreach ($namhoc->Khoi as $item)
                                <div class="m-accordion__item ">
                                    <div class="m-accordion__item-head collapsed" role="tab"
                                        id="tab{{$item->id}}_item_1_head" data-toggle="collapse"
                                        href="#tab{{$item->id}}_item_1_body" aria-expanded="false">
                                        <span class="m-accordion__item-mode "></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="m-accordion__item-title">{{$item->ten_khoi}}
                                            ({{config('common.do_tuoi')[$item->do_tuoi]}})</span>

                                    </div>
                                    <div class="m-accordion__item-body collapse" id="tab{{$item->id}}_item_1_body"
                                        role="tabpanel" aria-labelledby="tab{{$item->id}}_item_1_head">
                                        <div class="">
                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--left"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__content">
                                                            <ul class="m-nav">
                                                                @foreach ($item->LopHoc as $lop_hoc)
                                                                <li class="m-nav__item pl-4 lop_hoc"
                                                                    onclick="addColor(this)" id='lop_{{$lop_hoc->id}}'
                                                                    style="cursor: pointer">
                                                                    <span href="" class="m-nav__link">
                                                                        <span
                                                                            onclick="showDiemDanhCuaLop({{$lop_hoc->id}})"
                                                                            class="m-nav__link-text ">
                                                                            <span class="ten_lop"> {{$lop_hoc->ten_lop}}
                                                                            </span>

                                                                            <div class="dropdown">
                                                                                <div class="dropdown-menu"
                                                                                    aria-labelledby="dropdownMenuButton">
                                                                                </div>
                                                                            </div>
                                                                        </span>
                                                                </li>
                                                                @endforeach
                                                            </ul>

                                                            <!--end::Nav-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                        </div>
                        <!--end::Section-->
                    </div>
                </div>
            </div>
            @php
            $thang_hien_tai = \Carbon\Carbon::now()->format('m-Y');
            @endphp
            <div class="col-md-9">
                <div class="m-portlet m-portlet--full-height">
                    <input type="number" id="lop_id" hidden class="ml-3">
                    <div class="form-group m-form__group row ml-3" id="select_display" style="display: none">
                        <label class="col-lg-2 col-form-label select2">Tháng: </label>
                        <div class="col-lg-11">
                            <select name="time" id="thang" class="form-control select2">
                                @foreach($thang_trong_nam as $item)
                                <option {{ $thang_hien_tai == $item ? 'selected' : ''}} value="{{ $item }}">Tháng
                                    {{intval(substr($item, 0, 2))}} (năm {{substr($item, 3, 5)}})</option>
                                @endforeach
                            </select>
                            <br>
                        <button type="button" class="btn btn-primary d-none btn-sm" id="nut_bo_sung_diem_danh" data-toggle="modal" data-target="#m_modal_8" >Bổ sung điểm danh về</button>

                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label select2">Chú thích: </label>
                    <div class="row ml-3">
                        <div class="col" style="color:#149018"><b><i>B: Bố mẹ đón</i></b></div>
                        <div class="col" style="color:#f300ca"><b><i>H: Người đón hộ</i></b></div>
                        <div class="col" style="color:#da0808"><b><i>N: Nghỉ</i></b></div>
                        <div class="col" style="color:#2f1ad8"><b><i>T: Trả muộn</i></b></div>
                        <div class="col"><b><i class="la la-user-plus"></i>: Thông tin người đón hộ</b></div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered m-table m-table--border-success table-hover" style="cursor: pointer">
                    <thead>
                        <tr>
                            <th scope="col 1" rowspan="2">STT</th>
                            <th scope="col 1" rowspan="2">Mã học sinh</th>
                            <th scope="col 1" rowspan="2">Họ và tên</th>
                            <th scope="col 1" colspan="31" class="text-center">Ngày</th>
                        </tr>
                        <tr class="pt-3 row2">
                            @for($i = 1; $i < 32; $i++) <th>{{$i}}</th>
                                @endfor
                        </tr>
                    </thead>
                    <tbody id="show-data">

                    </tbody>
                </table>
                {{-- Modal --}}
                <div class="modal fade show" id="thongke" tabindex="-1" role="dialog" aria-labelledby=""
                    style="display: none; padding-right: 17px;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="">Thống kê tháng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group" id="content-modal">
                                    Đang lấy dữ liệu
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-dismiss="modal">Đóng</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade show" id="modal-nam-hoc" tabindex="-1" role="dialog" aria-labelledby="">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="">Năm Học</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin người đón hộ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Họ và Tên: <span
                                id="ten_nguoi_don_ho"></span></label>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label">Số điện thoại: <span
                                id="phone_nguoi_don_ho"></span></label>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label">Số CMND/TCC: <span
                                id="cmtnd_nguoi_don_ho"></span></label>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control m-input m-input--solid" cols="117" rows="5"
                            id="ghi_chu_nguoi_don_ho"></textarea>
                    </div>
                    <div class="form-group">
                        <img id="anh_nguoi_don_ho" src="" width="100%" height="600px" alt="ảnh">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->

    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Thống kê điểm danh về</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="content-modal">
                        <span id="dang_lay_du_lieu"><i>Đang lấy dữ liệu</i></span>
                        <div class="form-row d-none" id="lay_du_lieu_ok">
                            <div class="col-md-12 mb-3">
                                <label for="validationTooltip01"><b>Mã: <span id="show_ma_hoc_sinh"></span></b></label>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationTooltip01"><b>Học sinh: <span id="show_ten_hoc_sinh"></span></b></label>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationTooltip01"><b style="color:#149018">Bố mẹ đón (B): <span id="trang_thai_1"></span></b></label>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationTooltip01"><b style="color:#1520B4">Người đón hộ (H): <span id="trang_thai_2"></span></b></label>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationTooltip01"><b style="color:#1520B4">Nghỉ (N): <span id="trang_thai_3"></span></b></label>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationTooltip01"><b style="color:#EB451F">Trả muộn (T): <span id="trang_thai_4"></span></b></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->

    <!--begin::Modal-->
        <div class="modal fade" id="m_modal_8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bổ sung điểm danh về</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="table1"
                            class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap dataTable dtr-inline">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã Số</th>
                                    <th>Họ Tên</th>
                                    <th>Ngày Sinh</th>
                                    <th>Bố Mẹ Đón</th>
                                    <th>Nghỉ</th>
                                    <th>Trả muộn</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody id="bo_sung_diem_danh">

                            </tbody>
                            <div class="modal-footer" style="border: none">
                                <span class="text-danger" id="loi_ngay_diem_danh"></span>
                                <input class="form-control m-input" type="date" id="thoi_gian_bo_sung_diem_danh" 
                                        name="thoi_gian_bo_sung_diem_danh" style="width: 250px">
                                <button type="button" class="btn btn-primary" onclick="submitData()">Cập nhật</button>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <!--end::Modal-->
</div>
@endsection
@section('script')
<script>
    const url_diemdanh = "{{route('quan-ly-diem-danh-den-index',['id'])}}";
    const addColor = (e) => {
        var list_element_lop = document.querySelectorAll('.lop_hoc')
        list_element_lop.forEach(element => {
            $(element).css('background', 'transparent')
        });
        $(e).css('background', '#bafac8')
    }

    function showDiemDanhCuaLop(id) {
        $('#nut_bo_sung_diem_danh').removeClass('d-none');
        let time = $('#thang').children("option:selected").val();
        $('#select_display').css('display', 'block');
        $('#preload').css('display', 'block');
        $('#lop_id').val(id);
        axios.post("{{route('quan-ly-diem-danh-ve-theo-lop')}}", {
                id: id,
                time: time
            })
            .then(function (response) {
                var html_hs = "";
                var j = 1;
                console.log(response.data);
                var content = ``;
                response.data.forEach((element, key) => {
                    html_hs += `
                    <tr onclick="thongKeSoLieu(this)" data-hoc_sinh_id="${element.id}" 
                        data-ma_hoc_sinh="${element.ma_hoc_sinh}" 
                        data-ten_hoc_sinh="${element.ten}">
                        <td>${++key}</td>
                        <td>${element.ma_hoc_sinh}</td>
                        <td>${element.ten}</td>`
                    for (let j = 1; j <= 31; j++) {
                        html_hs += `<td class="td_${j}_hoc_sinh_${element.ma_hoc_sinh}"></td>`
                    }

                    content +=`
                            <tr>
                                <td>${ key }
                                    <input type="hidden" name="id_${element.id}"  value="${element.id}">
                                    <input type="hidden" name="lop_${element.id}" value="${element.lop_id}">
                                    <input type="hidden" name="user_${element.id}"  value="${element.user_id}"></td>
                                <td>${ element.ma_hoc_sinh }</td>
                                <td>${ element.ten }</td>
                                <td>${ element.ngay_sinh }</td>
                                <td><input type="radio" value="1" name="${element.id}" checked="true"></td>
                                <td><input type="radio" value="3" name="${element.id}"></td>
                                <td><input type="radio" value="4" name="${element.id}"></td>
                                <td><textarea name="chu_thich_${element.id}"></textarea></td>
                            </tr>
                    `;
                });
                $('#bo_sung_diem_danh').html(content);
                html_hs += `</tr>`;

                $('#preload').css('display', 'none')
                $('#show-data').html(html_hs);

                response.data.forEach((element, key) => {
                    for (let index = 0; index < element.diem_danh_ve.length; index++) {
                        let noiDungTrangThai = ``;
                        let trang_thai = element.diem_danh_ve[index].trang_thai;
                        let ngay_diem_danh_ve = moment(element.diem_danh_ve[index].ngay_diem_danh_ve)
                            .format('DD');
                        noiDungTrangThai =
                            `${trang_thai == 1 ? "<b style='color:#149018'>B</b>" : 
                                             (trang_thai == 2 ? `<b style='color:#f300ca'>H</b><br/>
                                             <i onclick="showNguoiDonHo(${element.diem_danh_ve[index].nguoi_don_ho_id})" class="la la-user-plus"></i>` : 
                                             (trang_thai == 3 ? "<b style='color:#da0808'>N</b>" : "<b style='color:#2f1ad8'>T</b>"))}`;
                        $(`.td_${Number(ngay_diem_danh_ve)}_hoc_sinh_${element.ma_hoc_sinh}`).html(
                            noiDungTrangThai)
                    }
                });
            })
    }
    $("#thang").change(function () {
        let id = Number($('#lop_id').val());
        showDiemDanhCuaLop(id);
    });
    $("#select-nam").change(function () {
        $('#select_display').css('display', 'block')
        let id = $("#select-nam").val();
        let url_moi = url_diemdanh.replace('id', id)
        window.location.href = url_moi;
    });

    function showNguoiDonHo(id) {
        axios.post("{{ route('infoNguoiDonHo')}}", {
                'id': id
            })
            .then(response => {
                console.log(response.data);
                $('#ten_nguoi_don_ho').html(response.data.ten_nguoi_don_ho);
                $('#phone_nguoi_don_ho').html(response.data.phone_number);
                $('#cmtnd_nguoi_don_ho').html(response.data.cmtnd);
                $('#ghi_chu_nguoi_don_ho').val(response.data.ghi_chu);
                $('#anh_nguoi_don_ho').attr("src", response.data.anh_nguoi_don_ho)
                $('#m_modal_4').modal("show");
            })
    }

    function thongKeSoLieu(e){
        $('#dang_lay_du_lieu').removeClass('d-none');
        $('#lay_du_lieu_ok').addClass('d-none');
        $('#m_modal_1').modal('show');

        let hoc_sinh_id = e.getAttribute('data-hoc_sinh_id');
        let ma_hoc_sinh = e.getAttribute('data-ma_hoc_sinh');
        let ten_hoc_sinh = e.getAttribute('data-ten_hoc_sinh');
        let time = $('#thang').children("option:selected").val();
        
        axios.post("{{ route('thongKeSoLieu')}}",{
            hoc_sinh_id: hoc_sinh_id,
            time: time
        }).then(res => {
            $('#dang_lay_du_lieu').addClass('d-none');
            $('#lay_du_lieu_ok').removeClass('d-none');
            let soLieu = res.data;
            $('#show_ma_hoc_sinh').text(ma_hoc_sinh);
            $('#show_ten_hoc_sinh').text(ten_hoc_sinh);
            $('#trang_thai_1').text(soLieu.trang_thai_1);
            $('#trang_thai_2').text(soLieu.trang_thai_2);
            $('#trang_thai_3').text(soLieu.trang_thai_3);
            $('#trang_thai_4').text(soLieu.trang_thai_4);
        })
    }

    function submitData() {
        var statusList = $('input[type=radio]:checked');
        var thoi_gian_bo_sung_diem_danh = $('#thoi_gian_bo_sung_diem_danh').val();

        var data = [];
        for (i = 0; i < statusList.length; i++) {

            std = {
                'hoc_sinh_id': $('[name=id_' + $(statusList[i]).attr('name') + ']').val(),
                'user_id': $('[name=user_' + $(statusList[i]).attr('name') + ']').val(),
                'giao_vien_id': "{{ \Illuminate\Support\Facades\Auth::id() }}",
                'trang_thai': $(statusList[i]).val(),
                'lop_id': $('[name=lop_' + $(statusList[i]).attr('name') + ']').val(),
                'chu_thich': $('[name=chu_thich_'+$(statusList[i]).attr('name')+']').val(),
                'ngay_diem_danh_ve': thoi_gian_bo_sung_diem_danh
            }
            data.push(std)
        }
         
        axios.post("{{ route('boSungDiemDanhVe') }}",{
            ngay_diem_danh: thoi_gian_bo_sung_diem_danh,
            lop_id: $('#lop_id').val(),
            data: data
        }).then(res => {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Bổ sung thành công !",
                showConfirmButton: false,
                timer: 2000
            });
            setTimeout(function(){
                    location.reload() 
                },1000);
        }).catch(error => {
            for (const key in error.response.data.errors) {
                $('#loi_ngay_diem_danh').html(error.response.data.errors[key]);
            }
        })
    }

</script>
@endsection
