<?php
declare(strict_types=1);
namespace Domain;

interface CustomerRepository
{
    
    public function findById(string $customerId): ?Customer;
    
   
    public function save(Customer $customer): void;
 
    public function findByCriteria(array $criteria): array;
}