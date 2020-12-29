@extends('layouts.main')
@section('title', 'Thông báo')
@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
          <div class="m-portlet m-portlet--mobile m-portlet--sortable">
                <div class="m-portlet__head ui-sortable-handle">
              
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                        <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title" style="text-transform: uppercase;">
                                        {{$data->title}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> 
                
            <div class="m-portlet__body">
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
              
              <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                      <div class="row">
      <div class="col-12">
          <div class="kt-portlet kt-portlet--mobile">
              <div class="kt-portlet__body">
                  <p align="center">
                     <strong  style="text-transform: uppercase;" >{{$data->title}}</strong></p>
                <p align="center">
                       &nbsp;</p>
                       {!! $data->content !!}
                <p>
                
                <p>
                &nbsp;</p>
                <p>
                &nbsp;</p>

                  <em>
                      Người đăng: {{$data->Auth->name}} - {{$data->Auth->username}} <br>
                      Thời gian: {{ date('d/m/Y - h:i:s A', strtotime($data->created_at))}}<br>
                      Cập nhật lần cuối bởi {{$data->Auth->name}} - {{$data->Auth->username}} vào lúc {{ date('h:i:s A', strtotime($data->updated_at))}} ngày {{ date('d/m/Y', strtotime($data->updated_at))}}
                  </em>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div> 
      </div>
    </div>
 </div>
 </div>             
 </div>




                 
@endsection
