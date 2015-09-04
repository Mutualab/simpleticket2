<?php

namespace AppBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader;

class DataLoader extends AbstractLoader
{
    /**
     * {@inheritdoc}
     */
    public function getFixtures()
    {
        return [
            __DIR__ . '/../Fixtures/member.yml',
            __DIR__ . '/../Fixtures/product.yml',
            // depeneds on member.yml
            __DIR__ . '/../Fixtures/company.yml',
            // depeneds on company.yml, member.yml, product.yml
            __DIR__ . '/../Fixtures/orderline.yml',
        ];
    }
}

