<?php

namespace App\Controllers;

use App\Models\Customer;
use Core\Session;

class CustomerController extends Controller {

    // página de listagem todas as pessoas
    public function index()
    {
        // busca pessoas no banco de dados com paginação de 10 itens em ordem decrescente
        $customers = (new Customer())->select()
                                    ->orderByDesc()
                                    ->paginate(10);

        return view('customers.index', ['customers' => $customers]);
    }

    // página de cadastro de pessoas
    public function create()
    {
        return view('customers.create');
    }

    // cadastra pessoa
    public function store()
    {                
        // validação de campos
        $validated = request()->validate([
            'name' => 'required|max:40',
            'email' => 'required|max:30',
        ]);

        // pega campos enviados
        $name = request()->input('name');
        $email = request()->input('email');
        $phone = request()->input('phone');

        // validação de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            // seta mensagem de erro para e-mail
            $this->error('email', request()->getMessage('email.invalid'));
            // redireciona para a página de cadastro
            return $this->redirect('/pessoas/cadastrar');
        }

        // validação de telefone
        if (!$this->phoneValidate($phone)) {
            // seta mensagem de erro para telefone
            $this->error('phone', request()->getMessage('phone.invalid'));
            // redireciona para a página de cadastro
            return $this->redirect('/pessoas/cadastrar');
        }

        // verifica se todos os campos são válidos
        if(!$validated) {
            // redireciona para a página de cadastro
            return $this->redirect()->back();
        }

        // cadastra pessoa no banco de dados
        $model = (new Customer())->insert([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        // verifica se pessoa foi cadastrada
        if($model) {
            $this->success('Pessoa cadastrada com sucesso.');
        }

        return $this->redirect('/pessoas/editar/'.$model->id);
    }

    // página de edição de pessoa
    public function edit(int $id)
    {
        $customer = (new Customer())->findById($id);

        return view('customers.edit', ['customer' => $customer]);
    }

    // página de exibição de informações da pessoa
    public function show(int $id)
    {
        $customer = (new Customer())->findById($id);

        return view('customers.show', ['customer' => $customer]);
    }

    // atualiza informações da pessoa
    public function update(int $id)
    {
        // validação de campos
        $validated = request()->validate([
            'name' => 'required|max:40',
            'email' => 'required|max:30',
        ]);

        // pega campos enviados
        $name = request()->input('name');
        $email = request()->input('email');
        $phone = request()->input('phone');

        // validação de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            // seta mensagem de erro e-mail
            $this->error('email', request()->getMessage('email.email'));
            // redireciona para a página de edição
            return $this->redirect('/pessoas/editar/'.$id);
        }

        // validação de telefone
        if (!$this->phoneValidate($phone)) {
            // seta mensagem de erro para telefone
            $this->error('phone', request()->getMessage('phone.phone'));
            // redireciona para a página de edição
            return $this->redirect('/pessoas/editar/'.$id);
        }

        // verifica se todos os campos são válidos
        if(!$validated) {
            // redireciona para a página de edição
            return $this->redirect()->back();
        }

        // atualiza registro da pessoa no bando de dados
        (new Customer())->update($id, [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        // seta mensagem de sucesso
        $this->success('Pessoa atualizada com sucesso.');
        // redireciona para página de edição de pessoa
        return $this->redirect('/pessoas/editar/'.$id);
    }

    // exclui pessoa
    public function destroy(int $id)
    {
        // exclui registro da pessoa no banco de dados
        (new Customer())->delete($id);
        // seta mensagem de sucesso
        $this->success('Pessoa removida com sucesso.');
        // redireciona para a página de listagem de pessoas
        return $this->redirect('/pessoas');
    }

    // valida telefone
    public function phoneValidate($phone)
    {
        // verifica se telefone é valido nos formatos (00) 00000-0000 ou (00) 0000-0000
        $regex = '/\(\d{2,}\) \d{4,}\-\d{4}/';

        if (preg_match($regex, $phone) == false) {
            // o número não foi validado
            return false;
        } else {
            // telefone válido
            return true;
        }        
    }
}