<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Test fonctionnel d'exemple.
 *
 * Il vérifie que la route racine de l'application renvoie une réponse HTTP 200.
 * Ce type de test est utile pour valider le comportement global de l'application
 * sans se soucier des détails de l'implémentation interne.
 */
class ExampleTest extends TestCase
{
    /**
     * Vérifie que la page d'accueil est accessible et renvoie un code 200.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // Envoyer une requête GET vers la route racine (`/`).
        $response = $this->get('/');

        // Contrôler que le statut HTTP de la réponse est bien 200.
        $response->assertStatus(200);
    }
}