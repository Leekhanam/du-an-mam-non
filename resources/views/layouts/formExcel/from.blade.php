<form action="{{route('export-bieu-mau-nhap-hoc-sinh')}}" method="post">
    @csrf
    <div class="modal fade" id="exportBieuMauModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hãy chọn Lớp</h5>
                    <button type="button" id="closeFileBieuMau" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="group">
                        <label for="">Chọn khối</label>
                            <select name="id_khoi" id="id_khoi" class="form-control">
                            @foreach($khoi as $k)
                                <option value="{{$k->id}}">{{$k->ten_khoi}}</option>
                            @endforeach
                            </select>
                    </div>
                    <div class="group">
                        <label for="">Chọn lớp</label>
                          <select name="id_lop" id="id_lop" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit"  onclick="closeModal()" class="btn btn-primary">Tải</a>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="{{route('error-import-bieu-mau-nhap-hoc-sinh')}}" id="form_import_file" method="post"
    enctype="multipart/form-data">
    @csrf
    <div class="modal fade " id="moDalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import file</h5>
                    <button type="button"
                     {{-- id="closeImportFile" --}}
                     class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                            <label for="">Ngày nhập học </label>
                            <div class='input-group date datepicker' name="datepicker" >
                             <input type="text" autocomplete="off" class="form-control" name="ngay_vao_truong" id="ngay_vao_truong"></p>
                                <!-- @error('dateFrom')
                                      <div class="text-danger">{{$message}}</div>
                                @enderror -->
                            </div>
                        </div>

                    <div class="form-group">
                    <label for="">Chọn file danh sách học sinh</label>
                        <input  class="form-control" type="file" id="file_import_id" name="file_import">
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="pt-1" style="color:red;margin-right: 119px" id="echoLoi">
                    </p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="submitTai">Tải</a>
                        <button type="submit" hidden class="btn btn-primary" id="submitTaiok">Tải ok</a>
                </div>
            </div>
        </div>
    </div>
</form>

   