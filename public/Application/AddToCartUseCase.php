<?php
declare(strict_types=1);
namespace Application;

use Domain\Product;
use Domain\ShoppingCart;
use Domain\ProductRepository;
use Domain\CustomerRepository;
use Application\Exceptions\ProductNotFoundException;
use Application\Exceptions\InsufficientStockException;
use Application\Exceptions\CustomerNotFoundException;

class AddToCartUseCase
{
    private ProductRepository $productRepository;
    private CustomerRepository $customerRepository;
    
    public function __construct(
        ProductRepository $productRepository,
        CustomerRepository $customerRepository
    ) {
        $this->productRepository = $productRepository;
        $this->customerRepository = $customerRepository;
    }
    
    /**
     * Adds a product to the customer's shopping cart
     * 
     * @param string $customerId
     * @param string $productId
     * @param int $quantity
     * @return ShoppingCart
     * @throws ProductNotFoundException
     * @throws InsufficientStockException
     * @throws CustomerNotFoundException
     */
    public function execute(string $customerId, string $productId, int $quantity): ShoppingCart
    {
        // Validate customer exists
        $customer = $this->customerRepository->findById($customerId);
        if (!$customer) {
            throw new CustomerNotFoundException("Customer with ID $customerId not found");
        }


        // Validate product exists
        $product = $this->productRepository->findByProductId($productId);
        if (!$product) {
            throw new ProductNotFoundException("Product with ID $productId not found");
        }
        
        // Validate stock availability
        if ($product->getStock() < $quantity) {
            throw new InsufficientStockException(
                "Insufficient stock for product {$product->getName()}. Available: {$product->getStock()}, Requested: $quantity"
            );
        }
        
        // Get or create shopping cart
        $cart = $customer->getShoppingCart();
        if (!$cart) {
            $cart = new ShoppingCart($customerId, $customer->getDirection());
            $customer->setShoppingCart($cart);
        }
        
        // Add product to cart
        $cart->addProduct($product, $quantity);
        
        return $cart;
    }
}