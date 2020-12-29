@extends('layouts.main')
@section('title', "Quản lý giáo viên")
@section('style')
<style>
    .paginate_button {
        /* background-color: red !important */
    }
    .select2-container--default .select2-results__option[aria-disabled=true] {
        display: none;
    }
</style>
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<div class="m-content">
    <div id="preload" class="preload-container text-center" style="display: none">
        <img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
      </div>
    <div class="row">
        <div class="col-lg-12">

            <!--begin::Portlet-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Phân lớp cho giáo viên
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin::Section-->
                    <div class="m-section m-section--last">
                        <table class="table  m-table">
                            <thead>
                                <tr>
                                    <th>Stt </th>
                                    <th>Lớp</th>
                                    <th style="width: 40%;">Phân công giáo viên phụ trách</th>
                                    <th style="width: 40%;">Phân công giáo viên hỗ trợ</th>
                                </tr>
                            </thead>
                            <input type="hidden" name="" id="data_giao_vien" value="{{$data_giao_vien}}">
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($data_lop as $item)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$item->ten_lop}}</td>
                                    <td class="chon_giao_vien" id_gv={{$item->id}}>
                                        <select onchange="updateLop(this)" lop_cn_id='{{$item->id}} '
                                            @if (Session::has('id_nam_hoc'))
                                            {{ Session::get('id_nam_hoc') != $id_nam_hien_tai ?'disabled':''}}
                                        @endif
                                            class="form-control giao_vien_chinh giao_vien{{$item->id}} "
                                            name="giao_vien_chu_nhiem">
                                            <option value="0">Chọn giáo viên</option>
                                            @foreach ($data_giao_vien as $giao_vien)
                                            <option @if ($item->id == $giao_vien->lop_id && $giao_vien->type == 1)
                                                selected
                                                @endif
                                                value="{{$giao_vien->id}}" >{{$giao_vien->ma_gv}} - {{$giao_vien->ten}}
                                            </option>


                                            @endforeach
                                        </select>
                                    </td>
                                    <td  class="chon_giao_vien" id_gv={{$item->id}}>
                                        <select lop_phu_id='{{$item->id}}'
                                             class="form-control giao_vien_phu giao_vien{{$item->id}} "
                                             @if (Session::has('id_nam_hoc'))
                                             {{ Session::get('id_nam_hoc') != $id_nam_hien_tai ?'disabled':''}}
                                         @endif
                                            name="giao_vien_phu[]" multiple="multiple">
                                            <option value="">Chọn giáo viên</option>
                                            @foreach ($data_giao_vien as $giao_vien)

                                            <option @if ($item->id == $giao_vien->lop_id && $giao_vien->type == 2)
                                                selected
                                                @endif
                                                value="{{$giao_vien->id}}" >{{$giao_vien->ma_gv}} - {{$giao_vien->ten}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                    <!--end::Section-->
                    <div class="d-flex justify-content-end">
                        @if (Session::has('id_nam_hoc'))
                        @if (Session::get('id_nam_hoc') == $id_nam_hien_tai )
                        <button type="button" onclick="phanLop()" class="btn btn-success mr-4">Lưu</button>
                        @endif
                        
                    @else
                    <button type="button" onclick="phanLop()" class="btn btn-success mr-4">Lưu</button>

                    @endif
                        <button type="button" class="btn btn-secondary">Hủy</button>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    
    $(document).ready(function(){
        $('.giao_vien_chinh').select2();
        $('#giao_vien86').select2()
        $('.giao_vien_phu').select2();
    });
    let data_giao_vien = JSON.parse($('#data_giao_vien').val())

    const updateLop = (element) =>{
        // $('.giao_vien_chinh').select2('destroy');

        var lop_id = Number($(element).attr('lop_cn_id'))
        var remove_gv_cn = data_giao_vien.filter(data_giao_vien => data_giao_vien.lop_id == lop_id).filter(data_giao_vien => data_giao_vien.type == 1)
        console.log(remove_gv_cn)
         if(remove_gv_cn.length>0){
            //  console.log(1)
            remove_gv_cn[0].lop_id=0
            remove_gv_cn[0].type=0
         }
        
        var id_gv_moi = Number($(element).val())
        if(id_gv_moi !=0){
            var add_gv_cn = data_giao_vien
        // .filter(data_giao_vien => data_giao_vien.lop_id == 0)
        .filter(data_giao_vien => data_giao_vien.id == id_gv_moi)
        add_gv_cn[0].lop_id=lop_id
        add_gv_cn[0].type=1
        
        }
        console.log(data_giao_vien)
       
    };
    jQuery('.giao_vien_phu').on("select2:unselect", function(e){
        // var lop_id = $(e.currentTarget).attr('lop_phu_id')
        var id_gv = e.params.data.id;
        const result = data_giao_vien.filter(data_giao_vien => data_giao_vien.id == id_gv);

        result[0].lop_id=0
        result[0].type=0

        console.log(data_giao_vien)
    });
    jQuery('.giao_vien_phu').on("select2:selecting", function(e) { 
        var lop_id = Number($(e.currentTarget).attr('lop_phu_id'))
        var id_gv = e.params.args.data.id;
        const result = data_giao_vien.filter(data_giao_vien => data_giao_vien.id == id_gv);
        result[0].lop_id=lop_id
        result[0].type=2
    });

    $('.chon_giao_vien').click(function(element) {
        var giao_vien_element = '.giao_vien'+$(element.currentTarget).attr('id_gv')
        var giao_vien_type = $(element.currentTarget).find(`${giao_vien_element}`)
        console.log(giao_vien_type);
        // debugger
        giao_vien_type.select2('destroy')
        var list_giao_vien_phu = $(element.currentTarget).find("option")
        for (const key in list_giao_vien_phu) {
            if (list_giao_vien_phu.hasOwnProperty(key)) {
                if(Number(key)){
                    var element = list_giao_vien_phu[key];
                    var id_gv = Number($(element).val());
                }
                const result = data_giao_vien.filter(data_giao_vien => data_giao_vien.id == id_gv);
                if(result.length>0){
                    if(result[0].lop_id != 0){  
                        $(element).attr('disabled',true)
                    }else{ 
                        $(element).removeAttr('disabled')
                    }
                
                }
            }
          

        }
      
        giao_vien_type.select2()
        giao_vien_type.select2('open') 
    })

    $('.giao_vien_chinh').on("select2:select", function(e) { 
        var list_giao_vien_phu = $(e.currentTarget).find("option")
        console.log(list_giao_vien_phu.length)
        for (const key in list_giao_vien_phu) {
            if (list_giao_vien_phu.hasOwnProperty(key)) {
                if(Number(key)){
                    var element = list_giao_vien_phu[key];
                    var id_gv = Number($(element).val());
                }
                const result = data_giao_vien.filter(data_giao_vien => data_giao_vien.id == id_gv);
                // console.log(result)
                if(result.length>0){
                    if(result[0].lop_id != 0){
                        $(element).attr('disabled',true)
                    }else{
                        $(element).removeAttr('disabled')
                    }
                
                }
            }
          

        }
    });
console.log(data_giao_vien)
const url_phan_lop = "{{route('store-phan-lop-cho-giao-vien')}}"
console.log(url_phan_lop)
const phanLop = () =>{
    $('#preload').show()
axios.post(url_phan_lop,data_giao_vien)
  .then(function (response) {
    $('#preload').hide()
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Phân lớp thành công!',
        showConfirmButton: false,
        timer: 1500
    }).then(
        )
    console.log(response);
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .then(function () {
    // always executed
  });
};
</script>
@endsection