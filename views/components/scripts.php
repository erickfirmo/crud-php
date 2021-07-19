<!-- Required Jquery -->
<script type="text/javascript" src="<?php asset('assets/js/jquery/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php asset('assets/js/jquery-ui/jquery-ui.min.js'); ?>"></script>
<script type="text/javascript" src="<?php asset('assets/js/popper.js/popper.min.js'); ?>"></script>
<script type="text/javascript" src="<?php asset('assets/js/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php asset('assets/pages/widget/excanvas.js'); ?>"></script>
<!-- waves js -->
<script src="<?php asset('assets/pages/waves/js/waves.min.js'); ?>"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?php asset('assets/js/jquery-slimscroll/jquery.slimscroll.js'); ?>"></script>
<!-- modernizr js -->
<script type="text/javascript" src="<?php asset('assets/js/modernizr/modernizr.js'); ?>"></script>
<!-- slimscroll js -->
<script type="text/javascript" src="<?php asset('assets/js/SmoothScroll.js'); ?>"></script>
<script src="<?php asset('assets/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<!-- Chart js -->
<script type="text/javascript" src="<?php asset('assets/js/chart.js/Chart.js'); ?>"></script>
<!-- amchart js -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="<?php asset('assets/pages/widget/amchart/gauge.js'); ?>"></script>
<script src="<?php asset('assets/pages/widget/amchart/serial.js'); ?>"></script>
<script src="<?php asset('assets/pages/widget/amchart/light.js'); ?>"></script>
<script src="<?php asset('assets/pages/widget/amchart/pie.min.js'); ?>"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<!-- menu js -->
<script src="<?php asset('assets/js/pcoded.min.js'); ?>"></script>
<script src="<?php asset('assets/js/vertical-layout.min.js'); ?>"></script>
<!-- custom js -->
<script type="text/javascript" src="<?php asset('assets/pages/dashboard/custom-dashboard.js'); ?>"></script>
<!-- SweetAlert -->
<script src="<?php asset('node_modules/sweetalert2/dist/sweetalert2.js'); ?>"></script>
<!-- Jquery Mask Plugin -->
<script src="<?php asset('node_modules/jquery-mask-plugin/dist/jquery.mask.js'); ?>"></script>

<script type="text/javascript" src="<?php asset('assets/js/script.js'); ?>"></script>

<form id="hiddenForm" action="" style="display:none;" method="POST">
    <input type="hidden" name="_method" value="">
</form>

<script>
    $('a.method-post').on('click', function(e) {
        e.preventDefault();

        let method = $(this).data('method');
        let url = $(this).attr('href');

        if(method == 'POST') {
            
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Tem certeza que deseja excluir esta pessoa?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {

                if (result.isConfirmed) {
                    $('#hiddenForm').find('input[name="_method"]').val('delete');
                    $('#hiddenForm').attr('action', url);
                    $('#hiddenForm').submit();
                }
            });

            
        }
    });
    
</script>
