@extends('layouts.main')
@section('title', "Quản lý đơn dặn thuốc")
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
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> --}}
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
                                        Năm học: {{$namhoc->name}} <input type="hidden" name="" id="nam_hoc"
                                            value="{{$namhoc->id}}">
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
                                                            <li class="m-nav__item pl-4 lop_hoc" onclick=""
                                                                id='lop_{{$lop_hoc->id}}' style="cursor: pointer">
                                                                <span href="" class="m-nav__link"
                                                                    onclick="studensInClass({{$lop_hoc->id}})">
                                                                    <span class="m-nav__link-text "> <span
                                                                            class="ten_lop"> {{$lop_hoc->ten_lop}}
                                                                        </span>
                                                                    </span>
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

            <div class="col-md-9 table-responsive scoll-table">
                <table id="table-hoc-sinh" class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline thong-tin-hoc-sinh-cua-lop" style="cursor: pointer">
                    <thead>
                        <tr align="center">
                            <th style="width: 10%;">Số thứ tự</th>
                            <th style="width: 15%;">Mã học sinh</th>
                            <th style="width: 20%;">Họ tên</th>
                            <th style="width: 15%;">Ngày sinh</th>
                            <th style="width: 15%;">Giới tính</th>
                        </tr>
                    </thead>
                    <thead class="filter">
                        <tr>
                            <td scope="row"><input class="form-control search m-input " type="hidden"></td>
                            <td scope="row"><input class="form-control search m-input search-mahs" type="text"></td>
                            <td scope="row"><input class="form-control search m-input search-ten" type="text"></td>
                            <td scope="row"><input class="form-control search m-input search-ngaysinh" type="text"></td>
                            <td scope="row" style="width:100px">
                                <select class="form-control search m-input search-gioitinh m-input--square"
                                    id="exampleSelect1">
                                    <option value="">Chọn</option>
                                    <option>Nam</option>
                                    <option>Nữ</option>
                                </select>
                            </td>
                        </tr>
                    </thead>
                    <tbody id="show-data-hoc-sinh" align="center">
                    </tbody>
                </table>


            </div>
        </div>
    </div>
    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thống kê đơn dặn thuốc</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <div class="row">
                           <div class="col-6">
                            <select class="form-control m-input form-control-sm" style="width: 30%" onchange="showDonDanThuocTheoThang()" id="array_thang"  data-hoc_sinh_id="">
                                @foreach ($array_thang as $item)
                                    <option value="{{ $item }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                           </div>
                           <div class="col-6"><span>Số đơn trong tháng: <span class="so-don text-danger">0</span> </span></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <tbody>
                                      <tr>
                                          <td><span>1</span><br><span class="reset-don ngay-1 pull-right"></span></td>      
                                          <td><span>2</span><br><span class="reset-don ngay-2 pull-right"></span></td>
                                          <td><span>3</span><br><span class="reset-don ngay-3 pull-right"></span></td>
                                          <td><span>4</span><br><span class="reset-don ngay-4 pull-right"></span></td>
                                          <td><span>6</span><br><span class="reset-don ngay-6 pull-right"></span></td>
                                          <td><span>7</span><br><span class="reset-don ngay-7 pull-right"></span></td> 
                                          <td><span>8</span><br><span class="reset-don ngay-8 pull-right"></span></td>
                                          <td><span>9</span><br><span class="reset-don ngay-9 pull-right"></span></td>
                                      </tr>
                                      <tr>
                                          <td><span>10</span><br><span class="reset-don ngay-10 pull-right"></span></td>      
                                          <td><span>11</span><br><span class="reset-don ngay-11 pull-right"></span></td>
                                          <td><span>12</span><br><span class="reset-don ngay-12 pull-right"></span></td>
                                          <td><span>13</span><br><span class="reset-don ngay-13 pull-right"></span></td>
                                          <td><span>14</span><br><span class="reset-don ngay-14 pull-right"></span></td>
                                          <td><span>15</span><br><span class="reset-don ngay-15 pull-right"></span></td> 
                                          <td><span>16</span><br><span class="reset-don ngay-16 pull-right"></span></td>
                                          <td><span>17</span><br><span class="reset-don ngay-17 pull-right"></span></td>
                                      </tr>
                                      <tr>
                                          <td><span>18</span><br><span class="reset-don ngay-18 pull-right"></span></td>      
                                          <td><span>19</span><br><span class="reset-don ngay-19 pull-right"></span></td>
                                          <td><span>20</span><br><span class="reset-don ngay-20 pull-right"></span></td>
                                          <td><span>21</span><br><span class="reset-don ngay-21 pull-right"></span></td>
                                          <td><span>22</span><br><span class="reset-don ngay-22 pull-right"></span></td>
                                          <td><span>23</span><br><span class="reset-don ngay-23 pull-right"></span></td> 
                                          <td><span>24</span><br><span class="reset-don ngay-24 pull-right"></span></td>
                                          <td><span>25</span><br><span class="reset-don ngay-25 pull-right"></span></td>
                                      </tr>
                                      <tr>
                                          <td><span>26</span><br><span class="reset-don ngay-26 pull-right"></span></td>      
                                          <td><span>27</span><br><span class="reset-don ngay-27 pull-right"></span></td>
                                          <td><span>28</span><br><span class="reset-don ngay-28 pull-right"></span></td>
                                          <td><span>29</span><br><span class="reset-don ngay-29 pull-right"></span></td>
                                          <td><span>30</span><br><span class="reset-don ngay-30 pull-right"></span></td>
                                          <td><span>31</span><br><span class="reset-don ngay-31 pull-right"></span></td> 
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                   
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
</div>
@endsection
@section('script')

