@extends('layouts.main')
@section('title', 'Chuyển hồ sơ sang năm học mới')
@section('style')
<style>
    .m-wizard.m-wizard--2 .m-wizard__head .m-wizard__nav .m-wizard__steps .m-wizard__step .m-wizard__step-info .m-wizard__step-title {
        font-size: 1.1rem;
    }

    .danh-sach-lop {
        position: sticky;
    }

    .danh-sach-lop th {
        position: sticky;
        top: 0;
    }

    .scoll-tabel {
        overflow: auto;
        height: 400px;
    }

    .danh-sach-lop td {
        font-size: 11px;
    }
</style>
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="m-content">
    <div class="row">
        <div id="preload" class="preload-container text-center" style="display: none">
            <img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
        </div>
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--full-height">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Chuyển hồ sơ sang năm học mới <input type="hidden" id="nam_hoc_moi"
                                    value="{{$nam_hoc_moi->id}}">
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="#" data-toggle="m-tooltip"
                                    class="m-portlet__nav-link m-portlet__nav-link--icon" data-direction="left"
                                    data-width="auto" title="" data-original-title="Get help with filling up this form">
                                    <i class="flaticon-info m--icon-font-size-lg3"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-wizard m-wizard--2 m-wizard--success m-wizard--step-first" id="m_wizard">
                    <div class="m-portlet__padding-x">
                    </div>
                    <div class="m-wizard__head m-portlet__padding-x">
                        <div class="m-wizard__progress">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 0%;"></div>
                            </div>
                        </div>
                        <div class="m-wizard__nav">
                            <div class="m-wizard__steps">
                                <div class="m-wizard__step m-wizard__step--current"
                                    m-wizard-target="m_wizard_form_step_1">
                                    <a href="#" class="m-wizard__step-number">
                                        <span><i class="fa  flaticon-placeholder"></i></span>
                                    </a>
                                    <div class="m-wizard__step-info">
                                        <div class="m-wizard__step-title">
                                            1. Chuyển hồ sơ khối lớp học sang năm học mới
                                        </div>
                                    </div>
                                </div>
                                <div class="m-wizard__step" m-wizard-target="m_wizard_form_step_2">
                                    <a href="#" class="m-wizard__step-number">
                                        <span><i class="fa  flaticon-layers"></i></span>
                                    </a>
                                    <div class="m-wizard__step-info">
                                        <div class="m-wizard__step-title">
                                            2. Chuyển hồ sơ học sinh sang năm học mới
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-wizard__form">

                        <form class="m-form m-form--label-align-left- m-form--state-" id="m_form"
                            action="{{ route('quan-ly-hoc-sinh-store') }}" method="POST">
                            <div class="m-portlet__body">
                                @csrf
                                <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                                    <div class="m-portlet__head d-flex justify-content-end">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <button type="button" style="display: block;" id="button_chuyen_lop"
                                                    class="btn m-btn m-btn--gradient-from-success m-btn--gradient-to-accent mr-3"
                                                    data-toggle="modal" data-target="#modal-sao-luu">Thực
                                                    hiện sao lưu khối lớp học</button>


                                                <div class="modal fade" id="modal-sao-luu" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">CHUYỂN HỒ
                                                                    SƠ LÊN NĂM
                                                                    HỌC {{$nam_hoc_moi->name}} </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Thao tác này sẽ sao chép toàn bộ dữ liệu <b>lớp
                                                                        học</b> của năm
                                                                    hiện tại sang năm mới.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Hủy</button>
                                                                <span onclick="saoLuuKhoiLop()"
                                                                    class="btn btn-primary">Thực
                                                                    hiện</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="m-portlet">
                                                <div class="m-portlet__head">
                                                    <div class="m-portlet__head-caption">
                                                        <div class="m-portlet__head-title">
                                                            <h3 class="m-portlet__head-text">
                                                                Danh sách khối lớp học năm học {{$nam_hoc_cu->name}}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-portlet__body">

                                                    <!--begin::Section-->
                                                    <div class="m-section">
                                                        <div class="m-section__content scoll-tabel">
                                                            <table
                                                                class="table table-bordered table-striped table-hover m-table m-table--head-bg-brand danh-sach-lop">
                                                                <thead>
                                                                    <tr>
                                                                        <th>STT</th>
                                                                        <th>TÊN LỚP</th>
                                                                        <th>KHỐI</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                    $i = 1
                                                                    @endphp
                                                                    @foreach ($data_lop_cu as $item)
                                                                    <tr>
                                                                        <td scope="row">{{$i++}}</td>
                                                                        <td>{{$item->ten_lop}}</td>

                                                                        <td>{{$item->Khoi->ten_khoi}} ({{config('common.do_tuoi')[$item->Khoi->do_tuoi]}})</td>
                                                                    </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <!--end::Section-->
                                                </div>

                                                <!--end::Form-->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="m-portlet">
                                                <div class="m-portlet__head">
                                                    <div class="m-portlet__head-caption">
                                                        <div class="m-portlet__head-title">
                                                            <h3 class="m-portlet__head-text">
                                                                Danh sách khối lớp học năm học {{$nam_hoc_moi->name}}

                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-portlet__body">

                                                    <!--begin::Section-->
                                                    <div class="m-section">
                                                        <div class="m-section__content scoll-tabel">
                                                            <table
                                                                class="table table-bordered table-striped table-hover m-table m-table--head-bg-brand danh-sach-lop ">
                                                                <thead>
                                                                    <tr>
                                                                        <th>STT</th>
                                                                        <th>TÊN LỚP</th>
                                                                        <th>KHỐI</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="danh-sach-lop-moi">


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <!--end::Section-->
                                                </div>

                                                <!--end::Form-->
                                            </div>
                                        </div>

                                    </div>
                                </div>




                                <div class="m-wizard__form-step" id="m_wizard_form_step_2">
                                    <div class="m-portlet__head d-flex justify-content-end">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <button type="button" style="display: block;" id="button_chuyen_lop"
                                                    class="btn m-btn m-btn--gradient-from-success m-btn--gradient-to-accent mr-3"
                                                    data-toggle="modal" data-target="#modal-len-lop">Thực hiện cho học
                                                    sinh lên
                                                    lớp</button>



                                                <div class="modal fade" id="modal-len-lop" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">CHUYỂN HỒ
                                                                    SƠ LÊN NĂM
                                                                    HỌC {{$nam_hoc_moi->name}} </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Thao tác này sẽ sao chép toàn bộ dữ liệu <b>học
                                                                        sinh</b> của năm
                                                                    hiện tại sang năm mới.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Hủy</button>
                                                                <span onclick="lenLopChoHocSinh()"
                                                                    class="btn btn-primary">Thực
                                                                    hiện</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="m-portlet">
                                                <div class="m-portlet__head">
                                                    <div class="m-portlet__head-caption">
                                                        <div class="m-portlet__head-title">
                                                            <h3 class="m-portlet__head-text">
                                                                Thông tin chuyển lớp học sinh năm học
                                                                {{$nam_hoc_cu->name}}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-portlet__body">

                                                    <!--begin::Section-->
                                                    <div class="m-section">
                                                        <div class="m-section__content scoll-tabel">
                                                            <table
                                                                class="table table-bordered table-striped table-hover m-table m-table--head-bg-brand danh-sach-lop ">
                                                                <thead>
                                                                    <tr>
                                                                        <th>STT</th>
                                                                        <th>TÊN LỚP</th>
                                                                        <th>TỔNG SỐ HỌC SINH</th>
                                                                        <th>LỚP HỌC CHUYỂN LÊN</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="xet_len_lop">
                                                              

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <!--end::Section-->
                                                </div>

                                                <!--end::Form-->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="m-portlet">
                                                <div class="m-portlet__head">
                                                    <div class="m-portlet__head-caption">
                                                        <div class="m-portlet__head-title">
                                                            <h3 class="m-portlet__head-text">
                                                                Thông tin học sinh năm học {{$nam_hoc_moi->name}}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-portlet__body">

                                                    <!--begin::Section-->
                                                    <div class="m-section">
                                                        <div class="m-section__content scoll-tabel">
                                                            <table
                                                                class="table table-bordered table-striped table-hover m-table m-table--head-bg-brand danh-sach-lop">
                                                                <thead>
                                                                    <tr>
                                                                        <th>STT</th>
                                                                        <th>TÊN LỚP</th>
                                                                        <th>TỔNG SỐ HỌC SINH MỚI</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="da_len_lop">
                                                                   
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <!--end::Section-->
                                                </div>

                                                <!--end::Form-->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
                                <div class="m-form__actions">
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-4 m--align-left">
                                            <a href="#" class="btn btn-secondary m-btn m-btn--custom m-btn--icon"
                                                data-wizard-action="prev">
                                                <span>
                                                    <i class="la la-arrow-left"></i>&nbsp;&nbsp;
                                                    <span>Quay lại</span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 m--align-right">
                                        <a id="quan_ly_nam_hoc" style="display: none !important" href="{{route('nam-hoc-chi-tiet',['id'=>$nam_hoc_moi->id])}}"
                                                class="btn btn-primary m-btn m-btn--custom m-btn--icon"
                                                data-wizard-action="prev">
                                                <span>
                                                    <i class="la la-check"></i>&nbsp;&nbsp;
                                                    <span>Quản lý năm học</span>
                                                </span>
                                            </a>
                                            <button id="tiep_tuc"  style="display: none" onclick="getDuLieuLenLop()" class="btn btn-warning m-btn m-btn--custom m-btn--icon"
                                                data-wizard-action="next">
                                                <span>
                                                    <span> Tiếp Tục</span>&nbsp;&nbsp;
                                                    <i class="la la-arrow-right"></i>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="col-lg-2"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
   var url_sao_chep_khoi_lop = "{{route('post-chuyen-du-lieu-nam-hoc')}}";
