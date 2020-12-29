@extends('layouts.main')
@section('title', "Thống kê feedback")
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
    .pagination {
    display: inline-block;
    padding-left: 0;
    margin: 20px 0;
    border-radius: 4px;
}
.pagination>li {
    display: inline;
}
.pagination>li:first-child>a, .pagination>li:first-child>span {
    margin-left: 0;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}
.pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
    color: #777;
    cursor: not-allowed;
    background-color: #fff;
    border-color: #ddd;
}
.pagination>li>a, .pagination>li>span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
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
                    {{-- Modal năm học --}}
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
                    {{-- End Modal năm học --}}
                    <!--begin::Section-->
                    <div class="m-accordion m-accordion--default m-accordion--solid m-accordion--section  m-accordion--toggle-arrow"
                        id="" role="tablist">

                        <!--begin::Item-->
                        <div id="danh_sach_khoi_lop">
                          
                            @foreach ($namhoc->khoi as $item)
                            <div class="m-accordion__item ">
                                <div class="m-accordion__item-head collapsed" role="tab"
                                    id="tab{{$item->id}}_item_1_head" data-toggle="collapse"
                                    href="#tab{{$item->id}}_item_1_body" aria-expanded="false">
                                    <span class="m-accordion__item-mode "></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="m-accordion__item-title">{{$item->ten_khoi}} ({{config('common.do_tuoi')[$item->do_tuoi]}})</span>
                                        
                                        @if ($item->countTongFeedBack > 0)
                                    <span class="m-badge m-badge--danger m-badge--wide" id="countTongFeedBack{{$item->id}}">{{$item->countTongFeedBack}}</span>
                                        @endif
                                        
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
                                                            @foreach ($item->lophoc as $lop_hoc)
                                                            <li class="m-nav__item pl-4 lop_hoc"
                                                                onclick="addColor(this)" id='lop_{{$lop_hoc->id}}'
                                                                style="cursor: pointer">
                                                                <span href="" class="m-nav__link">
                                                                    <span onclick="ShowFeedBackCuaLop({{$lop_hoc->id}})" class="m-nav__link-text ">
                                                                        <span class="ten_lop"> {{$lop_hoc->ten_lop}}
                                                                        </span>
                                                                    <input type="text" id="KhoiCuaLop{{$lop_hoc->id}}" value="{{$item->id}}" hidden>
                                                                    
                                                                    <div class="dropdown">

                                                                        @if ($lop_hoc->count > 0)
                                                                    <span class="m-badge m-badge--danger m-badge--wide" id="countFeedBackLop{{$lop_hoc->id}}">{{$lop_hoc->count}}</span>
                                                                        @endif

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
        <div class="col-md-9">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Đánh giá từ phụ huynh
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-pills m-portlet__nav nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <div class="m-dropdown m-dropdown--inline m-dropdown--small m-dropdown--arrow m-dropdown--align-left" m-dropdown-toggle="hover" aria-expanded="true">
                                        <button type="button"  class="btn m-btn--pill btn-outline-brand btn-sm m-dropdown__toggle btn-brand dropdown-toggl" id="showGVQL" style="display: none">Giáo viên quản lí</button>
                                        {{-- <a href="#" class="m-dropdown__toggle btn btn-brand dropdown-toggle">
                                            Dropdown - Default
                                        </a> --}}
                                        <div class="m-dropdown__wrapper" style="z-index: 101;">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--left"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__body">
                                                    <div class="m-dropdown__content">
                                                        <ul class="m-nav" id="showGiaoVienCuaLop">
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="nav nav-pills m-portlet__nav nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <button type="button" id="DaXem" onclick="DaXem()" style="display: none" class="btn m-btn--pill btn-outline-brand btn-sm ml-2 ">Đánh dấu đã xem</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Content-->
                        <div class="tab-content">
                            <div class="tab-pane active show" id="m_widget5_tab1_content" aria-expanded="true">
                               
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    
                    {{-- Model --}}
                    <div class="modal fade show" id="ShowChiTietFeedBack" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" style="display: none; padding-right: 17px;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Chi tiết đánh giá</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body" id="content-model">
                                
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-dismiss="modal">Đóng</button>
                            </div>   
                        </div>
                    </div>
                    {{-- EndModel --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/vi.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{!! asset('js/paginathing.js') !!}"></script>
<script>
    const url_ThongKeFeedBackIndex = "{{route('quan-ly-feed-back-index')}}";
    var url_ShowFeedBackCuaLop = "{{route('quan-ly-feed-back-show-feedback-cua-lop')}}"
    var url_ThayDoiTrangThaiFeedBack = "{{route('quan-ly-feed-back-thay-doi-trang-thai')}}"
    var url_DaXemTatCa = "{{route('quan-ly-feed-back-da-xem-tat-ca')}}"
    var url_GetGiaoVienFeedBack = "{{route('quan-ly-feed-back-get-giao-vien')}}"
    var url_ChiTietGiaoVien = "{{route('quan-ly-giao-vien-edit', ['id'])}}"
    var url_ChiTietHocSinh = "{{route('quan-ly-hoc-sinh-edit', ['id'])}}"
    const addColor = (e) => {
        var list_element_lop = document.querySelectorAll('.lop_hoc')
        list_element_lop.forEach(element => {
            $(element).css('background', 'transparent')
        });
        $(e).css('background', '#bafac8')
    }

    function ShowFeedBackCuaLop(lop_id)
    {   
        $('#preload').css('display', 'block');
        $('#showGVQL').css('display', 'block');
        var htmlFeedBack = `<input type="text" id="LopHocID" value="${lop_id}" hidden>`;
        var htmGiaoVien = "";
        axios.post(url_ShowFeedBackCuaLop, {lop_id:lop_id})
        .then(function(response){
            if(response.data.dataFeedBack.length > 0){
                $('#DaXem').css('display', 'block');
            }
            else{
                $('#DaXem').css('display', 'none');
            }
            response.data.dataFeedBack.forEach(element => {
                var thoigian = moment(element.created_at).fromNow(); 
                var trangthai = "";
                var anh = "";
                if(element.trang_thai == 1){
                    trang_thai = 
                    `
                    <i id="thay_doi_trang_thai${element.id}" style="color: red"><b>Chưa xem </b></i>
                    `
                }
                else{
                    trang_thai = 
                    `
                    <i style="color: green">Đã xem</i>
                    `
                }
                if(element.avatar == "" || element.avatar == null){
                    anh = "https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png"
                }
                else{
                    anh = element.avatar
                }
                if(element.noi_dung.length > 155){
                   element.noi_dung = element.noi_dung.slice(0, 155)+' ...'
                }
                
                htmlFeedBack +=
                `<div class="m-widget3" >
                    
                    <div class="m-widget3__item">
                    
                        <div class="m-widget3__header">
                            <div class="m-widget3__user-img">
                                <img class="m-widget3__img" src=${anh} alt="">
                            </div>
                            <div class="m-widget3__info" style="cursor: pointer !important;" onclick="showChiTiet(${element.id}, ${element.lop_id})" data-toggle="modal" data-target="#ShowChiTietFeedBack">
                                <span class="m-widget3__username" style="cursor: pointer !important;" onclick="showChiTiet(${element.id}, ${element.lop_id})" data-toggle="modal" data-target="#ShowChiTietFeedBack">
                                    <b>Phụ huynh bé ${element.ten} phản hồi:</b>
                                    <a onclick="showChiTiet(${element.id}, ${element.lop_id})" style="cursor: pointer" data-toggle="modal" data-target="#ShowChiTietFeedBack">${element.noi_dung}</a>
                                </span><br>
                                <span class="m-widget3__time mb-2">
                                    ${thoigian} - ${trang_thai}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                `
            })
            
            $('#m_widget5_tab1_content').html(htmlFeedBack);
            $('.pagination').remove()
            
            //Show page
            if(response.data.dataFeedBack.length>0){
                jQuery(document).ready(function($){
            $('#m_widget5_tab1_content').paginathing({
            perPage: 15,
            pageNumbers: true
            })
            });
            }
            if(response.data.dataGiaoVien.length > 0){
                
                response.data.dataGiaoVien.forEach(element => {
                var url_ChiTietGiaoVien_new = url_ChiTietGiaoVien.replace('id',element.id)
                htmGiaoVien+=
                `
                <li class="m-nav__item">
                    <a href="${url_ChiTietGiaoVien_new}" target="_blank" class="m-nav__link">
                        <i class="m-nav__link-icon flaticon-avatar"></i>
                        <span class="m-nav__link-text">${element.ten} - ${element.ma_gv}</span>
                    </a>
                </li>
                `
            })
            }
            else{
                htmGiaoVien = 'Chưa có giáo viên !'
            }
            $('#showGiaoVienCuaLop').html(htmGiaoVien);
            $('#preload').css('display', 'none');
        })
    }

    $("#select-nam").change(function(){
       $('#select_display').css('display', 'block')
       var id = $("#select-nam").val();
       var url_moi = url_ThongKeFeedBackIndex
       window.location.href = url_moi;
       
    });

    function showChiTiet(id, lop_id){
        $('#preload').css('display', 'block');
        var htmlFeedBack = "";
        axios.post(url_ShowFeedBackCuaLop, {
            feedback_id: id,
            lop_id: lop_id
        }).then(function(response){
            var data = response.data.dataFeedBack.find(element => element.id == id)
            var thoigian = moment(data.created_at).fromNow();
            var url_ChiTietHocSinh_new = url_ChiTietHocSinh.replace('id',data.id) 
            var contentHTML = 
            `
            <div class="form-row">

                <div class="col-md-12 mb-3">
                    <label for="validationTooltip01"><b> Phụ huynh Bé: <a href="${url_ChiTietHocSinh_new}"> ${data.ten} - ${data.ma_hoc_sinh} </a></b></label>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="validationTooltip01"><b>Điện thoại:</b> ${data.dien_thoai_dang_ki}</label>
                </div>
                <div class="col-md-12 mb-3">
                    <p>
                    <b>Nội dung - ${thoigian}:</b>
                    ${data.noi_dung}
                    </p>
                </div>
            </div>
            `
            $('#content-model').html(contentHTML);
            if(data.trang_thai == 1){
                axios.post(url_ThayDoiTrangThaiFeedBack, {id:id})
                var dom_khoi = document.getElementById('KhoiCuaLop'+lop_id);
                var khoi_id = dom_khoi.value;
                var thong_bao_khoi = document.getElementById('countTongFeedBack'+khoi_id);

                var thong_bao_lop = document.getElementById('countFeedBackLop'+lop_id);
                var countFeedBackLop = Number(thong_bao_lop.textContent) - 1;
                var countTongFeedBack = Number(thong_bao_khoi.textContent) - 1;
                if(countFeedBackLop > 0){
                    $('#countFeedBackLop'+lop_id).html(countFeedBackLop);
                }
                else{
                    $('#countFeedBackLop'+lop_id).css('display', 'none');
                }
                if(countTongFeedBack > 0){
                    $('#countTongFeedBack'+khoi_id).html(countFeedBackLop);
                }
                else{
                    $('#countTongFeedBack'+khoi_id).css('display', 'none');
                }
                $('#thay_doi_trang_thai'+id).html('Đã xem')
                $('#thay_doi_trang_thai'+id).css('color', 'green')
            }
            $('#preload').css('display', 'none');
        })
    }

    function DaXem(){
        var lop_id = $("#LopHocID").val();
        lop_id = Number(lop_id);
        axios.post(url_DaXemTatCa, {
            lop_id: lop_id
        })
        .then(function(response){
            response.data.forEach(element => {
                $('#thay_doi_trang_thai'+element.id).html('Đã xem')
                $('#thay_doi_trang_thai'+element.id).css('color', 'green')
            })
            $('#countFeedBackLop'+lop_id).css('display', 'none');
        })
        var countlop =  document.getElementById('countFeedBackLop'+lop_id);
        var dom_khoi = document.getElementById('KhoiCuaLop'+lop_id);
        var khoi_id = dom_khoi.value;
        var thong_bao_khoi = document.getElementById('countTongFeedBack'+khoi_id);
        var countTongFeedBack = Number(thong_bao_khoi.textContent) - Number(countlop.textContent);
        if(countTongFeedBack > 0){
            $('#countTongFeedBack'+khoi_id).html(countFeedBackLop);
        }
        else{
            $('#countTongFeedBack'+khoi_id).css('display', 'none');
        }
    }
</script>
@endsection