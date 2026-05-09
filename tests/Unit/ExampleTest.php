<?php
declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Test unitaire d'exemple.
 *
 * Ce test est volontairement simple et montre la structure de base d'un test
 * unitaire PHPUnit. Il permet aussi de s'assurer que l'environnement de test
 * est bien configuré et opérationnel.
 */
class ExampleTest extends TestCase
{
    /**
     * Vérifie qu'une assertion simple fonctionne correctement.
     */
    public function test_that_true_is_true(): void
    {
        // Assertion élémentaire : true doit être vrai.
        $this->assertTrue(true);
    }
}