var url_get_khoi_lop_nam_hoc_moi = "{{route('get-du-lieu-khoi-lop-nam-moi')}}";
var url_len_lop_cho_hoc_sinh = "{{route('len-lop-cho-hoc-sinh')}}";
var url_get_danh_sach_len_lop = "{{route('get-du-lieu-len_lop',['pardam'])}}"
var url_get_thong_tin_len_lop_nam_hoc_moi = "{{route('du-lieu-nam-hoc-moi-len-lop')}}"
$('#danh_sach_nam_hoc_session').hide()
window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || 
                         ( typeof window.performance != "undefined" && 
                              window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
    window.location.reload();
  }
});
console.log('fsfasdf', url_get_danh_sach_len_lop)
const saoLuuKhoiLop = () => {
    $('#preload').show()
    axios.post(url_sao_chep_khoi_lop, {
            'nam_hoc_moi': $('#nam_hoc_moi').val()
        })
        .then(function(response) {
            $('#tiep_tuc').show()
            $('#modal-sao-luu').modal('hide');
            getKhoiLopNamHocMoi()
        })
        .catch(function(error) {
            console.log(error);
            $('#preload').hide()
            $('#modal-sao-luu').modal('hide');

            Swal.fire({
                icon: 'error',
                text: 'Năm học đã có dữ liệu',
            })
        });
};

