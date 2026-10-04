<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
        $this->call->model('ProductModel');
    }

    public function index()   // GET
    {
        $this->api->respond(['data' => $this->ProductModel->all()]);
    }

    public function store()   // POST
    {
        $this->ProductModel->insert($this->validated());
        $this->api->respond(['message' => 'Product created'], 201);
    }

    public function update($id)   // PUT / PATCH
    {
        if (!$this->ProductModel->find($id)) $this->api->respond_error('Product not found', 404);
        $this->ProductModel->update($id, $this->validated());
        $this->api->respond(['message' => 'Product updated']);
    }

    public function destroy($id)  // DELETE
    {
        if (!$this->ProductModel->find($id)) $this->api->respond_error('Product not found', 404);
        $this->ProductModel->delete($id);
        $this->api->respond(['message' => 'Product deleted']);
    }

    private function validated()
    {
        $b     = $this->api->body();
        $name  = trim($b['product_name'] ?? '');
        $price = $b['price'] ?? '';
        $qty   = $b['quantity'] ?? '';

        if ($name === '' || !is_numeric($price) || $price < 0 || !is_numeric($qty) || $qty < 0) {
            $this->api->respond_error('product_name, price and quantity are required (price and quantity must be 0 or more)', 422);
        }
        return [
            'product_name' => $name,
            'description'  => trim($b['description'] ?? ''),
            'price'        => $price,
            'quantity'     => (int) $qty,
        ];
    }
}