@extends('layouts.main')
@section('title', "Danh sách giáo trình")
@section('style')
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
<style>
    .m-widget1 .m-widget1__item .m-widget1__title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 0;
    }

    .m-widget1__item .m-widget1__title {
        color: #3f4047;
    }

    .btn {
        font-family: Arial, Helvetica, sans-serif !important
    }
</style>
@endsection
@section('content')
<div id="preload" class="preload-container text-center" style="display: none">
    <img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
  </div>
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">Quản lý giáo trình</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <div style="margin-top: 1rem" class="form-group m-form__group">
                        <select onchange="changeTuanCuaNamHoc()" class="form-control m-input m-input--square" id="chon_tuan_cua_nam_hoc">
                            {{-- @for ($i = 1; $i <= $so_luong_tuan; $i++) 
                            @if ($id_nam_hien_tai == $id_nam_hoc)
                            <option 
                            @if ($i==$tuan_chon) selected @endif
                            value="{{$i}}">Tuần {{$i}}
                            @if ($i==$tuan_hien_tai)
                            @break
                            @endif
                            </option>
                            @else
                            <option @if ($i==$tuan_chon) selected @endif
                                value="{{$i}}">Tuần {{$i}}
                                </option>
                            @endif
                            
                                @endfor --}}
                                @foreach ($danh_sach_tuan as $item)
                                {{-- <option  value="{{$item[0]}}">Tuần {{$item[0]}} ({{$item[1]}} đến {{$item[2]}})
                                </option> --}}
                                @if ($id_nam_hien_tai == $id_nam_hoc)
                                <option 
                                @if ($item[0]==$tuan_chon) selected @endif
                                value="{{$item[0]}}">Tuần {{$item[0]}} ({{$item[1]}} đến {{$item[2]}})
                                @if ($item[0]==$tuan_hien_tai)
                                @break
                                @endif
                                </option>
                                @else
                                <option @if ($item[0]==$tuan_chon) selected @endif
                                    value="{{$item[0]}}">Tuần {{$item[0]}} ({{$item[1]}} đến {{$item[2]}})
                                    </option>
                                @endif
                                @endforeach
                        </select>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="m-content">
    <div class="row">
        @foreach ($khoi as $item)
        <div class="col-xl-3">
            <!--begin:: Widgets/Top Products-->
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <div class="m-widget4__img m-widget4__img--logo">
                            </div>
                            <h3 class="m-portlet__head-text font-italic">
                                {{$item->ten_khoi}} ({{config('common.do_tuoi')[$item->do_tuoi]}})
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin::Widget5-->
                    <div class="m-widget4">
                        @foreach ($item->LopHoc as $lop_hoc)
                        <div class="m-widget4__item">
                            <div class="m-widget4__info">
                                <span class="m-widget4__title">
                                <a target="_blank" href="{{route('quan-ly-lop-show',['id'=>$lop_hoc->id])}}">
                                        {{$lop_hoc->ten_lop}}
                                    </a>
                                </span>
                                <br>
                            </div>
                            <span class="m-widget4__ext">
                                <span class="m-widget4__number m--font-danger">
                                    @if ($lop_hoc->giao_trinh !=null)
                                        @if ($lop_hoc->giao_trinh->type==1)
                                        <button type="button" data-toggle="modal"
                                            data-target="#modal_thong_tin{{$lop_hoc->giao_trinh->id}}"
                                            class="btn m-btn m-btn--gradient-from-info m-btn--gradient-to-accent">Chờ phê
                                            duyệt</button>
                                        @elseif($lop_hoc->giao_trinh->type==2)
                                        <button type="button" data-toggle="modal"
                                            data-target="#modal_thong_tin{{$lop_hoc->giao_trinh->id}}"
                                            class="btn m-btn m-btn--gradient-from-success m-btn--gradient-to-accent">Được
                                            phê duyệt</button>
                                        @elseif($lop_hoc->giao_trinh->type==3)
                                        <button type="button" data-toggle="modal"
                                        data-target="#modal_thong_tin{{$lop_hoc->giao_trinh->id}}"
                                        class="btn btn-danger">Bị từ chối</button>
                                        @endif
                                    @else
                                    <button type="button"
                                        class="btn m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning">Chưa
                                        nộp</button>
                                    @endif

                                </span>
                            </span>
                            @if ($lop_hoc->giao_trinh !=null && $lop_hoc->giao_vien_chu_nhiem!=null)
                            <div class="modal fade" id="modal_thong_tin{{$lop_hoc->giao_trinh->id}}" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{$lop_hoc->ten_lop}}
                                                ({{$lop_hoc->giao_vien_chu_nhiem['ten']}})
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <embed style="width: 100%;" src="{{$lop_hoc->giao_trinh->link_file_hd}}"
                                                width="800" height="400" type="application/pdf">
                                        </div>
                                        <div class="modal-footer">
                                            @if ($lop_hoc->giao_trinh->type!=3)
                                            <button type="button"
                                                onclick="pheDuyetGiaoTrinh(1,{{$lop_hoc->giao_trinh->id}},{{$lop_hoc->giao_vien_chu_nhiem['id']}})"
                                                class="btn btn-danger" data-dismiss="modal">Từ chối</button>
                                             @endif
                                                @if ($lop_hoc->giao_trinh->type==1)
                                                
                                            <button type="button"
                                                onclick="pheDuyetGiaoTrinh(2,{{$lop_hoc->giao_trinh->id}},{{$lop_hoc->giao_vien_chu_nhiem['id']}})"
                                                class="btn btn-primary">Phê Duyệt</button>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                    <!--end::Widget 5-->
                </div>
            </div>

            <!--end:: Widgets/Top Products-->
        </div>
        @endforeach
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready( function () {
    $("body").addClass('m-aside-left--minimize m-brand--minimize')
});
const phe_duyet_giao_trinh = "{{route('phe-duyet-giao-trinh')}}"
const pheDuyetGiaoTrinh =(type,id,id_giao_vien)=>{
    
    if(type == 1){
Swal.fire({
  title: 'Bạn có chắc chắn muốn tử chối giáo trình này?',
  text: "Lý do từ chối!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Tôi đồng ý!',
  input: 'text',
}).then((result) => {
  if(result.value){
    $('#preload').show()
    axios.post(phe_duyet_giao_trinh,{
      'id' : id,
      'id_giao_vien' : id_giao_vien,
      'ly_do_tu_choi' : result.value,
      'type' : type
    }) 
  .then(function (response) { 
    $('#preload').hide()

    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Từ chối thành công!',
        showConfirmButton: false,
        timer: 1500
    }).then(
        ()=> location.reload()
    )
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  }
})
    }else{
        $('#preload').show()
        axios.post(phe_duyet_giao_trinh,{
      'id' : id,
      'id_giao_vien' : id_giao_vien,
      'type' : type
    }) 
  .then(function (response) { 
    $('#preload').hide()

    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Phê duyệt thành công!',
        showConfirmButton: false,
        timer: 1500
    }).then(
        ()=> location.reload()
    )
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
    }

};


$("#chon_tuan_cua_nam_hoc").change(function(){  
    var url = new URL(window.location.href);
    var search_params = url.searchParams;
    search_params.set('tuan', $('#chon_tuan_cua_nam_hoc').val());
    url.search = search_params.toString();
    var new_url = url.toString();
    window.location.href = new_url
  });

</script>
@endsection