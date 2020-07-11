<?php

declare(strict_types=1);

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace Tant\Command;

use think\console\Input;
use think\console\Output;
use think\console\Command;
use think\console\input\Argument;

class Create extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('tant:crud')
            ->addArgument('resource', Argument::OPTIONAL, 'your name')
            ->setDescription('create crud ');
    }

    protected function execute(Input $input, Output $output)
    {
        // 指令输出
        $name = ucfirst(trim($input->getArgument('resource')));

        //生成模型
        $modelStr = '';
        $modelStr .= "<?php \n";
        $modelStr .= "\n";
        $modelStr .= "declare(strict_types=1);\n";
        $modelStr .= "/*\n";
        $modelStr .= " * This file is part of TAnt.\n";
        $modelStr .= " * @link     https://github.com/edenleung/think-admin\n";
        $modelStr .= " * @document https://www.kancloud.cn/manual/thinkphp6_0\n";
        $modelStr .= " * @contact  QQ Group 996887666\n";
        $modelStr .= " * @author   Eden Leung 758861884@qq.com\n";
        $modelStr .= " * @copyright 2019 Eden Leung\n";
        $modelStr .= " * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt\n";
        $modelStr .= " */\n";
        $modelStr .= "\n";
        $modelStr .= "\n";
        $modelStr .= "\n";
        $modelStr .= "namespace app\common\model;\n";
        $modelStr .= "\n";
        $modelStr .= "use app\BaseModel;\n";
        $modelStr .= "\n";
        $modelStr .= 'class ' . $name . " extends BaseModel\n";
        $modelStr .= "{\n";
        $modelStr .= "  protected \$table  = '" . $name . "';\n";
        $modelStr .= "}\n";

        //生成控制器
        $apiController = $controllerStr = '';
        $apiController = $controllerStr .= "<?php \n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= "declare(strict_types=1);\n";
        $apiController = $controllerStr .= "/*\n";
        $apiController = $controllerStr .= " * This file is part of TAnt.\n";
        $apiController = $controllerStr .= " * @link     https://github.com/edenleung/think-admin\n";
        $apiController = $controllerStr .= " * @document https://www.kancloud.cn/manual/thinkphp6_0\n";
        $apiController = $controllerStr .= " * @contact  QQ Group 996887666\n";
        $apiController = $controllerStr .= " * @author   Eden Leung 758861884@qq.com\n";
        $apiController = $controllerStr .= " * @copyright 2019 Eden Leung\n";
        $apiController = $controllerStr .= " * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt\n";
        $apiController = $controllerStr .= " */\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= "\n";
        $controllerStr .= "namespace app\admin\controller;\n";
        $apiController .= "namespace app\api\controller;\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= "use app\BaseController;\n";
        $controllerStr .= "use app\admin\service\\" . $name . "Service;\n";
        $apiController .= "use app\api\service\\" . $name . "Service;\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= 'class ' . $name . " extends BaseController\n";
        $apiController = $controllerStr .= "{\n";
        $apiController = $controllerStr .= '   public function __construct(' . $name . 'Service $service)';
        $apiController = $controllerStr .= "   {\n";
        $apiController = $controllerStr .= "       \$this->service = \$service;\n";
        $apiController = $controllerStr .= "    }\n";

        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= '   public function list($pageNo=1,$pageSize=10)';
        $apiController = $controllerStr .= "   {\n";
        $apiController = $controllerStr .= "        return \$this->sendSuccess(\$this->service->list((int)\$pageNo, (int)\$pageSize,request()->get()));\n";
        $apiController = $controllerStr .= "    }\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= '   public function create()';
        $apiController = $controllerStr .= "   {\n";
        $apiController = $controllerStr .= "        \$result = \$this->service->create(request()->post());\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= "         if (!\$result) {\n";
        $apiController = $controllerStr .= "               return \$this->sendError(\$this->service->getError());\n";
        $apiController = $controllerStr .= "          }\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= "          return \$this->sendSuccess();\n";
        $apiController = $controllerStr .= "    }\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= '   public function update($id)';
        $apiController = $controllerStr .= "   {\n";
        $apiController = $controllerStr .= "        \$result = \$this->service->update(\$id,request()->put());\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= "         if (!\$result) {\n";
        $apiController = $controllerStr .= "               return \$this->sendError(\$this->service->getError());\n";
        $apiController = $controllerStr .= "          }\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= "          return \$this->sendSuccess();\n";
        $apiController = $controllerStr .= "    }\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= '   public function delete($id)';
        $apiController = $controllerStr .= "   {\n";
        $apiController = $controllerStr .= "        \$result = \$this->service->delete(\$id);\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= "         if (!\$result) {\n";
        $apiController = $controllerStr .= "               return \$this->sendError(\$this->service->getError());\n";
        $apiController = $controllerStr .= "          }\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= "          return \$this->sendSuccess();\n";
        $apiController = $controllerStr .= "    }\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= '   public function info($id)';
        $apiController = $controllerStr .= "   {\n";
        $apiController = $controllerStr .= "          return \$this->sendSuccess(\n";
        $apiController = $controllerStr .= "           \$this->service->info(\$id)\n";
        $apiController = $controllerStr .= "          );\n";
        $apiController = $controllerStr .= "    }\n";
        $apiController = $controllerStr .= "\n";
        $apiController = $controllerStr .= "}\n";

        //生成服务层
        $apiService = $serviceStr = '';
        $apiService = $serviceStr .= "<?php \n";
        $apiService = $serviceStr .= "\n";
        $apiService = $serviceStr .= "declare(strict_types=1);\n";
        $apiService = $serviceStr .= "/*\n";
        $apiService = $serviceStr .= " * This file is part of TAnt.\n";
        $apiService = $serviceStr .= " * @link     https://github.com/edenleung/think-admin\n";
        $apiService = $serviceStr .= " * @document https://www.kancloud.cn/manual/thinkphp6_0\n";
        $apiService = $serviceStr .= " * @contact  QQ Group 996887666\n";
        $apiService = $serviceStr .= " * @author   Eden Leung 758861884@qq.com\n";
        $apiService = $serviceStr .= " * @copyright 2019 Eden Leung\n";
        $apiService = $serviceStr .= " * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt\n";
        $apiService = $serviceStr .= " */\n";
        $apiService = $serviceStr .= "\n";
        $apiService = $serviceStr .= "\n";
        $apiService = $serviceStr .= "\n";
        $serviceStr .= "namespace app\admin\Service;\n";
        $apiService .= "namespace app\api\Service;\n";
        $apiService = $serviceStr .= "\n";
        $apiService = $serviceStr .= "use app\BaseService;\n";
        $apiService = $serviceStr .= "use app\common\model\\" . $name . ";\n";
//        $serviceStr .="use app\admin\Service\\".$name."Service;\n";
//        $apiService .="use app\api\Service\\".$name."Service;\n";
        $apiService = $serviceStr .= "\n";
        $apiService = $serviceStr .= 'class ' . $name . "Service extends BaseService\n";
        $apiService = $serviceStr .= "{\n";
        $apiService = $serviceStr .= '     public function __construct(' . $name . " \$model)\n";
        $apiService = $serviceStr .= "     {\n";
        $apiService = $serviceStr .= "          \$this->model = \$model;\n";
        $apiService = $serviceStr .= "     }\n";
        $apiService = $serviceStr .= " \n";
        $apiService = $serviceStr .= "     public function list(\$pageNo, \$pageSize)\n";
        $apiService = $serviceStr .= "    {\n";
        $apiService = $serviceStr .= "          \$data = \$this->model\n";
        $apiService = $serviceStr .= "            ->order('create_time desc')\n";
        $apiService = $serviceStr .= "            ->paginate([\n";
        $apiService = $serviceStr .= "                 'list_rows' => \$pageSize,\n";
        $apiService = $serviceStr .= "                 'page'      => \$pageNo,\n";
        $apiService = $serviceStr .= "             ]);\n";
        $apiService = $serviceStr .= " \n";
        $apiService = $serviceStr .= "            return [\n";
        $apiService = $serviceStr .= "               'data'       => \$data->items(),\n";
        $apiService = $serviceStr .= "               'pageSize'   => \$pageSize,\n";
        $apiService = $serviceStr .= "               'pageNo'     => \$pageNo,\n";
        $apiService = $serviceStr .= "               'totalPage'  => count(\$data->items()),\n";
        $apiService = $serviceStr .= "               'totalCount' => \$data->total(),\n";
        $apiService = $serviceStr .= "            ];\n";
        $apiService = $serviceStr .= "    }\n";
        $apiService = $serviceStr .= " \n";
        $apiService = $serviceStr .= "      public function create(\$data)\n";
        $apiService = $serviceStr .= "      {\n";
        $apiService = $serviceStr .= "           return \$this->model->save(\$data);\n";
        $apiService = $serviceStr .= "       }\n";
        $apiService = $serviceStr .= " \n";
        $apiService = $serviceStr .= "      public function update(\$id, \$data)\n";
        $apiService = $serviceStr .= "      {\n";
        $apiService = $serviceStr .= "            return \$this->model->find(\$id)->save(\$data);\n";
        $apiService = $serviceStr .= "       }\n";
        $apiService = $serviceStr .= " \n";
        $apiService = $serviceStr .= "       public function delete(\$id)\n";
        $apiService = $serviceStr .= "       {\n";
        $apiService = $serviceStr .= "            return \$this->model->find(\$id)->delete();\n";
        $apiService = $serviceStr .= "       }\n";
        $apiService = $serviceStr .= " \n";
        $apiService = $serviceStr .= "       public function info(\$id)\n";
        $apiService = $serviceStr .= "       {\n";
        $apiService = $serviceStr .= "           return \$this->model->find(\$id);\n";
        $apiService = $serviceStr .= "       }\n";
        $apiService = $serviceStr .= "\n";
        $apiService = $serviceStr .= "}\n";
        //admin模块下的路由
        $rname = strtolower($name);
        $routeStr = "\n";
        $routeStr .= '/*' . $rname . "*/\n";
        $routeStr .= "Route::group('/" . $rname . "', function () {\n";
        $routeStr .= "      Route::get('/', '" . $rname . "/list');\n";
        $routeStr .= "      Route::get('/:id$', '" . $rname . "/info');\n";
        $routeStr .= "      Route::post('/', '" . $rname . "/create');\n";
        $routeStr .= "      Route::put('/:id$', '" . $rname . "/update');\n";
        $routeStr .= "      Route::delete('/:id$', '" . $rname . "/delete');\n";
        $routeStr .= "});\n";
        $routeStr .= "\n";
        $routeStr .= "\n";
        //api模块下的路由
        $apiRouteStr = '';
        $apiRouteStr .= '/*' . $rname . "*/\n";
        $apiRouteStr .= "Route::group('/" . $rname . "', function () {\n";
        $apiRouteStr .= "      Route::get('/', '" . $rname . "/list');\n";
        $apiRouteStr .= "      Route::get('/:id$', '" . $rname . "/info');\n";
        $apiRouteStr .= "      Route::post('/', '" . $rname . "/create');\n";
        $apiRouteStr .= "      Route::put('/:id$', '" . $rname . "/update');\n";
        $apiRouteStr .= "      Route::delete('/:id$', '" . $rname . "/delete');\n";
        $apiRouteStr .= "});\n";
        $apiRouteStr .= "\n";
        $apiRouteStr .= "\n";

        $rootPath = app()->getRootPath();
        //写入模型
        $modelFilepath = $rootPath . '/app/common/model/' . $name . '.php';
        $exist = file_exists($modelFilepath);
        if ($exist) {
            unlink($modelFilepath);
        }
        $modelFile = fopen($modelFilepath, 'a');
        fwrite($modelFile, $modelStr);
        fclose($modelFile);
        //写入admin模块下的控制器
        $controllerFilepath = $rootPath . '/app/admin/controller/' . $name . '.php';
        $exist = file_exists($controllerFilepath);
        if ($exist) {
            unlink($controllerFilepath);
        }
        $controllerFile = fopen($controllerFilepath, 'a');
        fwrite($controllerFile, $controllerStr);
        fclose($controllerFile);
        //写入api模块下的控制器
        $apiControllerFilepath = $rootPath . '/app/api/controller/' . $name . '.php';
        $exist = file_exists($apiControllerFilepath);
        if ($exist) {
            unlink($apiControllerFilepath);
        }
        $apiControllerFile = fopen($apiControllerFilepath, 'a');
        fwrite($apiControllerFile, $apiController);
        fclose($apiControllerFile);

        //写入admin模块下的服务
        $serviceFilepath = $rootPath . '/app/admin/service/' . $name . 'Service.php';
        $exist = file_exists($serviceFilepath);
        if ($exist) {
            unlink($serviceFilepath);
        }
        $serviceFile = fopen($serviceFilepath, 'a');
        fwrite($serviceFile, $serviceStr);
        fclose($serviceFile);
        //写入api模块下的服务
        $aexist = is_dir($rootPath . '/app/api/service/');
        if ($aexist == false) {
            mkdir($rootPath . '/app/api/service/', 0777);
        }
        $apiServiceFilepath = $rootPath . '/app/api/service/' . $name . 'Service.php';
        $exist = file_exists($apiServiceFilepath);
        if ($exist) {
            unlink($apiServiceFilepath);
        }
        $apiServiceFile = fopen($apiServiceFilepath, 'a');
        fwrite($apiServiceFile, $apiService);
        fclose($apiServiceFile);

        //写入admin模块下的路由
        $routeFilepath = $rootPath . '/app/admin/route/app.php';
        $routeFile = fopen($routeFilepath, 'a');
        fwrite($routeFile, $routeStr);
        fclose($routeFile);
        //写入api模块下的路由
        $apiRouteFilepath = $rootPath . '/app/api/route/app.php';
        $apiRouteFile = fopen($apiRouteFilepath, 'a');
        fwrite($apiRouteFile, $apiRouteStr);
        fclose($apiRouteFile);
        $output->writeln('finish');
    }
}
