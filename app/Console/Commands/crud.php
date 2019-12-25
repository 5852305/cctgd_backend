<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
class crud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate
            {name}{title}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD operations';

    /**
     * CrudGenerator constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $title = $this->argument('title');
        $this->controller($name,$title);
        $this->service($name,$title);
        $this->model($name,$title);
        $this->request($name,$title);
        $this->viewIndex($name);
        $this->Api($name,$title);
        $this->ApiJs($name,$title);
        $this->Js($name,$title);
        $this->Apicontroller($name,$title);
        $this->migrations($name,$title);
//        //将当前添加的权限添加给超级管理员
//        $super_admin = Role::where('id', '=', 1)->firstOrFail(); //将输入角色匹配
//        //将当前添加的权限添加给企划
//        $layout_admin = Role::where('id', '=', 2)->firstOrFail(); //将输入角色匹配
        $show_add_edit_del=[
            ['name'=>'show '.strtolower(Str::plural(Str::snake($name))), 'title'=>$title.'查看'],
            ['name'=>'create '.strtolower(Str::plural(Str::snake($name))), 'title'=>$title.'添加'],
            ['name'=>'edit '.strtolower(Str::plural(Str::snake($name))), 'title'=>$title.'修改'],
            ['name'=>'delete '.strtolower(Str::plural(Str::snake($name))), 'title'=>$title.'删除'],
        ];
//        foreach ($show_add_edit_del as $v){
//            $permission=Permission::create($v);
//            $permission->syncRoles([$super_admin,$layout_admin]);
//        }
//        File::append(base_path('routes/web.php'), PHP_EOL.'/*-----------------------------'.$title.'-----------------------------*/'.PHP_EOL.'$router->resource(\'' . strtolower(Str::plural(Str::snake($name))) . "', '{$name}Controller', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);").PHP_EOL;
        $this->webRoute($name,$title);
    }
    /*---------------------     -获取文件-       ---------------------*/
    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }
    /*---------------------     -转换Web.php-       ---------------------*/
    protected function webRoute($name,$title)
    {
        $modelTemplate = str_replace(
            [
                '/*-*/',
            ],
            [
                PHP_EOL.'   /*-----------------------------'.$title.'-----------------------------*/'.PHP_EOL.'   $router->resource(\'' . strtolower(Str::plural(Str::snake($name))) . "', '{$name}Controller', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);".PHP_EOL.'/*-*/'
            ],
            file_get_contents(base_path('routes/web.php'))
        );

        file_put_contents(base_path('routes/web.php'), $modelTemplate);
    }
    /*---------------------     -转换Api-       ---------------------*/
    protected function Api($name,$title)
    {
        $modelTemplate = str_replace(
            [
                '/*-*/',
            ],
            [
                PHP_EOL.'   /*-----------------------------'.$title.'-----------------------------*/'.PHP_EOL.'   $api->resource(\'' . strtolower(Str::plural(Str::snake($name))) . "', '{$name}Controller', ['only' => ['index', 'store', 'update', 'destroy']]);".PHP_EOL.'/*-*/'
            ],
            file_get_contents(base_path('routes/api.php'))
        );

        file_put_contents(base_path('routes/api.php'), $modelTemplate);
    }
    /*---------------------     -转换Api-       ---------------------*/
    protected function ApiJs($name,$title)
    {
        $name=strtolower(Str::plural(Str::snake($name)));
        $modelTemplate = str_replace(
            [
                '/*-*/',
            ],
            [
                PHP_EOL.'   /*-----------------------------'.$title.'-----------------------------*/'.PHP_EOL.
                "'$name'".":{".PHP_EOL.
                                "'list':'/api/$name', //$title"."列表 get".PHP_EOL.
                                "'info':'/api/$name/:id',//$title.详情 get".PHP_EOL.
                                "'create':'/api/$name',//$title.新增 post".PHP_EOL.
                                "'update':'/api/$name/:id',//$title.修改 put".PHP_EOL.
                                "'update':'/api/$name/:ids',//$title.删除 get".PHP_EOL.
                "},".
                '/*-*/'
            ],
            file_get_contents(public_path('js/api.js'))
        );

        file_put_contents(public_path('js/api.js'), $modelTemplate);
    }
    /*---------------------     -转换Js-       ---------------------*/
    protected function Js($name,$title)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelTitle}}'
            ],
            [
                $name,
                strtolower(Str::plural(Str::snake($name))),
                strtolower(Str::snake($name)),
                $title
            ],
            $this->getStub('js')
        );
        if (!file_exists($path = public_path('cctgd')))
            mkdir($path, 0777, true);
        file_put_contents(public_path("cctgd/".strtolower(Str::plural(Str::snake($name))).".js"), $controllerTemplate);
    }
    /*---------------------     -转换Model-       ---------------------*/
    protected function model($name,$title)
    {
        $modelTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelTitle}}'
            ],
            [
                $name,
                $title
            ],
            $this->getStub('Model')
        );
        if (!file_exists($path = app_path('Models')))
            mkdir($path, 0777, true);
        file_put_contents(app_path("Models/{$name}.php"), $modelTemplate);
    }
    /*---------------------     -转换ApiController-       ---------------------*/
    protected function Apicontroller($name,$title)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelTitle}}'
            ],
            [
                $name,
                strtolower(Str::plural(Str::snake($name))),
                strtolower(Str::snake($name)),
                $title
            ],
            $this->getStub('ApiController')
        );
        if (!file_exists($path = app_path('/Http/Controllers/Api')))
            mkdir($path, 0777, true);
        file_put_contents(app_path("/Http/Controllers/Api/{$name}Controller.php"), $controllerTemplate);
    }
    /*---------------------     -转换Controller-       ---------------------*/
    protected function controller($name,$title)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelTitle}}'
            ],
            [
                $name,
                strtolower(Str::plural(Str::snake($name))),
                strtolower(Str::snake($name)),
                $title
            ],
            $this->getStub('Controller')
        );
        if (!file_exists($path = app_path('/Http/Controllers/Admin')))
            mkdir($path, 0777, true);
        file_put_contents(app_path("/Http/Controllers/Admin/{$name}Controller.php"), $controllerTemplate);
    }
    /*---------------------     -转换Service-       ---------------------*/
    protected function service($name,$title)
    {
        $serviceTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelTitle}}'
            ],
            [
                $name,
                strtolower(Str::plural(Str::snake($name))),
                strtolower(Str::snake($name)),
                $title
            ],
            $this->getStub('Services')
        );
        if (!file_exists($path = app_path('Services')))
            mkdir($path, 0777, true);
        file_put_contents(app_path("Services/{$name}Services.php"), $serviceTemplate);
    }
    /*---------------------     -转换Request-       ---------------------*/
    protected function request($name,$title)
    {
        $requestTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelTitle}}'
            ],
            [
                $name,
                $title
            ],
            $this->getStub('Request')
        );

        if (!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $requestTemplate);
    }
    /*---------------------     -转换Index视图文件-       ---------------------*/
    protected function viewIndex($name)
    {
        $viewIndexTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(Str::plural(Str::snake($name))),
                strtolower(Str::snake($name))
            ],
            $this->getStub('views/index')
        );
        if (!file_exists($path = resource_path("views/admin/".strtolower(Str::plural(Str::snake($name))))))
            mkdir($path, 0777, true);
        file_put_contents(resource_path("views/admin/".strtolower(Str::plural(Str::snake($name)))."/index.blade.php"), $viewIndexTemplate);
    }
    /*---------------------     -转换form视图文件-       ---------------------*/
    protected function viewForm($name)
    {
        $viewFormTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(Str::plural(Str::snake($name))),
                strtolower(Str::snake($name))
            ],
            $this->getStub('views/form')
        );
        if (!file_exists($path = resource_path("views/admin/".strtolower(Str::plural(Str::snake($name))))))
            mkdir($path, 0777, true);
        file_put_contents(resource_path("views/admin/".strtolower(Str::plural(Str::snake($name)))."/form.blade.php"), $viewFormTemplate);
    }
    /*---------------------     -转换create_and_edit视图文件-       ---------------------*/
    protected function viewCreateAndEdit($name)
    {
        $viewCreateAndEditTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(Str::plural(Str::snake($name))),
                strtolower(Str::snake($name))
            ],
            $this->getStub('views/create_and_edit')
        );
        if (!file_exists($path = resource_path("views/admin/".strtolower(Str::plural(Str::snake($name))))))
            mkdir($path, 0777, true);
        file_put_contents(resource_path("views/admin/".strtolower(Str::plural(Str::snake($name)))."/create_and_edit.blade.php"), $viewCreateAndEditTemplate);
    }
    /*---------------------     -转换migrations文件-       ---------------------*/
    protected function migrations($name,$title)
    {
        $migrationsTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelTitle}}'
            ],
            [
                Str::plural($name),
                strtolower(Str::plural(Str::snake($name))),
                strtolower($name),
                $title,
            ],
            $this->getStub('migrations/migration')
        );
        $migrationsname = date('Y_m_d_His').'_create_'.strtolower(Str::plural(Str::snake($name))).'_table';
        file_put_contents(database_path("migrations/".$migrationsname.".php"), $migrationsTemplate);
    }
}
