@extends('layouts.main')
@section('title', "Chi tiết đơn nghỉ học")
@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-lg-12">

            <!--begin::Portlet-->
            <div class="m-portlet" id="m_portlet">
                <div class="m-portlet" >
                    <div class="m-portlet__body m-portlet__body--no-padding" style="background-color: #f3f3e1">
                        <div class="m-invoice-2">
                            <div class="m-invoice__wrapper">
                                <div class="m-invoice__head">
                                    <div class="m-invoice__container m-invoice__container--centered">
                                        <div class="m-invoice__logo">
                                            <center><h1>ĐƠN XIN NGHỈ HỌC</h1></center>
                                        </div>
                                        <div class="m-divider">
                                            <span></span>
                                            <span>*****</span>
                                            <span></span>
                                        </div>
                                        <div class="m-invoice__items" style="border-top: none !important">
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Họ và Tên:</span>
                                                <span class="m-invoice__text">{{ $data->HocSinh->ten }}</span>
                                            </div>
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Nghỉ từ ngày:</span>
                                                <span class="m-invoice__text">{{ $data->ngay_bat_dau }}</span>
                                            </div>
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Đến hết ngày:</span>
                                                <span class="m-invoice__text">{{ $data->ngay_ket_thuc }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-invoice__body m-invoice__body--centered">
                                    <b>Nội dung đơn</b>
                                    <hr>
                                    <p style="text-indent: 1.5rem">
                                        <em>{{ $data->noi_dung }}</em>
                                    </p>
                                </div>
                                <div class="m-invoice__footer" style="background-color: #f3f3e1">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <!--end::Portlet-->
        </div>
    </div>
</div>
@endsection
