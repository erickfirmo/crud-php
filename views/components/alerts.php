<?php if(session('alert-success')) { ?>
    <div class="alert alert-success in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
        <?php echo session('alert-success'); ?>
    </div>
<?php }

if(session('alert-error')) { ?>
    <div class="alert alert-danger in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h4><i class="icon fa fa-check"></i> Erro!</h4>
        <?php echo session('alert-error'); ?>
    </div>
<?php } ?>