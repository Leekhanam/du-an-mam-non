<script src="{!! asset('js/all.js') !!}" type="text/javascript"></script>
<script>
    $('body').show();
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 2000);
    $(document).ready(function(){

        let url_change_session_nam_hoc = "{{route('thay-doi-session-nam-hoc')}}"
        $('#chon_nam_hoc_all').change(function() {
            let id_nam_hoc = $('#chon_nam_hoc_all').val()

            axios.post(url_change_session_nam_hoc,{
                id_nam_hoc : id_nam_hoc
            })
                .then(function (response) {
                    location.reload();
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
        })
        
    });

    $( function() {
					$('#ul-home').draggable({ opacity: 0.7, helper: "clone" });
					$( "#sortable" ).sortable({
					revert: true
					});
			});
</script>
<script src="{{ asset('sweetalert2/sweetalert2@10.js')}}"></script>
