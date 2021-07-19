<form action="<?php echo $url; ?>" method="post" id="customForm">
    <?php method_field($method ?? null); ?>
    
    <div class="form-group row">
        <div class="col-sm-2">
            <label class="col-form-label" for="inputName">
                Nome
            </label>
        </div>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="inputName" value="<?php echo isset($model) ? $model->name : old('name'); ?>" placeholder="Nome Completo" <?php echo isset($disabled) ? 'disabled' : ''; ?>>
            
            <?php 
                if (error_field('name')) { 
                    foreach(error_field('name') as $message) { ?>
                <div class="col-form-label form-txt-danger"><?php echo $message; ?></div>
            <?php   } 
                }
            ?>

        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-2">
            <label class="col-form-label" for="inputEmail">
                E-mail
            </label>
        </div>
        <div class="col-sm-10">
            <input type="text" name="email" class="form-control" id="inputEmail" value="<?php echo isset($model) ? $model->email : old('email'); ?>" placeholder="Exemplo: seunome@gmail.com" <?php echo isset($disabled) ? 'disabled' : ''; ?>>
            <?php 
                if (error_field('email')) { 
                    foreach(error_field('email') as $message) { ?>
                <div class="col-form-label form-txt-danger"><?php echo $message; ?></div>
            <?php   } 
                }
            ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-2">
            <label class="col-form-label" for="inputPhone">
                Telefone
            </label>
        </div>
        <div class="col-sm-10">
            <input type="text" name="phone" class="form-control phone-mask" id="inputPhone" value="<?php echo isset($model) ? $model->phone : old('phone'); ?>" placeholder="(00) 00000-0000" <?php echo isset($disabled) ? 'disabled' : ''; ?>>
            <?php 
                if (error_field('phone')) { 
                    foreach(error_field('phone') as $message) { ?>
                <div class="col-form-label form-txt-danger"><?php echo $message; ?></div>
            <?php   } 
                }
            ?>
        </div>
    </div>
</form>

<a href="<?php url('pessoas'); ?>">
    <button class="btn btn-light waves-effect waves-light m-r-20" data-toggle="tooltip" data-placement="right" title="Voltar" data-original-title="Voltar" onclick="">Voltar</button>
</a>

<?php if(!isset($disabled)) { ?>
<button type="submit" class="btn btn-primary waves-effect waves-light m-r-20" data-toggle="tooltip" data-placement="right" title="Salvar" data-original-title="Salvar" onclick="document.getElementById('customForm').submit();">Salvar</button>    
<?php } ?>