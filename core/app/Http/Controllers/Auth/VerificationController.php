<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | Este controlador es responsable de manejar la verificación por correo electrónico de cualquier
    | usuario que se registró recientemente con la aplicación. Los correos electrónicos también pueden
    | reenviarse si el usuario no recibió el mensaje de correo electrónico original.
    |
    */

    use VerifiesEmails;

    /**
     * Donde redirigir a los usuarios después de la verificación.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Crea una nueva instancia de controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
