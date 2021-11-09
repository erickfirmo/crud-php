<?php

namespace App\Controllers;

use App\Models\Customer;
use Core\Session;
use Core\Request;

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
    public function store(Request $request)
    {               
        // validação de campos
        $validated = $request->validate([
            'name' => 'required|max:40',
            'email' => 'required|max:40',
        ]);

        // pega campos enviados
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        // unique
        $customers = (new Customer())->select()
                                    ->where('email', '=', $email)
                                    ->get();

        // verifica se email já está em uso
        if(count($customers->items)) {
            // seta mensagem de erro para e-mail já existente
            $this->error('email', $request->getMessage('email.unique'));
            $validated = false;
        }

        // validação de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && $email != null)
        {
            // seta mensagem de erro para e-mail
            $this->error('email', $request->getMessage('email.invalid'));
            $validated = false;
        }

        // validação de telefone
        if (!$this->phoneValidate($phone) && $phone != null) {
            // seta mensagem de erro para telefone
            $this->error('phone', $request->getMessage('phone.invalid'));
            $validated = false;
        }

        // verifica se todos os campos são válidos
        if(!$validated) {
            // redireciona para a página de cadastro
            return $this->back();
        }

        // trata número de telefone
        $phone = $this->clearPhone($phone);

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
    public function show(Request $request, $id)
    {
        $customer = (new Customer())->findById($id);

        return view('customers.show', ['customer' => $customer]);
    }

    // atualiza informações da pessoa
    public function update(Request $request, int $id)
    {
        // validação de campos
        $validated = $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|max:60',
        ]);

        // pega campos enviados
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        // unique
        // verifica se email já está em uso
        $customers = (new Customer())->select()
                                    ->where('id', '!=', $id)
                                    ->where('email', '=', $email)
                                    ->get();

        // verifica se email já está em uso
        if(count($customers->items)) {
            // seta mensagem de erro para e-mail já existente
            $this->error('email', $request->getMessage('email.unique'));
            $validated = false;
        }

        // validação de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && $email != null){
            // seta mensagem de erro e-mail
            $this->error('email', $request->getMessage('email.email'));
            $validated = false;
        }

        // validação de telefone
        if (!$this->phoneValidate($phone) && $phone != null) {
            // seta mensagem de erro para telefone
            $this->error('phone', $request->getMessage('phone.phone'));
            $validated = false;
        }

        // verifica se todos os campos são válidos
        if(!$validated) {
            // redireciona para a página de edição
            return $this->back();
        }

        // trata número de telefone
        $phone = $this->clearPhone($phone);

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

    
    // trata número de telefone
    public function clearPhone($phone)
    {
        return preg_replace("/[^A-Za-z0-9]/", "", $phone);
    }

    // valida telefone
    public function phoneValidate($phone)
    {
        // verifica se telefone é valido nos formatos (00) 00000-0000 ou (00) 0000-0000
        $regex = '/\(\d{2,}\) \d{4,}\-\d{4}/';

        if (preg_match($regex, $phone) == false)
        {
            // o número não foi validado
            return false;
        } else {
            // telefone válido
            return true;
        }        
    }
}