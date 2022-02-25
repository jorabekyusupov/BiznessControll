<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use ReflectionFunction;

class NotTestedRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ntr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get not tested routes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $routes = [];
        foreach(Route::getRoutes() as $route){
            $routeName = $route->getName();
            if(!empty($routeName) && !$this->notNeed($routeName)){
                $routes[] = $routeName;
            }
        }

        $routes = collect($routes);

        $testedRoutes = $this->getTestedRoutes();
        
        $notTestedRoutes = $routes->diff($testedRoutes);
        $table = [];
        foreach($notTestedRoutes as $r){
            $table[] = ['name' => '<fg=red>'.$r.'</>'];
        }
        $count = count($table);

        $this->newLine();
        if($count > 0){
            $this->error('Quyidagi '.count($table).' ta route uchun test yozilmagan. Iltimos barcha routelar uchun test yozing!');
            $this->newLine();
            $this->table(['Route'],$table);
        }else{
            $this->info('<fg=white;bg=green>Barcha routelar uchun testlar yozilgan. Qoil oma!</>');
            $this->newLine();
        }
        
    }

    private function getTestedRoutes()
    {
        $data = json_decode(file_get_contents(config('app.tested_routes_file')));
        return collect(array_unique($data));
    }

    private function getNoNeedToTestRoutes(){
        return [
            'passport',
            'phpmyinfo',
            'generated',
            'file.get-file'
        ];
    }

    private function notNeed($route){
        foreach($this->getNoNeedToTestRoutes() as $r){
            if(str_contains($route, $r)) return true;
        }

        return false;
    }


}
