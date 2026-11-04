<?php

namespace Tests\Feature\Auth;

use App\Mail\RecuperarContrasenyaMail;
use App\Models\Usuari;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RecuperacioContrasenyaTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_sends_password_recovery_email_to_the_registered_user_email(): void
    {
        Mail::fake();

        $usuari = Usuari::create([
            'nom_usu' => 'TestUser',
            'correu' => 'usuari@example.com',
            'contrasenya' => bcrypt('secret123'),
            'rol_tipus' => 'client',
            'foto_perfil' => 'img/default.png',
            'id_dep' => null,
        ]);

        $response = $this->post('/contrasenya/oblidada', [
            'correu' => $usuari->correu,
        ]);

        $response->assertSessionHas('status', 'Si el correu existeix, rebràs les instruccions de recuperació.');

        Mail::assertSent(RecuperarContrasenyaMail::class, function ($mail) use ($usuari) {
            return $mail->hasTo($usuari->correu)
                && str_contains($mail->enllac, '/restablir-contrasenya/')
                && str_contains($mail->enllac, 'correu=' . urlencode($usuari->correu));
        });
    }
}
