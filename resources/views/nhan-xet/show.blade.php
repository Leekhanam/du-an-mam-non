@extends('layouts.main')
@section('title', "Nhận xét")
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
<style>
    #loading_time{
        position: absolute;
        top: 40%;
        left: 45%;
        display: none;
    }
    #table1_info{
        display: none;
    }
</style>
@endsection
@section('content')
<div class="m-content">
    <!--begin::Portlet-->
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        NHẬN XÉT {{ $lop->ten_lop}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">
                            <table
                                class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap dataTable dtr-inline display"
                                id="table1">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onclick="checkAll(this)"></th>
                                        <th>STT</th>
                                        <th>Mã Số</th>
                                        <th>Ảnh</th>
                                        <th>Họ và Tên</th>
                                        <th>Ngày Sinh</th>
                                        <th>Giới Tính</th>
                                        <th>Chi Tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $key => $item)
                                    @php
                                        $date = date_create($item->ngay_sinh);
                                    @endphp
                                            <tr style="cursor: pointer" onclick="getData(this)" data-id="{{ $item->id }}"> 
                                            <td><input type="checkbox" class="checkbox" data-id="{{ $item->id }}"></td>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->ma_hoc_sinh }}</td>
                                            <td><img width="50" class="img-thumbnail" src="https://ui-avatars.com/api/?name={{$item->ten}}&background=random" alt=""></td>
                                            <td>{{ $item->ten }}</td>
                                            <td>{{ date_format($date,"d/m/Y") }}</td>
                                            <th>@foreach (config('common.gioi_tinh') as $key => $vlaue)
                                                    @if ($item->gioi_tinh == $key)
                                                        {{$vlaue}}
                                                    @endif
                                                @endforeach</th>
                                            <th><a href="{{ route('quan-ly-hoc-sinh-edit',['id' => $item->id]) }}"><i class="flaticon-exclamation text-warning"></i></a></th>    
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <input type="date" class="form-control m-input" name="search_time" value="{{ date('Y-m-d', time()) }}" onchange="changeTimeSearch(this)">
                    <div id="box_nhan_xet">
                        <center id="loading_time"><img width="50" src="{{ asset('images/loading1.gif') }}"></center>
                        <form id="form_nhan_xet" class="m-form m-form--fit m-form--label-align-right " style="background-color: #f7f8fa" onsubmit="return false">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    <label for="nhan_xet_ngay" style="cursor: pointer">Nhận Xét</label>
                                    <input type="text" class="form-control m-input m-input--air" id="nhan_xet_ngay" placeholder="..." name="nhan_xet_ngay" readonly>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="bua_an" style="cursor: pointer">Bữa Ăn</label>
                                    <input type="text" class="form-control m-input m-input--air" id="bua_an" placeholder="..." name="bua_an" readonly>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="ngu" style="cursor: pointer">Ngủ</label>
                                    <input type="text" class="form-control m-input m-input--air" id="ngu" placeholder="..." name="ngu" readonly>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="ve_sinh" style="cursor: pointer">Vệ Sinh</label>
                                    <input type="text" class="form-control m-input m-input--air" id="ve_sinh" placeholder="..." name="ve_sinh" readonly>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
           
        </div>
    </div>
    <!--end::Portlet-->
</div>

</div>

@endsection
@section('script')

<script src="{{ asset('assets/jquery/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- https://viblo.asia/p/tim-hieu-jquery-datatables-co-ban-trong-10-phut-07LKXp4eKV4 -->
<script>
    $(document).ready(function () {
        $('#table1').DataTable({
            "pageLength": 100,
            "paging": false,
            "scrollY": "400px",
            "scrollCollapse": true,
        });
    });

    const checkAll = (e) => {
        $('#table1').find(".checkbox").not(e).prop("checked", e.checked);
    };

    function getData(e){
        let search_time = $('[name="search_time"]').val();
        let hoc_sinh_id = e.getAttribute('data-id');
        $('#loading_time').css('display', 'block');

        axios.post("{{ route('nhanxet.find') }}",{
            search_time: search_time,
            hoc_sinh_id: hoc_sinh_id
        })
        .then(res => {
            $('#loading_time').css('display', 'none');
            let nhan_xet_ngay = res.data.nhan_xet_ngay ? res.data.nhan_xet_ngay : '';
            let bua_an = res.data.bua_an ? res.data.bua_an : '';
            let ngu = res.data.ngu ? res.data.ngu : '';
            let ve_sinh = res.data.ve_sinh ? res.data.ve_sinh : '';

            $("[name='nhan_xet_ngay']").val(nhan_xet_ngay);
            $("[name='bua_an']").val(bua_an);
            $("[name='ngu']").val(ngu);
            $("[name='ve_sinh']").val(ve_sinh);
        })
    }

    function changeTimeSearch(e){
        $('#loading_time').css('display', 'block');
        setTimeout(function(){
            $('#loading_time').css('display', 'none');
            $("[name='nhan_xet_ngay']").val('');
            $("[name='bua_an']").val('');
            $("[name='ngu']").val('');
            $("[name='ve_sinh']").val('');
        },500)
    }
    
</script>
@endsection
