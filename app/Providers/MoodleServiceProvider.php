<?php

namespace App\Providers;

use App\Models\Grupo;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class MoodleServiceProvider extends ServiceProvider
{
    protected $client;

    public function __construct($app = null)
    {
        parent::__construct($app);
        $this->client = new Client([
            'base_uri' => env('MOODLE_URL') . '/webservice/rest/server.php',
            'timeout'  => 10.0,
        ]);
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MoodleServiceProvider::class, function ($app) {
            return new MoodleServiceProvider($app);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Crea un usuario en Moodle a partir de un Grupo.
     */
    public function createUserFromGrupo(Grupo $grupo)
    {
        $params = [
            'wstoken' => env('MOODLE_TOKEN'),
            'wsfunction' => 'core_user_create_users',
            'moodlewsrestformat' => 'json',
            'users' => [
                [
                    'username'  => $grupo->abreviatura,
                    'firstname' => $grupo->nombre,
                    'lastname'  => $grupo->nombre,
                    'email'     => $grupo->abreviatura . '@olimpiadasC3.es',
                    'password'  => $grupo->password,
                    'auth'      => 'manual',
                ]
            ]
        ];

        $response = $this->client->post('', [
            'form_params' => $params
        ]);

        return json_decode($response->getBody(), true);
    }
}
