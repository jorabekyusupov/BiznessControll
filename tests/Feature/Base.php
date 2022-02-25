<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;
use Tests\RefreshTestState;

class Base extends TestCase
{
    use DatabaseTransactions;

    public $connectionsToTransact = ['pgsql'];
    protected $path;
    
    protected $profileStructure;
    protected $singleStructure;
    protected $indexStructure;
    protected $modelName;
    protected $modelNamePlural;
    protected $modelClass;
    protected $paramName;
    protected $user;
    protected $rawData;
    protected $orgDbName;
    protected $hasTranslation = true;
    protected $relatedModels = [];

    public function setUp() : void
    {
        parent::setUp();

        $this->artisan('passport:install', ['--no-interaction' => true]);
        
        $this->modelNamePlural = Str::plural($this->modelName);
        $this->paramName = Str::snake(Str::camel($this->modelName));

        $this->user = User::find(1);
        
        $db_name = $this->user->default_database;
        Config::set('database.connections.byorkit_organization.database', $db_name);

        $this->path = config('app.tested_routes_file');

        if (! RefreshTestState::$started) {

            if(file_exists($this->path)){
                unlink($this->path);
            }

            RefreshTestState::$started = true;
        }

    }

    protected function getHeadersWithToken(){

        Passport::actingAs($this->user);
        $token = $this->user->createToken('Test token')->accessToken;
        return ['Authorization' => 'Bearer '. $token];

    }

    protected function createModels($count = 1){

        $params = [
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id
        ];

        $models = $this->modelClass::factory($count)->create(!$params);
        
        if($this->hasTranslation){
            $models->each(function ($model) {
                $this->modelTranslationClass::factory()->create(['object_id' => $model->id, 'language_code' => 'uz']);
                $this->modelTranslationClass::factory()->create(['object_id' => $model->id, 'language_code' => 'uzc']);
                $this->modelTranslationClass::factory()->create(['object_id' => $model->id, 'language_code' => 'ru']);
            });
        }

        return $models;
    }

    protected function route($name, $parameters = [], $absolute = true)
    {
        $this->writeToTestedRoutesFile($name);
        return route($name, $parameters, $absolute);
    }

    protected function writeToTestedRoutesFile($name)
    {
        $this->path = 'tests/tested-routes.json';
        $data = [];
        if(file_exists($this->path)){
            $data = json_decode(file_get_contents($this->path));
        }
        $data[] = $name;
        file_put_contents($this->path, json_encode($data));
    }

}