var do_tuoi_config = {!! json_encode(config("common.do_tuoi")) !!};

const getKhoiLopNamHocMoi = () => {
    axios.post(url_get_khoi_lop_nam_hoc_moi, {
            'id': $('#nam_hoc_moi').val()
        })
        .then(function(response) {

            var html_danh_sach_lop_moi = ""
            var i = 1;
            if(response.data.data_lop_moi.length>0){
                $('#tiep_tuc').removeAttr('disabled')
            }
            response.data.data_lop_moi.forEach(element => {
                var do_tuoi = element.khoi.do_tuoi
                
                html_danh_sach_lop_moi += `
            <tr>
                <td scope="row">${i++}</td>
                <td>${element.ten_lop}</td>
                <td>${element.khoi.ten_khoi} (${do_tuoi_config[element.khoi.do_tuoi]})</td>
            </tr>
            `
            });
            $('.danh-sach-lop-moi').html(html_danh_sach_lop_moi)
            $('#preload').hide()
        })
        .catch(function(error) {
            console.log(error);
        });
};
getKhoiLopNamHocMoi()

// const lenLopHocSinh = () => {

// };

const lenLopChoHocSinh = () => {

    $('#preload').show()
    var danh_sach_lop = document.querySelectorAll('.len_lop')
    const data_len_lop = [];

    danh_sach_lop.forEach(element => {
        var len_lop = $(element).find('.chon_lop').val()
        const count = data_len_lop.push(len_lop);
    });
    axios.post(url_len_lop_cho_hoc_sinh, {
            'data_len_lop': data_len_lop
        })
        .then(function(response) {
            $('#preload').hide()
            $('#modal-len-lop').modal('hide');
            $('#quan_ly_nam_hoc').show();
            getDuLieuLenLopNamHocMoi();
        })
        
        .catch(function(error) {
            console.log(error);
            $('#preload').hide()
            $('#modal-len-lop').modal('hide');

            Swal.fire({
                icon: 'error',
                text: 'Đã thực hiện lên lớp cho học sinh',
            })
        });
};

