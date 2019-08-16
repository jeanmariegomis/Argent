<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.SY.2SOJ' shared service.

return $this->privates['.service_locator.SY.2SOJ'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'Entreprise' => ['privates', '.errored..service_locator.SY.2SOJ.App\\Entity\\Entreprise', NULL, 'Cannot autowire service ".service_locator.SY.2SOJ": it references class "App\\Entity\\Entreprise" but no such service exists.'],
    'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
    'manager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
    'serializer' => ['services', 'serializer', 'getSerializerService', false],
    'validator' => ['services', 'validator', 'getValidatorService', false],
], [
    'Entreprise' => 'App\\Entity\\Entreprise',
    'entityManager' => '?',
    'manager' => '?',
    'serializer' => '?',
    'validator' => '?',
]);