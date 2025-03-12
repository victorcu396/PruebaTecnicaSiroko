<?php
declare(strict_types= 1);
namespace Domain;

class CartLine
{
    private Product $product;
    private int $quantity;
    
    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
    
    /**
     * Get the product
     * 
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }
    
    /**
     * Get the quantity
     * 
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
    
    /**
     * Increase the quantity
     * 
     * @param int $amount
     * @return void
     */
    public function increaseQuantity(int $amount): void
    {
        $this->quantity += $amount;
    }
    
    /**
     * Set the quantity
     * 
     * @param int $quantity
     * @return void
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
    
    /**
     * Calculate the subtotal for this line
     * 
     * @return float
     */
    public function calculateSubtotal(): float
    {
        return $this->product->getPrice() * $this->quantity;
    }
}