const getDuLieuLenLop = () => {
    var url_get_len_lop = url_get_danh_sach_len_lop.replaceAll('pardam', $('#nam_hoc_moi').val())
    axios.get(url_get_len_lop)
        .then(function(response) {
            var html_danh_sach_lop_moi = ""
            var i = 1;
            console.log(response.data)
            response.data.forEach(element => {
                html_danh_sach_lop_moi += `
                <tr class="len_lop">
            <td scope="row">${i++}</td>
            <td>${element.ten_lop} </br> (${do_tuoi_config[element.do_tuoi]})</td>
            <td>${element.tong_hoc_sinh}</td>
            <td>
                <select
                    class="form-control m-input m-input--square chon_lop"
                    id="exampleSelect1">`
                if (element.len_lop_tiep_theo.length > 0) {
                    html_danh_sach_lop_moi += `<option value="[${element.id},-1]">Chọn lớp</option>`
                } else {
                    html_danh_sach_lop_moi += `<option value="[${element.id},-2]">Chọn lớp </option>`
                }
                // console.log(element.LenLopTiepTheo)
                element.len_lop_tiep_theo.forEach(element1 => {
                    html_danh_sach_lop_moi += ` <option
                         value="[${element.id},${element1.id}]">
                          ${element1.ten_lop}</option>`
                });
                html_danh_sach_lop_moi += `
                </select>
            </td>
        </tr>
                `
            });
            $('#xet_len_lop').html(html_danh_sach_lop_moi)
        })
        .catch(function(error) {
            console.log(error);
            $('#preload').hide()
            $('#modal-sao-luu').modal('hide');

            Swal.fire({
                icon: 'error',
                text: 'Đã thực hiện lên lớp cho học sinh',
            })
        });
};
const getDuLieuLenLopNamHocMoi = () =>{
    
    axios.get(url_get_thong_tin_len_lop_nam_hoc_moi)
        .then(function(response) {
            console.log(response.data)
            var html_danh_sach_da_le_lop_moi = ""
            var i = 1;
            response.data.forEach(element => {
                html_danh_sach_da_le_lop_moi += `
                <tr>
                <td scope="row">${i++}</td>
                <td>${element.ten_lop} </br> (${do_tuoi_config[element.do_tuoi]})</td>
                <td>${element.tong_hoc_sinh}</td>
            </tr>
                `
            });
            $('#da_len_lop').html(html_danh_sach_da_le_lop_moi)
        })
        .catch(function(error) {
            console.log(error);
            $('#preload').hide()
            $('#modal-sao-luu').modal('hide');

            Swal.fire({
                icon: 'error',
                text: 'Đã thực hiện lên lớp cho học sinh',
            })
        });
};
getDuLieuLenLopNamHocMoi()
// getDuLieuLenLop()
</script>
@endsection