<script>
    var dtable;
    $(document).ready(function () {
        dtable = $('#table-hoc-sinh')
        $('.search-mahs').on('keyup change', function () {
            dtable
                .column(2).search(this.value)
                .draw();
        });

        $('.search-ten').on('keyup change', function () {
            dtable
                .column(2).search(this.value)
                .draw();
        });

        $('.search-ngaysinh').on('keyup change', function () {
            dtable
                .column(3).search(this.value)
                .draw();
        });

        $('.search-gioitinh').on('change', function () {
            dtable
                .column(4).search(this.value)
                .draw();
        });
    });

</script>
<script>
    function studensInClass(lop_id) {
        $('#preload').css('display', 'block');
        axios.post("{{ route('show-hs-theo-lop') }}", {
                lop_id: lop_id
            })
            .then(response => {
                var html_show = "";
                response.data.forEach((element, key) => {
                    if (element.gioi_tinh == 0) {
                        element.gioi_tinh = "Nam"
                    } else {
                        element.gioi_tinh = "Nữ"
                    }
                    var date = new Date(element.ngay_sinh),
                        yr = date.getFullYear(),
                        month = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),
                        day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
                        newDate = day + '-' + month + '-' + yr;
                    html_show += `
                                <tr data-toggle="modal" data-target="#m_modal_4" onclick="setDataId(${element.id})">
                                    <th>${++key}</th>
                                    <td>${element.ma_hoc_sinh}</td>
                                    <td>${element.ten}</td>
                                    <td>${newDate}</td>
                                    <td>${element.gioi_tinh}</td>
                                </tr>
                                `
                })
                $('#show-data-hoc-sinh').html(html_show);
                $('#preload').css('display', 'none');
            })
    }

    function showDonDanThuocTheoThang(){
        $('#preload').css('display', 'block');
        let hoc_sinh_id = document.querySelector('#array_thang').getAttribute('data-hoc_sinh_id');
        let thang = $('#array_thang').val();

        axios.post("{{ route('don-dan-thuoc-theo-thang')}}",{
            'hoc_sinh_id': hoc_sinh_id,
            'thang': thang,
            }).then(response => {
                console.log(response.data);
                $(`.reset-don`).html(`<div style=" height: 23px"></div>`);
                var html_show = "";
                $(`.reset-don`).parent().css({"border": "1px solid #f4f5f8"});
                response.data.forEach((element) => {
                    var date = new Date(element.ngay_bat_dau);
                        day = date.getDate();
                        $(`.ngay-${day}`).html(`<a target="_blank" href="${ route('don-dan-thuoc.show',{'id': element.id}) }"><i class="fa fa-file-alt text-warning"></i></a>`);
                        $(`.ngay-${day}`).parent().css({"border": "2px solid red"});
                })
                $('#preload').css('display', 'none');
                $('.so-don').html(response.data.length);
            });
    }

    function setDataId(id){
        $('#array_thang').attr('data-hoc_sinh_id', id);
        showDonDanThuocTheoThang();
    }

</script>

<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endsection
