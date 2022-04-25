<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\Product\Delete\ProductDeleteRequest;
use App\Services\Product\Delete\ProductDeleteService;
use App\Services\Product\Index\ProductIndexService;
use App\Services\Product\Store\ProductStoreRequest;
use App\Services\Product\Store\ProductStoreService;
use App\Services\Type\Index\TypeIndexService;
use App\Services\Type\Show\TypeShowRequest;
use App\Services\Type\Show\TypeShowService;
use App\Validation\ProductValidator;
use App\View;
use Psr\Container\ContainerInterface;

class ProductsController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function index(): View
    {
        // Requesting all data from products table
        $service = $this->container->get(ProductIndexService::class);
        $response = $service->execute();
        $products = $response->getProducts();

        return new View('Product/index.html', ['products' => $products]);
    }

    public function add(): View
    {
        // Requesting all product types for options in select element
        $service = $this->container->get(TypeIndexService::class);
        $response = $service->execute();
        $types = $response->getTypes();

        // Requesting current URI for displaying relevant header title
        $uri = $_SERVER['REQUEST_URI'];

        return new View('Product/add.html', ['types' => $types, 'uri' => $uri]);
    }

    public function getType()
    {
        $typeId = $_POST['id'];

        // If product type has been selected, show input fields for required attribute values
        if (isset($typeId)) {
            $request = new TypeShowRequest($typeId);
            $service = $this->container->get(TypeShowService::class);
            $response = $service->execute($request);

            $type = $response->getType();
            $inputAttribute = $response->getInputAttribute();

            return new View('Product/attributes.html', ['type' => $type, 'inputAttribute' => $inputAttribute]);
        }

        return false;
    }


    public function store()
    {
        // Validate product-form input, get array with error messages
        if (isset($_POST)) {
            $validation = new ProductValidator($_POST);
            $errors = $validation->validateProductForm();
        }

        // Errors exist - return product-form with previous user input, product type options, error messages
        if (!empty($errors)) {
            $input = $_POST;
            $typeService = $this->container->get(TypeIndexService::class);
            $typeResponse = $typeService->execute();
            $types = $typeResponse->getTypes();

            // Requesting current URI for displaying relevant header title
            $uri = $_SERVER['REQUEST_URI'];

            return new View('Product/add.html', ['errors' => $errors, 'input' => $input, 'types' => $types, 'uri' => $uri]);
        }

        // No errors - store created product in DB, return to index page
        $request = new ProductStoreRequest($_POST);
        $service = $this->container->get(ProductStoreService::class);
        $service->execute($request);

        return new Redirect('/');
    }

    public function delete(): Redirect
    {
        // Request array of selected products ids, delete products from DB, return to index page
        $request = new ProductDeleteRequest($_POST);
        $service = $this->container->get(ProductDeleteService::class);
        $service->execute($request);

        return new Redirect('/');
    }
}