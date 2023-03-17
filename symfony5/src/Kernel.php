<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...

            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
        ];

        // ...
    }
