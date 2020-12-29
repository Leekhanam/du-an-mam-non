@extends('layouts.main')
@section('title', "Quản tài khoản")
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
                    <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-user"></i>Giáo
                        viên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('account.ds-hs') }}"><i class="la la-users"></i>Học
                        sinh</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('quan-ly-giao-vien-create') }}" class="btn btn-success btn-sm m-btn m-btn m-btn--icon m-btn--pill" data-toggle="m-tooltip"  data-original-title="Tạo mới">
                        <span>
                            <i class="la la-plus-circle"></i>
                            <span>Tạo mới</span>
                        </span>
                    </a>
                </li>
            </ul>
            
            
            <div class="tab-content">
                <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                    <div class="m-portlet">
                        <div class="m-portlet__body table-responsive">
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
                                        function displayAvatar($avatarImg, $name)
                                        {
                                        if($avatarImg != null) {
                                            return asset('storage/' . $avatarImg);
                                        }
                                            // return asset('images/avatar-default.png');
                                            return 'https://ui-avatars.com/api/?name=' . $name . '&background=random';
                                        }
                                    @endphp
                                    @forelse ($data as $item)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        {{-- <td><img src='{{  $item->avatar ? asset('upload/' . $item->avatar) : 'https://ui-avatars.com/api/?name=' . $item->name . '&background=random '}}' width="50" class="img-thumbnail"></td> --}}
                                        <td><img src='{{ $item->avatar }}' width="50" class="img-thumbnail" data-name="{{ $item->name }}" onerror="onLoadAvatar(this)"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @if ($item->id != Auth::id())
                                            <form class="m-form">
            
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox" onclick="editstatus(this)" user-id="{{ $item->id }}"
                                                         @if ($item->active == 1) checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
            
                                            </form>
                                            @endif
                                        </td>
                                        <td><a href="{{route('edit-giao-vien', ['id' =>$item->id])}}">
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

    <!--end::Portlet-->


</div>
@endsection
@section('script')
<script>
    var currentUrl = '{{ route($route_name) }}';
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

    function editstatus(element) {
        console.log('Đang thay đổi status');
        // console.log($id);
        let userId = $(element).attr('user-id')
        axios.post("{{route('account.editStatus') }}", {
                id: userId
            })
            .then(function (response) {
                console.log('Thay đổi status THÀNH CÔNG');
            })
            .catch(function (error) {
                // console.log(error);
            });
    }
</script>
@endsection
