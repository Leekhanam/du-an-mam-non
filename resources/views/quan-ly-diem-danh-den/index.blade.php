@extends('layouts.main')
@section('title', "Quản lý điểm danh đến")
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
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
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
                    {{-- <div class="m-portlet__body"> --}}

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
                                    <span class="m-accordion__item-title">{{$item->ten_khoi}} ({{config('common.do_tuoi')[$item->do_tuoi]}})</span>

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
                                                                        onclick="showDiemDanhCuaLop({{$lop_hoc->id}}, 0)"
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

                    {{-- </div> --}}
                </div>
            </div>
            <div class="col-md-9">
                <div class="m-portlet m-portlet--full-height">
                    <input type="number" id="lop_id" hidden class="ml-3">
                    <div class="form-group m-form__group row ml-3" id="select_display" style="display: none">
                        <label class="col-lg-2 col-form-label select2">Tháng: </label>
                        <div class="col-lg-11">
                            <select name="time" id="thang" class="form-control select2">
                                @foreach($thang_trong_nam as $item)
                                <option value="{{intval(substr($item, 0, 2))}}">Tháng {{intval(substr($item, 0, 2))}} (năm {{substr($item, 3, 5)}})</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="type_diem_danh" name="type_diem_danh">
                            <br>
                            <button onclick="boSungDiemDanhBanSang()" type="button" class="btn btn-primary  btn-sm" id="nut_bo_sung_diem_danh" data-toggle="modal" data-target="#m_modal_8" >Bổ sung điểm danh ban sáng</button>
                            <button onclick="boSungDiemDanhBanChieu()" type="button" class="btn btn-success  btn-sm" id="nut_bo_sung_diem_danh" data-toggle="modal" data-target="#m_modal_9" >Bổ sung điểm danh ban chiều</button>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label select2">Chú thích: </label>
                    <div class="row ml-3">
                        <div class="col" style="color:#149018"><b><i>N: Đi học cả ngày</i></b></div>
                        <div class="col" style="color:#EB451F"><b><i>NH: Nghỉ học cả ngày</i></b></div>
                        <div class="col" style="color:#1520B4"><b><i>S: Đi học buổi sáng</i></b></div>
                        <div class="col" style="color:#1520B4"><b><i>C: Đi học buổi Chiều</i></b></div>
                        <div class="col" style="color:#FF9900"><b><i>A: Có ăn</i></b></div>

                    </div>
                    {{-- <div class="m-portlet__body"> --}}

                    <!--begin::Section-->

                    <!--end::Section-->

                    {{-- </div> --}}
                </div>

            </div>




            <div class="table-responsive">
                <table class="table table-bordered m-table m-table--border-success " style="cursor: pointer">
                    <thead>
                        <tr>
                            <th scope="col 1" rowspan="2">STT</th>
                            <th scope="col 1" rowspan="2">Mã học sinh</th>
                            <th scope="col 1" rowspan="2">Họ và tên</th>
                            <th scope="col 1" colspan="31" class="text-center">Ngày</th>
                        </tr>
                        <tr class="pt-3 row2">
                            @for($i = 1; $i < 32; $i++)
                            <th>{{$i}}</th>
                            @endfor
                            
                        </tr>
                    </thead>
                    <tbody id="show-data">

                    </tbody>
                </table>
                {{-- Modal --}}
                <div class="modal fade show" id="thongke" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" style="display: none; padding-right: 17px;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thống kê tháng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group" id="content-modal">
                                    <i>Đang lấy dữ liệu</i>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-dismiss="modal">Đóng</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- EndModel --}}
                    {{-- Modal NamHoc--}}
                    
                    {{-- EndModel --}}
                </div>
                <div class="modal fade show" id="modal-nam-hoc" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Năm Học</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <select class="form-control form-control-sm" id="select-nam">
                                        <option value="0">Chọn</option>
                                        @foreach ($getAllNamHoc as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
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
        <div class="modal fade" id="m_modal_8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bổ sung điểm danh ban sáng</h5>
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
                                    <th>Đi học</th>
                                    <th>Nghỉ học</th>
                                    <th>Phiếu ăn</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody class="cl_bo_sung_diem_danh_ban_sang">

                            </tbody>
                            <div class="modal-footer" style="border: none">
                                <span class="text-danger loi_ngay_diem_danh_ban_sang"></span>
                                <input class="form-control m-input" type="date" id="thoi_gian_bo_sung_diem_danh_ban_sang" 
                                        name="thoi_gian_bo_sung_diem_danh_ban_sang" style="width: 250px">
                                <button type="button" class="btn btn-primary" onclick="submitDataBanSang()">Cập nhật</button>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <!--end::Modal-->

        <!--begin::Modal-->
        <div class="modal fade" id="m_modal_9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bổ sung điểm danh ban chiều</h5>
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
                                    <th>Đi học</th>
                                    <th>Nghỉ học</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody class="cl_bo_sung_diem_danh_ban_chieu">

                            </tbody>
                            <div class="modal-footer" style="border: none">
                                <span class="text-danger loi_ngay_diem_danh_ban_chieu"></span>
                                <input class="form-control m-input" type="date" id="thoi_gian_bo_sung_diem_danh_ban_chieu" 
                                        name="thoi_gian_bo_sung_diem_danh_ban_chieu" style="width: 250px">
                                <button type="button" class="btn btn-primary" onclick="submitDataBanChieu()">Cập nhật</button>
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

</script>

{{-- Show diem danh den theo lop --}}
<script>
    var s = c = n = nh = a = 0;
    var url_getDiemDanhDenTheoLop = "{{route('quan-ly-diem-danh-den-theo-lop')}}";
    var url_ThongKeDiemDanh = "{{route('quan-ly-thong-ke-diem-danh')}}";
    var url_ChiTietHocSinh = "{{route('quan-ly-hoc-sinh-edit', ['id'])}}"
    function showDiemDanhCuaLop(id, time) {
        $('#select_display').css('display', 'block');
        $('#preload').css('display', 'block');
        $('#lop_id').val(id);
        axios.post(url_getDiemDanhDenTheoLop, {
                id: id,
                time: time
            })
            .then(function (response) {
                $('#thang').val(response.data.thang_hien_tai);
                var html_hs = "";
                //console.log(response.data[2].trang_thai_diem_danh[7].trang_thai_diem_danh)
                var j = 1;
                response.data.hocsinh.forEach(element => {
                    s = element.sang;
                    c = element.chieu;
                    n = element.nghi_hoc;
                    nh = element.ca_ngay;
                    a = element.an_com;
                var data_ngay_hs = "";
               
                for(var i = 1; i < 32; i++)
                {   
                    var type = element.trang_thai_diem_danh[i];
                    if (typeof(type) !== 'undefined') {
                        if(element.trang_thai_diem_danh[i].trang_thai_diem_danh == "N"){
                            data_ngay_hs += 
                            `<td><b style='color:#149018'><i>${element.trang_thai_diem_danh[i].trang_thai_diem_danh}</i></b> <b style = "color:#FF9900"><i>${element.trang_thai_diem_danh[i].an_com}</i></b></td>`
                        }
                        else if(element.trang_thai_diem_danh[i].trang_thai_diem_danh == "NH")
                        {
                            data_ngay_hs += `<td><b style='color:#EB451F'><i>${element.trang_thai_diem_danh[i].trang_thai_diem_danh}</i></b></td>`
                        }
                        else{
                            data_ngay_hs += 
                            `<td><b style='color:#1520B4'><i>${element.trang_thai_diem_danh[i].trang_thai_diem_danh}</i></b> <b style = "color:#FF9900"><i>${element.trang_thai_diem_danh[i].an_com}</i></b></td>`
                        }
                       
                        // data_ngay_hs += `<td></td>`
                    }
                    else
                    {
                        data_ngay_hs += `<td></td>`
                    }
    
                    
                }
                
                html_hs +=
                `
                    <tr data-toggle="modal" data-target="#thongke" onclick="ThongKeDiemDanh(${id}, ${time}, ${element.id})">
                    <th scope="row">${j++}</th>
                    <td>${element.ma_hoc_sinh}</td>
                    <td>${element.ten}</td>
                    
                `
                + data_ngay_hs +
                    
                    `
                    </tr>
                    `
                
                });
                $('#preload').css('display', 'none')
                $('#show-data').html(html_hs);
            })
    }
    $("#thang").change(function(){
            $('#preload').css('display', 'block');
            
            var time = Number($('#thang').val());
            var id = Number($('#lop_id').val());
            showDiemDanhCuaLop(id, time);
            // $('#preload').css('display', 'none');
           
        });
    $("#select-nam").change(function(){
       $('#select_display').css('display', 'block')
       var id = $("#select-nam").val();
       var url_moi = url_diemdanh.replace('id',id)
       window.location.href = url_moi;
       
    });
    function ThongKeDiemDanh(lop_id, thang, hoc_sinh_id){
        $('#preload').css('display', 'block');
        $("#content-modal").html(`Đang lấy dữ liệu`);
        var url_ChiTietHocSinh_new = url_ChiTietHocSinh.replace('id', hoc_sinh_id)
        if(thang == 0){
            var today = new Date()
            thang = today.getMonth()+1;
        }
        $('#exampleModalLabel').html('Thống kê điểm danh tháng '+thang);
        axios.post(url_getDiemDanhDenTheoLop, {
                id: lop_id,
                time: thang
            }).then(function(response){
               var data =  response.data.hocsinh.find(element => element.id == hoc_sinh_id);
               var content_count = 
               `
               <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="validationTooltip01"><b>Mã: ${data.ma_hoc_sinh}</b></label>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationTooltip01"><b>Học sinh: <a target="_blank" href ="${url_ChiTietHocSinh_new}">${data.ten}</a></b></label>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationTooltip01"><b style="color:#149018">Đi học cả ngày (N): ${data.ca_ngay}</b></label>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationTooltip01"><b style="color:#1520B4">Đi học buổi sáng (S): ${data.sang}</b></label>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationTooltip01"><b style="color:#1520B4">Đi học buổi chiều (C): ${data.chieu}</b></label>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationTooltip01"><b style="color:#EB451F">Nghỉ học cả ngày (NH): ${data.nghi_hoc}</b></label>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationTooltip01"><b style="color:#FF9900">Có ăn (A): ${data.an_com}</b></label>
                    </div>
                </div>
               `
               $('#preload').css('display', 'none');
               $("#content-modal").html(content_count);
            })
        
    }

    function boSungDiemDanhBanSang(){
        $('#type_diem_danh').val(1);
        let lop_id = $('#lop_id').val();
        axios.post("{{ route('danhSachHocSinhTheoLop')}}",{
            lop_id: lop_id
        }).then(res => {
            let data = res.data;
            var content = ``;
            data.forEach((element , key) => {
                content +=`
                            <tr>
                                <td>${ ++key }
                                    <input type="hidden" name="id_${element.id}"  value="${element.id}">
                                    <input type="hidden" name="lop_${element.id}" value="${element.lop_id}">
                                    <input type="hidden" name="user_${element.id}"  value="${element.user_id}"></td>
                                <td>${ element.ma_hoc_sinh }</td>
                                <td>${ element.ten }</td>
                                <td>${ element.ngay_sinh }</td>
                                <td><input type="radio" value="1" name="${element.id}" checked="true"></td>
                                <td><input type="radio" value="2" name="${element.id}"></td>
                                <td><input type="checkbox" name="phieu_an_${element.id}" checked="true"></td>
                                <td><textarea name="chu_thich_${element.id}"></textarea></td>
                            </tr>
                `;
            })
            $('.cl_bo_sung_diem_danh_ban_chieu').html('');
            $('.cl_bo_sung_diem_danh_ban_sang').html(content);
        })
    }

    function boSungDiemDanhBanChieu(){
        $('#type_diem_danh').val(2);
        let lop_id = $('#lop_id').val();
        axios.post("{{ route('danhSachHocSinhTheoLop')}}",{
            lop_id: lop_id
        }).then(res => {
            let data = res.data;
            var content = ``;
            data.forEach((element , key) => {
                content +=`
                            <tr>
                                <td>${ ++key }
                                    <input type="hidden" name="id_${element.id}"  value="${element.id}">
                                    <input type="hidden" name="lop_${element.id}" value="${element.lop_id}">
                                    <input type="hidden" name="user_${element.id}"  value="${element.user_id}"></td>
                                <td>${ element.ma_hoc_sinh }</td>
                                <td>${ element.ten }</td>
                                <td>${ element.ngay_sinh }</td>
                                <td><input type="radio" value="1" name="${element.id}" checked="true"></td>
                                <td><input type="radio" value="2" name="${element.id}"></td>
                                <td><textarea name="chu_thich_${element.id}"></textarea></td>
                            </tr>
                `;
            })
            $('.cl_bo_sung_diem_danh_ban_sang').html('');
            $('.cl_bo_sung_diem_danh_ban_chieu').html(content);
        })
    }


    function submitDataBanSang(){
        var type_diem_danh = $('#type_diem_danh').val();
        var statusList = $('input[type=radio]:checked');
        var thoi_gian_bo_sung_diem_danh = $('#thoi_gian_bo_sung_diem_danh_ban_sang').val();
        
        var data = [];
        for (i = 0; i < statusList.length; i++) {

            std = {
                'hoc_sinh_id': $('[name=id_' + $(statusList[i]).attr('name') + ']').val(),
                'giao_vien_id': "{{ \Illuminate\Support\Facades\Auth::id() }}",
                'trang_thai': $(statusList[i]).val(),
                'lop_id': $('[name=lop_' + $(statusList[i]).attr('name') + ']').val(),
                'chu_thich': $('[name=chu_thich_'+$(statusList[i]).attr('name')+']').val(),
                'ngay_diem_danh_den': thoi_gian_bo_sung_diem_danh,
                'phieu_an': $('[name=phieu_an_'+$(statusList[i]).attr('name')+']').is(':checked') ? 1 : 2,
                'type': 1
            }
            data.push(std)
        }
        axios.post("{{ route('boSungDiemDanhDen') }}",{
            ngay_diem_danh: thoi_gian_bo_sung_diem_danh,
            lop_id: $('#lop_id').val(),
            type: type_diem_danh,
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
                $('.loi_ngay_diem_danh_ban_sang').html(error.response.data.errors[key]);
            }
        })
    }

    function submitDataBanChieu(){
        var type_diem_danh = $('#type_diem_danh').val();
        var statusList = $('input[type=radio]:checked');
        var thoi_gian_bo_sung_diem_danh = $('#thoi_gian_bo_sung_diem_danh_ban_chieu').val();
        
        var data = [];
        for (i = 0; i < statusList.length; i++) {

            std = {
                'hoc_sinh_id': $('[name=id_' + $(statusList[i]).attr('name') + ']').val(),
                'giao_vien_id': "{{ \Illuminate\Support\Facades\Auth::id() }}",
                'trang_thai': $(statusList[i]).val(),
                'lop_id': $('[name=lop_' + $(statusList[i]).attr('name') + ']').val(),
                'chu_thich': $('[name=chu_thich_'+$(statusList[i]).attr('name')+']').val(),
                'ngay_diem_danh_den': thoi_gian_bo_sung_diem_danh,
                'type': 2
            }
            data.push(std)
        }
        axios.post("{{ route('boSungDiemDanhDen') }}",{
            ngay_diem_danh: thoi_gian_bo_sung_diem_danh,
            lop_id: $('#lop_id').val(),
            type: type_diem_danh,
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
                $('.loi_ngay_diem_danh_ban_chieu').html(error.response.data.errors[key]);
            }
        })
    }

</script>
{{-- EndShow diem danh den theo lop --}}

@endsection