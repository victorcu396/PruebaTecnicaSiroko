<?php
declare(strict_types= 1);
namespace Domain;

class ShoppingCart
{
    private string $customerId;
    private string $direction;
    
    /**
     * @var CartLine[]
     */
    private array $lines = [];
    
    public function __construct(string $customerId, string $direction)
    {
        $this->customerId = $customerId;
        $this->direction = $direction;
    }
    
    /**
     * Add a product to the shopping cart
     * 
     * @param Product $product
     * @param int $quantity
     * @return void
     */
    public function addProduct(Product $product, int $quantity): void
    {
        $productId = $product->getId();
        
        // Check if the product is already in the cart
        foreach ($this->lines as $line) {
            if ($line->getProduct()->getId() === $productId) {
                // Update quantity if product exists
                $line->increaseQuantity($quantity);
                return;
            }
        }
        
        // Add new product to cart
        $this->lines[] = new CartLine($product, $quantity);
    }
    
    /**
     * Get all lines in the shopping cart
     * 
     * @return CartLine[]
     */
    public function getLines(): array
    {
        return $this->lines;
    }
    
    /**
     * Remove a product from the cart
     * 
     * @param string $productId
     * @return void
     */
    public function removeProduct(string $productId): void
    {
        foreach ($this->lines as $key => $line) {
            if ($line->getProduct()->getId() === $productId) {
                unset($this->lines[$key]);
                $this->lines = array_values($this->lines); // Reindex array
                return;
            }
        }
    }
    
    /**
     * Update the quantity of a product
     * 
     * @param string $productId
     * @param int $quantity
     * @return void
     */
    public function updateQuantity(string $productId, int $quantity): void
    {
        foreach ($this->lines as $line) {
            if ($line->getProduct()->getId() === $productId) {
                $line->setQuantity($quantity);
                return;
            }
        }
    }
    
    /**
     * Calculate the total price of the cart
     * 
     * @return float
     */
    public function calculateTotal(): float
    {
        $total = 0;
        foreach ($this->lines as $line) {
            $total += $line->calculateSubtotal();
        }
        return $total;
    }
    
    /**
     * Get customer ID
     * 
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }
    
    /**
     * Get direction
     * 
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }
    
    /**
     * Set direction
     * 
     * @param string $direction
     * @return void
     */
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }
    
    /**
     * Get the number of items in the cart
     * 
     * @return int
     */
    public function getItemCount(): int
    {
        return count($this->lines);
    }
}