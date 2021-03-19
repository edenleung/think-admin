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

namespace TAnt\Command\Crud;

use think\console\Input;
use think\console\Output;
use think\console\Command;
use think\console\input\Argument;

class Crud extends Command
{
    protected $rootPath;

    protected function configure()
    {
        // 指令配置
        $this->setName('tant:create')
            ->addArgument('resource', Argument::OPTIONAL, 'your name')
            ->setDescription('create crud ');

        $this->rootPath = app()->getRootPath();
    }

    protected function getStub($name): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . $name . '.stub';
    }

    /**
     * 模型类.
     *
     * @param [type] $name
     *
     * @return void
     */
    protected function makeModel($name)
    {
        $stub = file_get_contents($this->getStub('model'));

        $namespace = 'app\\common\\model';
        $class = str_replace($namespace . '\\', '', $name);
        $table = strtolower(preg_replace('/((?<=[a-z])(?=[A-Z]))/', '_', $name));
        $content = str_replace(['{%table%}', '{%className%}', '{%namespace%}'], [
            $table,
            $class,
            $namespace,
        ], $stub);

        $path = $this->rootPath . '/app/common/model/' . $name . '.php';
        $this->write($path, $content);
    }

    /**
     * 控制器类.
     *
     * @param [type] $name
     *
     * @return void
     */
    protected function makeController($app, $name)
    {
        $stub = file_get_contents($this->getStub('controller'));

        $namespace = 'app\\' . $app . '\\controller';
        $class = str_replace($namespace . '\\', '', $name);
        $service = $name . 'Service';
        $content = str_replace(['{%service%}', '{%className%}', '{%namespace%}'], [
            $service,
            $class,
            $namespace,
        ], $stub);

        $path = $this->rootPath . '/app/' . $app . '/controller/' . $name . '.php';
        $this->write($path, $content);
    }

    protected function makeRoute($app, $name)
    {
        $stub = file_get_contents($this->getStub('route'));

        $content = str_replace(['{%name%}', '{%class%}'], [
            strtolower($name),
            $name,
        ], $stub);

        $path = $this->rootPath . '/app/' . $app . '/route/' . 'app.php';
        $this->write($path, $content);
    }

    /**
     * 服务类.
     *
     * @param [type] $name
     *
     * @return void
     */
    protected function makeService($name)
    {
        $stub = file_get_contents($this->getStub('service'));
        $model = $name;
        $name = $name . 'Service';
        $namespace = 'app\\common\\service';
        $class = str_replace($namespace . '\\', '', $name);
        $content = str_replace(['{%model%}', '{%className%}', '{%namespace%}'], [
            $model,
            $class,
            $namespace,
        ], $stub);

        $path = $this->rootPath . '/app/common/service/' . $name . '.php';
        $this->write($path, $content);
    }

    /**
     * @param [type] $path
     * @param [type] $content
     *
     * @return void
     */
    protected function write($path, $content)
    {
        $file = fopen($path, 'a');
        fwrite($file, $content);
        fclose($file);
    }

    /**
     * 数据表.
     *
     * @param [type] $name
     *
     * @return void
     */
    protected function makeTable($name)
    {
        $sql = ' CREATE TABLE IF NOT EXISTS `' . strtolower(preg_replace('/((?<=[a-z])(?=[A-Z]))/', '_', $name)) . '` ( ';
        $sql .= '
                    `id` int(11) NOT NULL AUTO_INCREMENT ,
                    `create_time` int(11) NOT NULL DEFAULT \'0\',
                      `update_time` int(11) NOT NULL DEFAULT \'0\',
                      `delete_time` int(11) NOT NULL DEFAULT \'0\',
                    PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
                ';

        \think\facade\Db::execute($sql);
    }

    protected function execute(Input $input, Output $output)
    {
        // 指令输出
        $name = ucfirst(trim($input->getArgument('resource')));

        $this->makeModel($name);
        $this->makeService($name);

        $apps = ['admin', 'api'];

        foreach ($apps as $app) {
            $this->makeController($app, $name);
            $this->makeRoute($app, $name);
        }

        $this->makeTable($name);

        $output->writeln('一键生成成功');
    }
}
