<?php
declare(strict_types=1);
namespace Domain;

class Customer
{
    private string $id;
    private string $name;
    private string $email;
    private string $direction;
    private ?ShoppingCart $shoppingCart = null;
    
    public function __construct(string $id, string $name, string $email, string $direction)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->direction = $direction;  
    }
    
  
    public function getId(): string
    {
        return $this->id;
    }
    
  
    public function getName(): string
    {
        return $this->name;
    }
    
   
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getDirection(): string
    {
        return $this->direction;
    }
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }
   

    public function getShoppingCart(): ?ShoppingCart
    {
        return $this->shoppingCart;
    }
   

    public function setShoppingCart(ShoppingCart $shoppingCart): void
    {
        $this->shoppingCart = $shoppingCart;
    }
}