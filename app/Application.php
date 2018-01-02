<?php namespace App;

use App\Services\Database;
use App\Services\Model;
use Pecee\SimpleRouter\SimpleRouter;
use Philo\Blade\Blade;

class Application extends SimpleRouter{

    public $database;
    public $view;
    public $config;

    public function __construct(array $config, $basedir)
    {
        $this->config = $config;
        $this->config['base_path'] = $basedir;
    }

    public function boot(){
        // Is debug ON ?
        if($this->config['debug']) {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        }
       $this->database = Database::getInstance()->connect($this->config['database']['connections'][$this->config['database']['default']]);
        Model::configure($this->database);
        $this->view = (new Blade($this->config['base_path'].'/views', $this->config['base_path'].'/cache'))->view();
    }

    public function view($view, $data = []){
        return $this->view->make($view, $data)->render();
    }

}