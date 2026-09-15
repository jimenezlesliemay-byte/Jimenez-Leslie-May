<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->library('database');
        $this->call->model('ProductModel');
    }

    // READ - list all products
    public function index()
    {
        $data['products'] = $this->ProductModel->all();
        $this->call->view('products/index', $data);
    }

    public function create()
    {
        $this->call->view('products/create');
    }

    // CREATE
    public function store()
    {
        $product_name = trim($this->io->post('product_name'));
        $description  = trim($this->io->post('description'));
        $price        = $this->io->post('price');
        $quantity     = $this->io->post('quantity');

        if ($product_name === '' || $price === '' || $quantity === '') {
            $_SESSION['error'] = 'Product name, price, and quantity are required.';
            redirect('products/create');
            return;
        }

        $this->ProductModel->insert([
            'product_name' => $product_name,
            'description'  => $description,
            'price'        => $price,
            'quantity'     => $quantity,
        ]);

        $_SESSION['success'] = 'Product added successfully.';
        redirect('products');
    }

    public function edit($id)
    {
        $product = $this->ProductModel->find($id);

        if (!$product) {
            $_SESSION['error'] = 'Product not found.';
            redirect('products');
            return;
        }

        $data['product'] = $product;
        $this->call->view('products/edit', $data);
    }

    // UPDATE
    public function update($id)
    {
        $this->ProductModel->update($id, [
            'product_name' => trim($this->io->post('product_name')),
            'description'  => trim($this->io->post('description')),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity'),
        ]);

        $_SESSION['success'] = 'Product updated successfully.';
        redirect('products');
    }

    // DELETE
    public function delete($id)
    {
        $this->ProductModel->delete($id);
        $_SESSION['success'] = 'Product deleted successfully.';
        redirect('products');
    }
}