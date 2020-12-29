@extends('layouts.main')
@section('title', 'Chi tiết lớp')
@section('style')
<style>
    .m-table th,
    td {
        text-align: center;
    }
</style>
@endsection
@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                {{$lop->ten_lop}} (Năm học : {{$nam_hoc->name}})
                            </h3>
                            
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Section-->
                    <div class="m-portlet__body m-portlet__body--no-padding">
                        <div class="row m-row--no-padding m-row--col-separator-xl">
                            <div class="col-xl-6">

                                <!--begin:: Widgets/Download Files-->
                                <div class="m-portlet m-portlet--full-height ">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Giáo viên quản lý lớp
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">

                                        <!--begin::m-widget4-->
                                        @foreach ($giao_vien as $item)
                                        <div class="m-widget4">
                                            <div class="m-widget4__item">
                                                <div class="m-widget4__img m-widget4__img--pic">
                                                    <img src= {{($item->anh == "") ? 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png' : $item->anh}}
                                                    class="rounded mx-auto d-block mb-2">
                                                </div>
                                                <div class="m-widget4__info">
                                                    <span class="m-widget4__title">
                                                        {{$item->ten}}
                                                    </span><br>
                                                    <span class="m-widget4__sub">
                                                        {{ $item->type == 1 ?'Giáo viên chính':'Giáo viên phụ' }}
                                                    </span>
                                                </div>
                                                <div class="m-widget4__ext">
                                                    <a href="{{route('quan-ly-giao-vien-edit', ['id' => $item->id])}}"
                                                        class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">Chi
                                                        tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <!--end::Widget 9-->
                                    </div>
                                </div>

                                <!--end:: Widgets/Download Files-->
                            </div>
                            <div class="col-xl-6">
                                <div class="m-portlet m-portlet--full-height ">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Học phí tháng mới nhất: 
                                                    @if(isset($thang_thu_moi_nhat))
                                                    {{$thang_thu_moi_nhat->thang_thu}}/{{$thang_thu_moi_nhat->nam_thu}}
                                                    @endif
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <canvas id="BieuDoHocPhi" width="400" height="200"></canvas>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end::Section-->
                </div>
            </div>

            <div class=" d-flex flex-row-reverse bd-highlight mb-4 ">
                <a href="{{ route('nhanxet.show',['id' => $lop->id])}}" class="btn btn-secondary m-btn m-btn--icon">
                    <span>
                        <i class="la la-comment"></i>
                        <span>Nhận Xét</span>
                    </span>
                </a>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
    <div class="m-portlet">
        <div class="m-portlet__body table-responsive">
            <table class="table table-bordered table-hover">
                
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Mã học sinh</th>
                        <th>Họ tên</th>
                        <th>Ảnh học sinh</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th colspan="2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($hoc_sinh)>0)
                    @php
                    $i = 1
                    @endphp
                    @endif
                    @foreach ($hoc_sinh as $item)
                    <tr>
                    <th scope="row">{{$i++}}</th>
                        <td>{{$item->ma_hoc_sinh}}</td>
                        <td>{{$item->ten}}</td>
                        <td><img width="100px"
                                src={{($item->avatar == "") ? "https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png" :  $item->avatar}} alt="">
                        </td>
                        <td>{{date("d/m/Y", strtotime($item->ngay_sinh))}}</td>
                        <td>{{ config('common.gioi_tinh')[$item->gioi_tinh] }}</td>
                        <td><a class="btn btn-success" href="{{ route('quan-ly-hoc-sinh-edit', ['id' => $item->id]) }}">Chi
                                tiết</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{!! asset('assets/vendors/custom/flot/flot.bundle.js') !!}"></script>
<script>
    var ctx = document.getElementById('BieuDoHocPhi');
    var BieuDoHocPhi = new Chart(ctx, {
        type: 'doughnut',
        data : {
            datasets: [{
                data: [{{$so_tien_con_phai_dong}}, {{$so_tien_da_dong}}],
                backgroundColor: ['rgba(255, 99, 132)','rgba(46, 234, 138)'],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Tổng tiền còn phải đóng',
                'Tổng tiền đã đóng '
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endsection