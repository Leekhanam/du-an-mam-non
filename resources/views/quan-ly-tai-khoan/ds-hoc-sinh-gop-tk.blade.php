@extends('layouts.main')
@section('title', "Danh sách tài khoản gộp")
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
@section('content')
<div class="m-content">
		<div id="preload" class="preload-container text-center" style="display: none">
			<img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
          </div>
          
    <div class="m-portlet">
        <div class="m-portlet__body">
        <h3 class="m-portlet__head-text">
                                Danh sách học sinh dùng chung tài khoản
                            </h3>
            <div class="tab-content">
                <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                    <div class="m-portlet">
                        <div class="m-portlet__body table-responsive">
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
                                        <td><img src='{{ $item->avatar }}' width="50" class="img-thumbnail" data-name="{{ $item->ten }}" onerror="onLoadAvatar(this)"></td>
                                        <td>{{ $item->ten }}</td>
                                        <td>{{ $item->ma_hoc_sinh }}</td>
                                        <td>{{ $item->email_dang_ky }}</td>
                                        <td>
                                            @if ($item->id != Auth::id())
                                            <form class="m-form">
            
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox"  onclick="editstatus(this)" user-id="{{ $item->id }}"
                                                         @if ($item->type == 1) checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
            
                                            </form>
                                            @endif
                                        </td>
                                        <td><a href="{{route('edit-hoc-sinh', ['id' =>$item->id])}}" class="flaticon-edit"></a></td>
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
                       <i><a href="{{route('account.ds-hs')}}" class="fa fa-reply-all"> Quay lại</a></i>
                    </div>
                </div>
            </div>
        </div>
    </div>





      
      <!-- Modal -->
    <!--end::Portlet-->
</div>
@endsection
@section('script')
<script>




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
