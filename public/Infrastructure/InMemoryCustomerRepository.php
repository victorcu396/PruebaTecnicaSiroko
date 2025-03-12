<?php
declare(strict_types=1);
namespace Infrastructure;

use Domain\Customer;
use Domain\CustomerRepository;

class InMemoryCustomerRepository implements CustomerRepository
{
    /**
     * @var array<string, Customer>
     */
    private array $customers = [];
    
    /**
     * Find a customer by its ID
     * 
     * @param string $customerId
     * @return Customer|null
     */
    public function findById(string $customerId): ?Customer
    {
        return $this->customers[$customerId] ?? null;
    }
    
    /**
     * Save a customer
     * 
     * @param Customer $customer
     * @return void
     */
    public function save(Customer $customer): void
    {
        $this->customers[$customer->getId()] = $customer;
    }
    
    /**
     * Find customers by criteria
     * 
     * @param array $criteria
     * @return array
     */

     //Cambiar método para los parámetros que necesitemos
    public function findByCriteria(array $criteria): array
    {
        $result = [];
        
        foreach ($this->customers as $customer) {
            $match = true;
            
            foreach ($criteria as $property => $value) {
                $getter = 'get' . ucfirst($property);
                
                if (!method_exists($customer, $getter) || $customer->$getter() !== $value) {
                    $match = false;
                    break;
                }
            }
            
            if ($match) {
                $result[] = $customer;
            }
        }
        
        return $result;
    }
    
    /**
     * Add a customer to the repository (for testing purposes)
     * 
     * @param Customer $customer
     * @return void
     */
    public function add(Customer $customer): void
    {
        $this->save($customer);
    }
}