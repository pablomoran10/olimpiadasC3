<?php

namespace App\Providers;

use App\Models\Grupo;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

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
            'users' => [$this->createMoodleUserObject($grupo)],
        ];

        $response = $this->client->post('', [
            'form_params' => $params
        ]);
        $response = json_decode($response->getBody(), true);

        return !isset($response['exception']);
    }

    /**
     * Crea un usuario en Moodle a partir de un array de Grupos.
     */
    public function createUsersFromGrupos(Collection $grupos)
    {
        $createdUsers = [];
        foreach ($grupos as $grupo) {
            $createdUsers[$grupo->nombre] = $this->createUserFromGrupo($grupo);
        }
        return $createdUsers;
    }

    /**
     * Crea un usuario en Moodle a partir de un Grupo.
     */
    public function createMoodleUserObject(Grupo $grupo)
    {
        return [
            'username'  => $grupo->abreviatura,
            'firstname' => $grupo->nombre,
            'lastname'  => $grupo->centro ? $grupo->centro->dencen : $grupo->nombre,
            'email'     => $grupo->abreviatura . '@olimpiadasC3.es',
            'password'  => $grupo->password,
            'auth'      => 'manual',
        ];
    }
}
