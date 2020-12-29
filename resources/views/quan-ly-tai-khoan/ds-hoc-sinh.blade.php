@extends('layouts.main')
@section('title', "Quản lí tài khoản")
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />

@section('style')
<style>
    @media (min-width: 768px) { 
        .box-sreach{
            height: 300px;
            overflow: hidden;
        }
    }

    @media (min-width: 992px) {
        .box-sreach{
            height: 270px;
            overflow: hidden;
        }
    }
</style>
@endsection
@section('content')
<div class="m-content">

       		
		<div id="preload" class="preload-container text-center" style="display: none">
			<img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
          </div>


    <div class="row">
        <div class="col-xl-12">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab box-sreach">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Bộ lọc
                            </h3>
                        </div>
                    </div>
                </div>
                <form action="" method="GET" class="m-form">
                    <input type="hidden" name="page_size" value="{{$params['page_size']}}">
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group m-form__group row ">
                                        <label class="col-lg-2 col-form-label">Trạng thái:</label>
                                        <div class="col-lg-8">
                                            <select name="active" id="active" class="form-control ">
                                                <option value="" selected>All</option>
                                                <option value="1" @if($params['active']==1) selected @endif>Kích hoạt</option>
                                                <option value="2" @if($params['active']==2) selected @endif>Khóa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">Từ khóa:</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control m-input" @if(isset($params['keyword']))
                                                value="{{ $params['keyword'] }}" @endif
                                                placeholder="Từ khóa tìm kiếm..." name="keyword">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!--end::Portlet-->
        </div>
    </div>
    <div class="m-portlet">
        
        <div class="m-portlet__body">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item ">
                    <a class="nav-link"  href="{{ route('account.index') }}"><i class="la la-user-secret"></i>Quản
                        trị</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('account.ds-gv') }}"><i class="la la-user"></i>Giáo
                        viên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-users"></i>Học
                        sinh</a>
                </li>
       
            </ul>
            
            
            <div class="tab-content">
                <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                    <div class="m-portlet">
                        <div class="m-portlet__body table-responsive">

                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">Gộp tài khoản</button>

                            <div class="col-12 form-group m-form__group d-flex justify-content-end">
                                <label class="col-lg-2 col-form-label">Kích thước:</label>
                                <div class="col-lg-2">
                                    <select class="form-control" id="page-size">
                                        @foreach(config('common.paginate_size.list') as $size)
                                        <option @if($params['page_size']==$size) selected @endif value="{{$size}}">{{$size}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table class="table m-table m-table--head-bg-success">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Avatar</th>
                                        <th>Họ và Tên</th>
                                        <th>Tên đăng nhập</th>
                                        <th>Email</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <script>
                                        function onLoadAvatar(e){
                                            let name = e.getAttribute('data-name');
                                            e.setAttribute('src', "https://ui-avatars.com/api/?name=" + name + "&background=random");
                                        }
                                    </script>
                                    @php
                                        use Illuminate\Support\Facades\Auth;
                                        $i = 1;
                                        function displayAvatar($avatarImg)
                                        {
                                        if($avatarImg != null) {
                                            return asset('storage/' . $avatarImg);
                                        }
                                            return asset('images/avatar-default.png');
                                        }
                                    @endphp
                                    @forelse ($data as $item)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        {{-- <td><img src='{{ displayAvatar($item->avatar) }}' width="50" class="img-thumbnail"></td> --}}
                                        <td><img src='{{ $item->avatar }}' width="50" class="img-thumbnail" data-name="{{ $item->name }}" onerror="onLoadAvatar(this)"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @if ($item->id != Auth::id())
                                            <form class="m-form">
            
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox"  onclick="editstatus(this)" user-id="{{ $item->id }}"
                                                         @if ($item->active == 1) checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
            
                                            </form>
                                            @endif
                                        </td>
                                        <td><a href="{{route('edit-tk-hoc-sinh', ['id' =>$item->id])}}">
                                            <i class="la la-pencil"></i>
                                        </a></td>
                                    </tr>
                                    @empty
                                    <td>
                                    <td colspan="6">
                                        <center>Not data</center>
                                    </td>
                                    </td>

                                    @endforelse


                                </tbody>
                                {{-- {{ $data->links() }} --}}
                            </table>
                        </div>
                    </div>
                    <div class="m-portlet__foot d-flex justify-content-end">
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>





      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Gộp tài khoản học sinh</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <label for="">Chọn các tài khoản muốn gộp:</label>
                <select class="select2" name="account[]" onchange="chooseOptionAccount()" id="array_account" multiple="multiple">
                    @foreach ($all_account as $item)
                       <option value="{{$item->id}}" >{{$item->username}} - {{$item->name}} </option>
                    @endforeach
                    
                 </select>
            </div>
                  <div class="ml-4 mb-5">
                        <p>Chọn tài khoản : </p>
                        <p style="font-size:12px !important;">( Ghi chú: Tài khoản chính để phụ huynh dùng thay cho các toàn khoản đã gộp ) </p>
                        <div class="ml-3" id="show_select">

                        </div>
                    </div>
   

            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="submitGop()">Gộp</button>
            </div>
          </div>
        </div>
      </div>

    <!--end::Portlet-->
</div>
@endsection
@section('script')
<script>

$('.select2').select2();
$('span.select2').css('width', '100%');

    var currentUrl = '{{ route($route_name) }}';
    var url_accountGopTk = "{{ route('account-gop-tai-khoan') }}";
    $(document).ready(function () {
        $('#page-size').change(function () {
            var active = $('[name="active"]').val();
            var keyword = $('[name="keyword"]').val();
            var page_size = $(this).val();
            var reloadUrl =
                `${currentUrl}?active=${active}&keyword=${keyword}&page_size=${page_size}`;
              window.location.href = reloadUrl;
        });
    });


function chooseOptionAccount (){
        var value = $("#array_account").select2('data');
        var html = ``;
        for (var i = 0; i < value.length; i++) {
            html += `
            <div class="form-check">
             <label class="form-check-label">
                    <input type="radio" id="id_tk_chinh" class="form-check-input" value=${value[i].id} name="optradio">${value[i].text}
                </label>
            </div>
                `;
        }
      $('#show_select').html(html);
}



    function submitGop(){
        $('#preload').css('display','block');
        axios.post(url_accountGopTk, {
              id_tk_chinh: $('#id_tk_chinh').val(),
              array_account:  $("#array_account").val(),
            })
            .then(function (response) {
                $('#preload').css('display','none');
                console.log('Thay đổi status THÀNH CÔNG');
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Gộp tài khoản thành công',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                       location.reload();
                })
            })
            .catch(function (error) {
                $('#preload').css('display','none');
                console.log(error);
            });
    }


    function editstatus(element) {
        console.log('Đang thay đổi status');
        // console.log($id);
        let userId = $(element).attr('user-id');
        // console.log(element);
        Swal.fire({
                title: 'Bạn muốn thay đổi trạng thái tài khoản này ?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                ButtonColor: '#d33',
                confirmButtonText: 'Thay đổi',
                }).then((result) => {
                    if (result.value) {
                            axios.post("{{route('account.editStatus') }}", {
                                    id: userId
                                })
                                .then(function (response) {
                                    Swal.fire({
                                                position: 'center',
                                                icon: 'success',
                                                title: 'Thay đổi trạng thái thành công',
                                                showConfirmButton: false,
                                                timer: 1500
                                            })
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                    }else{
                        location.reload();
                    }
                })
                }
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
