@extends('layouts.main')
@section('title', "Chi tiết đơn dặn thuốc")
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
                                            <center><h1>CHI TIẾT ĐƠN DẶN THUỐC </h1></center>
                                        </div>
                                        <div class="m-divider">
                                            <span></span>
                                          
                                            <span></span>
                                        </div>
                                        <div class="m-invoice__items" style="border-top: none !important">
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Họ tên học sinh:</span>
                                                <span class="m-invoice__text">{{$data->HocSinh->ten}}</span>
                                            </div>
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Nội dung đơn::</span>
                                                <span class="m-invoice__text"><em>{{$data->noi_dung}}</em></span>
                                            </div>
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Dặn uống thuốc từ ngày:</span>
                                                <span class="m-invoice__text">{{$data->ngay_bat_dau}}</span>
                                            </div>
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Đến hết ngày:</span>
                                                <span class="m-invoice__text">{{$data->ngay_ket_thuc}}</span>
                                            </div>
                                        </div>
                                        @foreach($data->ChiTietDonThuoc as $item)
                                        <div class="m-invoice__items" style="border-top: none !important">
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Tên Thuốc:</span>
                                             
                                                <span class="m-invoice__text">{{$item->ten_thuoc}}</span>
                                            </div>
                                           
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Liều lượng:</span>
                                                <span class="m-invoice__text">{{$item->lieu_luong}} {{$item->don_vi}}</span>
                                            </div>
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Ghi chú:</span>
                                                <span class="m-invoice__text">{{$item->ghi_chu}}</span>
                                            </div>
                                            <div class="m-invoice__item">
                                                <span class="m-invoice__subtitle">Phản hồi giáo viên:</span>
                                                <span class="m-invoice__text">{{$item->phan_hoi_giao_vien}}</span>
                                            </div>
                                            <div class="m-invoice__item">
                                                <b>Hình ảnh:</b>
                                                <p style="text-indent: 1.5rem">
                                                <img src="{{asset($item->anh)}}" style="width:180px;height:auto;padding-top:20px" alt="" class=" m-invoice__text zoomable">
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
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
@section('script')
<script src="http://static.tumblr.com/xz44nnc/o5lkyivqw/jquery-1.3.2.min.js"></script>
<script>
$('img.zoomable').css({cursor: 'pointer'}).live('click', function () {
  var img = $(this);
  var bigImg = $('<img />').css({
    'max-width': '100%',
    'max-height': '100%',
    'display': 'inline'
  });
  bigImg.attr({
    src: img.attr('src'),
    alt: img.attr('alt'),
    title: img.attr('title')
  });
  var over = $('<div />').text(' ').css({
    'height': '100%',
    'width': '100%',
    'background': 'rgba(0,0,0,.82)',
    'position': 'fixed',
    'top': 0,
    'left': 0,
    'opacity': 0.0,
    'cursor': 'pointer',
    'z-index': 9999,
    'text-align': 'center'
  }).append(bigImg).bind('click', function () {
    $(this).fadeOut(300, function () {
      $(this).remove();
    });
  }).insertAfter(this).animate({
    'opacity': 1
  }, 300);
});
</script>
@endsection
