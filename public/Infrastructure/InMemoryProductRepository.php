<?php
declare(strict_types=1);

namespace Infrastructure;

use Domain\Product;
use Domain\ProductRepository;

class InMemoryProductRepository implements ProductRepository{

    public function getAll(): array{

        $bxResistance = new Product (
            id: 'A-110',
            name: 'BX Resistance',
            description: 'Culote corto ciclismo hombre.',
            price: 160,
            stock: 100,

        );

        $heCircuit = new Product (
            id: 'A-120',
            name: 'He Circuit',
            description: 'Casco ciclismo carretera.',
            price: 140,
            stock: 59,
        );

        $spxProDirtyKanza = new Product (
            id: 'A-130',
            name: 'SRX PRO Dirty Kanza',
            description: 'Maillot de manga corta hombre ultraligero.',
            price: 110,
            stock: 150,
        );

        $w2Mckinley = new Product (
            id: 'B-110',
            name: 'W2 Mckinley',
            description: 'Chaqueta para snowboard/esquí hombre.',
            price: 199,
            stock: 70,
        );

        $p1Vader = new Product (
            id: 'B-120',
            name: 'P1 Vader',
            description: 'Pantalón de nieve hombre.',
            price: 199,
            stock: 40,
        );

        $gxFrontside = new Product (
            id: 'B-130',
            name: 'GX Frontside',
            description: 'Gafas de sol para esquí/snow.',
            price: 119,
            stock: 65,
        );

        $madrynW  = new Product (
            id: 'C-110',
            name: 'Madryn-W',
            description: 'GaChaqueta sherpa mujer.',
            price: 89.95,
            stock: 120,
        );

        $hokkaiW  = new Product (
            id: 'C-120',
            name: 'Hokkai-W',
            description: 'Chaqueta acolchada resistente al agua mujer.',
            price: 189,
            stock: 95,
        );

        $totalBlack  = new Product (
            id: 'D-110',
            name: 'Total Black',
            description: 'Gafas de sol de acetato reciclado.',
            price: 100,
            stock: 150,
        );

        $nuuk  = new Product (
            id: 'E-110',
            name: 'Nuuk',
            description: 'Gorro de invierno fisherman.',
            price: 24.95,
            stock: 40,
        );

        $inMemoryProductRepository = [$bxResistance, $heCircuit, $spxProDirtyKanza, $w2Mckinley, $p1Vader, $gxFrontside, $madrynW, $hokkaiW, $totalBlack, $nuuk];
        return $inMemoryProductRepository;
    }

    public function findByProductId(string $id): ?Product{

        $products = $this->getAll();
        foreach($products as $product){
            if($product->getId()===$id){
                return $product;
            }
        }
        return null;
    }
}