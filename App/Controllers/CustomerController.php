<?php

namespace App\Controllers;

use App\Models\Customer;
use Core\Session;

class CustomerController extends Controller {

    public function home()
    {
        return view('home');
    }

    public function index()
    {
        $customers = (new Customer())->select()
                                    ->orderByDesc()
                                    ->paginate(10);
                                    
        return view('customers.index', ['customers' => $customers]);
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store()
    {
        // validação de campos
        $validated = $this->request()->validate([
            'name' => 'required|max:40',
            'email' => 'required|max:30',
        ]);

        $name = $this->request()->input('name');
        $email = $this->request()->input('email');
        $phone = $this->request()->input('phone');

        // validação de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            // seta mensagem de erro e-mail
            $this->error('email', 'Este e-mail não é válido.');
            // redireciona para a página de cadastro
            return $this->redirect('/pessoas/cadastrar');
        }

        // validação de telefone
        if (!$this->phoneValidate($phone)) {
            // seta mensagem de erro para telefone
            $this->error('phone', 'Telefone inválido.');
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

    public function edit(int $id)
    {
        $customer = (new Customer())->findById($id);

        return view('customers.edit', ['customer' => $customer]);
    }

    public function show(int $id)
    {
        $customer = (new Customer())->findById($id);

        return view('customers.show', ['customer' => $customer]);
    }

    public function update(int $id)
    {
        // validação de campos
        $validated = $this->request()->validate([
            'name' => 'required|max:40',
            'email' => 'required|max:30',
        ]);

        $name = $this->request()->input('name');
        $email = $this->request()->input('email');
        $phone = $this->request()->input('phone');

        // validação de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            // seta mensagem de erro e-mail
            $this->error('email', 'Este e-mail não é válido.');
            // redireciona para a página de edição
            return $this->redirect('/pessoas/editar/'.$id);
        }

        // validação de telefone
        if (!$this->phoneValidate($phone)) {
            // seta mensagem de erro para telefone
            $this->error('phone', 'Telefone inválido.');
            // redireciona para a página de edição
            return $this->redirect('/pessoas/editar/'.$id);
        }

        // verifica se todos os campos são válidos
        if(!$validated) {
            // redireciona para a página de edição
            return $this->redirect()->back();
        }

        (new Customer())->update($id, [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        $this->success('Pessoa atualizada com sucesso.');

        return $this->redirect('/pessoas/editar/'.$id);
    }

    public function destroy(int $id)
    {
        (new Customer())->delete($id);

        $this->success('Pessoa removida com sucesso.');

        return $this->redirect('/pessoas');
    }

    public function phoneValidate($phone)
    {
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