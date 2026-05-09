<?php
declare(strict_types=1);

/**
 * Classe de base pour tous les tests de l'application.
 *
 * Cette classe étend `Illuminate\Foundation\Testing\TestCase` et permet
 * de centraliser la configuration commune à tous les tests fonctionnels
 * et unitaires de l'application.
 */
namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    // Ajoutez ici des helpers ou des configurations partagées pour les tests.
}

