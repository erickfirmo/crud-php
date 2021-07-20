<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!count($customers->items)) { ?>
        <tr>
            <td class="align-center">Nenhum registro encontrado</td>
        </tr>
    <?php } ?>
    <?php foreach ($customers->items as $customer) { ?>
        <tr>
            <th scope="row"><?php echo $customer->id; ?></th>
            <td><?php echo $customer->name; ?></td>
            <td><?php echo $customer->email; ?></td>
            <td><?php echo $customer->getPhone(); ?></td>
            <td>
                <div>
                    <a href="<?php url('pessoas/'.$customer->id); ?>">
                        <button class="btn waves-effect waves-light btn-dark btn-icon">
                            <i class="ti-eye m-0"></i>
                        </button>
                    </a>
                    <a href="<?php url('pessoas/editar/'.$customer->id); ?>">
                        <button class="btn waves-effect waves-light btn-primary btn-icon">
                            <i class="ti-pencil m-0"></i>
                        </button>
                    </a>
                    <a class="method-post" href="<?php url('pessoas/destroy/'.$customer->id); ?>" data-method="POST" data-confirm="Tem certeza que deseja excluir esta pessoa?">
                        <button class="btn waves-effect waves-light btn-danger btn-icon destroy-button">
                            <i class="ti-trash m-0"></i>
                        </button>
                    </a>
                </div>
            </td>
        </tr>
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </tfoot>
</table>

<!-- paginação -->
<?php partial('components/pagination', [ 'pages' => $customers->links ]); ?>

