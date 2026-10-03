<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index(): string
    {
        $customerModel = new CustomerModel();

        $customers = $customerModel
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('customers/index', [
            'customers' => $customers,
            'success' => session()->getFlashdata('success'),
        ]);
    }

    public function new(): string
    {
        return view('customers/form', [
            'title' => 'New Customer',
            'action' => site_url('customers'),
            'submitLabel' => 'Create Customer',
            'customer' => [
                'full_name' => '',
                'email' => '',
                'phone' => '',
            ],
            'errors' => [],
        ]);
    }

    public function create()
    {
        $customer = $this->customerInput();
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email' => 'required|valid_email|max_length[100]',
            'phone' => 'permit_empty|max_length[20]',
        ];

        if (! $this->validateData($customer, $rules)) {
            return view('customers/form', [
                'title' => 'New Customer',
                'action' => site_url('customers'),
                'submitLabel' => 'Create Customer',
                'customer' => $customer,
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $customer['created_at'] = date('Y-m-d H:i:s');
        (new CustomerModel())->insert($customer);

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer account created successfully.');
    }

    public function edit(int $id): string
    {
        $customer = (new CustomerModel())->find($id);

        if ($customer === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Customer not found.');
        }

        return view('customers/form', [
            'title' => 'Edit Customer',
            'action' => site_url('customers/' . $id),
            'submitLabel' => 'Update Customer',
            'customer' => $customer,
            'errors' => [],
        ]);
    }

    public function update(int $id)
    {
        $customerModel = new CustomerModel();
        $existing = $customerModel->find($id);

        if ($existing === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Customer not found.');
        }

        $customer = $this->customerInput();
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email' => 'required|valid_email|max_length[100]',
            'phone' => 'permit_empty|max_length[20]',
        ];

        if (! $this->validateData($customer, $rules)) {
            return view('customers/form', [
                'title' => 'Edit Customer',
                'action' => site_url('customers/' . $id),
                'submitLabel' => 'Update Customer',
                'customer' => array_merge($existing, $customer),
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $customerModel->update($id, $customer);

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer account updated successfully.');
    }

    private function customerInput(): array
    {
        return [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => trim((string) $this->request->getPost('phone')),
        ];
    }
}
