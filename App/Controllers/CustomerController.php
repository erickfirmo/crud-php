<?php

namespace App\Controllers;

use App\Models\Customer;

class CustomerController extends Controller {

    public function welcome()
    {
        return view('welcome');
    }

    public function index()
    {
        $customers = (new Customer())->all();
        return view('customers.index', ['customers' => $customers]);
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $model = (new Customer())->insert([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        return $this->redirect('/pessoas/editar/'.$model['id']);
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
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        (new Customer())->update($id, [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        return $this->redirect('/pessoas/editar/'.$id);
    }

    public function destroy(int $id)
    {
        (new Customer())->delete($id);

        return $this->redirect('/pessoas');
    }

}