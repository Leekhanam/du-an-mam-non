$( function() {
    $( "#ngay_vao_truong" ).datepicker();
  } );

$("#file_import_id").change(function() {
    var fileExtension = ['xlsx','xls'];
    if($("#file_import_id")[0].files.length === 0){
        $('#echoLoi').text('Hãy nhập file excel');
    }else if($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        $message = "Hãy nhập file excel : "+fileExtension.join(', ');
        $('#echoLoi').text($message);
        return false;
    }else{
        $('#echoLoi').text('');
     }
 });

 $("#submitTai").click(function(event){
    var fileExtension = ['xlsx', 'xls'];
    if($("#file_import_id")[0].files.length === 0){
           $('#echoLoi').text('Hãy nhập file excel');
            console.log('không có file');
    }else if($.inArray($('#file_import_id').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            console.log('File không đúng định dạng');
            $('#echoLoi').text('File không đúng định dạng');
    }else{
        $('#echoLoi').text('');
        $('#moDalImport').modal('hide');
        $('.loading').css('display','block');
        var formData = new FormData();
        var fileExcel = document.querySelector('#file_import_id');
        formData.append("file", fileExcel.files[0]);
        axios.post(routeImport, formData,{
            headers: {
                    'Content-Type': 'multipart/form-data',
                }
            }).then(function (response) {
                console.log(response)
                        if(response.data == 'ok'){
                            $('.loading').css('display','none');
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Cập nhập thành công',
                                    showConfirmButton: false,
                                    timer: 1700
                                })
                            window.location.reload();
                            console.log('Đã insert vào database');
                        }else if(response.data == 'exportError'){
                            $('.loading').css('display','none');
                            $('#submitTaiok').trigger('click');
                            $('#form_import_file')[0].reset();
                        }else{
                            $('.loading').css('display','none');
                            Swal.fire({
                                title: response.data.messageError,
                                icon: 'warning',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Xác nhận'
                                }).then((result) => {
                                if (result.value) {
                                    window.location.reload();
                                }else{
                                    window.location.reload();
                                }
                                })
                        }
                }).catch(function (error) {
                        console.log(error);
                        $('.loading').css('display','none');
                        Swal.fire({
                            title: 'Lỗi về file muốn nhập !',
                            // text: "You won't be able to revert this!",
                            icon: 'warning',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Xác nhận'
                            }).then((result) => {
                            if (result.value) {
                                window.location.reload();
                            }else{
                                window.location.reload();
                            }
                            })
                });
            }
    });