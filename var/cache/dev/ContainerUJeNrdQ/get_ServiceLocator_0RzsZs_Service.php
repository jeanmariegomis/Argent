<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.0RzsZs.' shared service.

return $this->privates['.service_locator.0RzsZs.'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'EntrepriseRepository' => ['privates', 'App\\Repository\\EntrepriseRepository', 'getEntrepriseRepositoryService.php', true],
    'serializer' => ['services', 'serializer', 'getSerializerService', false],
], [
    'EntrepriseRepository' => 'App\\Repository\\EntrepriseRepository',
    'serializer' => '?',
]);