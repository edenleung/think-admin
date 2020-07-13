<?php
declare (strict_types = 1);

namespace TAnt\Command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;

use think\console\Output;

class Create extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('create')
            ->addArgument('resource', Argument::OPTIONAL, "your name")
            ->setDescription('create crud ');
    }

    protected function execute(Input $input, Output $output)
    {
    	// 指令输出
        $name =ucfirst(trim($input->getArgument('resource')));

        //生成模型
        $modelStr='';
        $modelStr .= "<?php \n";
        $modelStr .="\n";
        $modelStr .= "declare(strict_types=1);\n";
        $modelStr .="/*\n";
        $modelStr .=" * This file is part of TAnt.\n";
        $modelStr .=" * @link     https://github.com/edenleung/think-admin\n";
        $modelStr .=" * @document https://www.kancloud.cn/manual/thinkphp6_0\n";
        $modelStr .=" * @contact  QQ Group 996887666\n";
        $modelStr .=" * @author   Eden Leung 758861884@qq.com\n";
        $modelStr .=" * @copyright 2019 Eden Leung\n";
        $modelStr .=" * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt\n";
        $modelStr .=" */\n";
        $modelStr .="\n";
        $modelStr .="\n";
        $modelStr .="\n";
        $modelStr .= "namespace app\common\model;\n";
        $modelStr .="\n";
        $modelStr .="use app\BaseModel;\n";
        $modelStr .="\n";
        $modelStr .="class ".$name." extends BaseModel\n";
        $modelStr .="{\n";
        $modelStr .="  protected \$table  = '".strtolower(preg_replace('/((?<=[a-z])(?=[A-Z]))/', '_', $name))."';\n";
        $modelStr .="}\n";

        //生成控制器
        $head='';
        $head .= "<?php \n";
        $head .="\n";
        $head .= "declare(strict_types=1);\n";
        $head .="/*\n";
        $head .=" * This file is part of TAnt.\n";
        $head .=" * @link     https://github.com/edenleung/think-admin\n";
        $head .=" * @document https://www.kancloud.cn/manual/thinkphp6_0\n";
        $head .=" * @contact  QQ Group 996887666\n";
        $head .=" * @author   Eden Leung 758861884@qq.com\n";
        $head .=" * @copyright 2019 Eden Leung\n";
        $head .=" * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt\n";
        $head .=" */\n";
        $head .="\n";
        $head .="\n";
        $head .="\n";
        $controllerStr = "namespace app\admin\controller;\n";
        $controllerStr .= "\n";
        $controllerStr .= "use app\BaseController;\n";
        $controllerStr .="use app\admin\service\\".$name."Service;\n";

        $apiControllerStr = "namespace app\api\controller;\n";
        $apiControllerStr .= "\n";
        $apiControllerStr .= "use app\BaseController;\n";
        $apiControllerStr .="use app\api\service\\".$name."Service;\n";
        $floor='';
        $floor .="\n";
        $floor .="class ".$name." extends BaseController\n";
        $floor .="{\n";
        $floor .="   public function __construct(".$name."Service \$service)";
        $floor .="   {\n";
        $floor .="       \$this->service = \$service;\n";
        $floor .="    }\n";

        $floor .="\n";
        $floor .="   public function list(\$pageNo=1,\$pageSize=10)";
        $floor .="   {\n";
        $floor .="        return \$this->sendSuccess(\$this->service->list((int)\$pageNo, (int)\$pageSize,request()->get()));\n";
        $floor .="    }\n";
        $floor .="\n";
        $floor .="   public function create()";
        $floor .="   {\n";
        $floor .="        \$result = \$this->service->create(request()->post());\n";
        $floor .="\n";
        $floor .="         if (!\$result) {\n";
        $floor .="               return \$this->sendError(\$this->service->getError());\n";
        $floor .="          }\n";
        $floor .="\n";
        $floor .="          return \$this->sendSuccess();\n";
        $floor .="    }\n";
        $floor .="\n";
        $floor .="   public function update(\$id)";
        $floor .="   {\n";
        $floor .="        \$result = \$this->service->update(\$id,request()->put());\n";
        $floor .="\n";
        $floor .="         if (!\$result) {\n";
        $floor .="               return \$this->sendError(\$this->service->getError());\n";
        $floor .="          }\n";
        $floor .="\n";
        $floor .="          return \$this->sendSuccess();\n";
        $floor .="    }\n";
        $floor .="\n";
        $floor .="   public function delete(\$id)";
        $floor .="   {\n";
        $floor .="        \$result = \$this->service->delete(\$id);\n";
        $floor .="\n";
        $floor .="         if (!\$result) {\n";
        $floor .="               return \$this->sendError(\$this->service->getError());\n";
        $floor .="          }\n";
        $floor .="\n";
        $floor .="          return \$this->sendSuccess();\n";
        $floor .="    }\n";
        $floor .="\n";
        $floor .="   public function info(\$id)";
        $floor .="   {\n";
        $floor .="          return \$this->sendSuccess(\n";
        $floor .="           \$this->service->info(\$id)\n";
        $floor .="          );\n";
        $floor .="    }\n";
        $floor .="\n";
        $floor .="}\n";

        //生成服务层
        $Shead='';
        $Shead .= "<?php \n";
        $Shead .="\n";
        $Shead .= "declare(strict_types=1);\n";
        $Shead .="/*\n";
        $Shead .=" * This file is part of TAnt.\n";
        $Shead .=" * @link     https://github.com/edenleung/think-admin\n";
        $Shead .=" * @document https://www.kancloud.cn/manual/thinkphp6_0\n";
        $Shead .=" * @contact  QQ Group 996887666\n";
        $Shead .=" * @author   Eden Leung 758861884@qq.com\n";
        $Shead .=" * @copyright 2019 Eden Leung\n";
        $Shead .=" * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt\n";
        $Shead .=" */\n";
        $Shead .="\n";
        $Shead .="\n";
        $Shead .="\n";
        $serviceStr = "namespace app\admin\Service;\n";
        $serviceStr .="\n";
        $serviceStr .="use app\BaseService;\n";
        $serviceStr .="use app\common\model\\".$name.";\n";
        $apiServiceStr = "namespace app\api\Service;\n";
        $apiServiceStr .="\n";
        $apiServiceStr .="use app\BaseService;\n";
        $apiServiceStr .="use app\common\model\\".$name.";\n";
        $Sfloor='';
        $Sfloor .="\n";
        $Sfloor .="class ".$name."Service extends BaseService\n";
        $Sfloor .="{\n";
        $Sfloor .="     public function __construct(".$name." \$model)\n";
        $Sfloor .="     {\n";
        $Sfloor .="          \$this->model = \$model;\n";
        $Sfloor .="     }\n";
        $Sfloor .=" \n";
        $Sfloor .="     public function list(\$pageNo, \$pageSize)\n";
        $Sfloor .="    {\n";
        $Sfloor .="          \$data = \$this->model\n";
        $Sfloor .="            ->order('create_time desc')\n";
        $Sfloor .="            ->paginate([\n";
        $Sfloor .="                 'list_rows' => \$pageSize,\n";
        $Sfloor .="                 'page'      => \$pageNo,\n";
        $Sfloor .="             ]);\n";
        $Sfloor .=" \n";
        $Sfloor .="            return [\n";
        $Sfloor .="               'data'       => \$data->items(),\n";
        $Sfloor .="               'pageSize'   => \$pageSize,\n";
        $Sfloor .="               'pageNo'     => \$pageNo,\n";
        $Sfloor .="               'totalPage'  => count(\$data->items()),\n";
        $Sfloor .="               'totalCount' => \$data->total(),\n";
        $Sfloor .="            ];\n";
        $Sfloor .="    }\n";
        $Sfloor .=" \n";
        $Sfloor .="      public function create(\$data)\n";
        $Sfloor .="      {\n";
        $Sfloor .="           return \$this->model->save(\$data);\n";
        $Sfloor .="       }\n";
        $Sfloor .=" \n";
        $Sfloor .="      public function update(\$id, \$data)\n";
        $Sfloor .="      {\n";
        $Sfloor .="            return \$this->model->find(\$id)->save(\$data);\n";
        $Sfloor .="       }\n";
        $Sfloor .=" \n";
        $Sfloor .="       public function delete(\$id)\n";
        $Sfloor .="       {\n";
        $Sfloor .="            return \$this->model->find(\$id)->delete();\n";
        $Sfloor .="       }\n";
        $Sfloor .=" \n";
        $Sfloor .="       public function info(\$id)\n";
        $Sfloor .="       {\n";
        $Sfloor .="           return \$this->model->find(\$id);\n";
        $Sfloor .="       }\n";
        $Sfloor .="\n";
        $Sfloor .="}\n";
        //admin模块下的路由
        $rname=strtolower($name);
        $routeStr="";
        $routeStr.="/*".$rname."*/\n";
        $routeStr.="Route::group('/".$rname."', function () {\n";
        $routeStr.="      Route::get('/', '".$rname."/list');\n";
        $routeStr.="      Route::get('/:id$', '".$rname."/info');\n";
        $routeStr.="      Route::post('/', '".$rname."/create');\n";
        $routeStr.="      Route::put('/:id$', '".$rname."/update');\n";
        $routeStr.="      Route::delete('/:id$', '".$rname."/delete');\n";
        $routeStr.="});\n";
        $routeStr.="\n";
        $routeStr.="\n";
       //api模块下的路由
        $apiRouteStr="";
        $apiRouteStr.="/*".$rname."*/\n";
        $apiRouteStr.="Route::group('/".$rname."', function () {\n";
        $apiRouteStr.="      Route::get('/', '".$rname."/list');\n";
        $apiRouteStr.="      Route::get('/:id$', '".$rname."/info');\n";
        $apiRouteStr.="      Route::post('/', '".$rname."/create');\n";
        $apiRouteStr.="      Route::put('/:id$', '".$rname."/update');\n";
        $apiRouteStr.="      Route::delete('/:id$', '".$rname."/delete');\n";
        $apiRouteStr.="});\n";
        $apiRouteStr.="\n";
        $apiRouteStr.="\n";


        $rootPath = app()->getRootPath();
        //写入模型
        $modelFilepath = $rootPath.'/app/common/model/'.$name.'.php';
        $exist=file_exists($modelFilepath);
        if($exist){
            unlink($modelFilepath);
        }
        $modelFile=fopen($modelFilepath,"a");
        fwrite($modelFile, $modelStr);
        fclose($modelFile);
        //写入admin模块下的控制器
        $controllerFilepath = $rootPath.'/app/admin/controller/'.$name.'.php';
        $exist=file_exists($controllerFilepath);
        if($exist){
            unlink($controllerFilepath);
        }
        $controllerFile=fopen($controllerFilepath,"a");
        fwrite($controllerFile, $head.$controllerStr.$floor);
        fclose($controllerFile);
        //写入api模块下的控制器
        $apiControllerFilepath = $rootPath.'/app/api/controller/'.$name.'.php';
        $exist=file_exists($apiControllerFilepath);
        if($exist){
            unlink($apiControllerFilepath);
        }
        $apiControllerFile=fopen($apiControllerFilepath,"a");
        fwrite($apiControllerFile, $head.$apiControllerStr.$floor);
        fclose($apiControllerFile);

        //写入admin模块下的服务
        $serviceFilepath = $rootPath.'/app/admin/service/'.$name.'Service.php';
        $exist=file_exists($serviceFilepath);
        if($exist){
            unlink($serviceFilepath);
        }
        $serviceFile=fopen($serviceFilepath,"a");
        fwrite($serviceFile, $Shead.$serviceStr.$Sfloor);
        fclose($serviceFile);
        //写入api模块下的服务
        $aexist=is_dir($rootPath.'/app/api/service');
        if($aexist==false){
            mkdir($$rootPath.'/app/api/service',0777);
        }
        $apiServiceFilepath = $rootPath.'/app/api/service/'.$name.'Service.php';
        $exist=file_exists($apiServiceFilepath);
        if($exist){
            unlink($apiServiceFilepath);
        }
        $apiServiceFile=fopen($apiServiceFilepath,"a");
        fwrite($apiServiceFile, $Shead.$apiServiceStr.$Sfloor);
        fclose($apiServiceFile);

        //写入admin模块下的路由
        $routeFilepath = $rootPath.'/app/admin/route/app.php';
        $routeFile=fopen($routeFilepath,"a");
        fwrite($routeFile, $routeStr);
        fclose($routeFile);
        //写入api模块下的路由
        $apiRouteFilepath = $rootPath.'/app/api/route/app.php';
        $apiRouteFile=fopen($apiRouteFilepath,"a");
        fwrite($apiRouteFile, $apiRouteStr);
        fclose($apiRouteFile);
        $output->writeln("finish");
    }
}
