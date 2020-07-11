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

namespace TAnt\Command\Install;

use TAnt\TAnt;
use think\console\Input;
use think\console\Output;
use think\facade\Console;
use think\console\Command;

class Install extends Command
{
    private $conn;
    private $user;
    private $connection;

    protected function configure()
    {
        $this->setName('tant:install')
            ->setDescription('安装');
    }

    protected function execute(Input $input, Output $output)
    {
        $this->output->highlight('TAnt version ' . TAnt::VERSION . "\n");
        $this->configSomething();
        $isStart = $this->output->ask($input, '> 是否开始安装 (Y/n)？') ?: 'y';

        if ($isStart === 'y') {
            $this->startInstall();
        } else {
            $output->info('> 已取消安装');
        }
    }

    /**
     * @return void
     */
    protected function configSomething()
    {
        $this->configMysql();
        $this->configUser();
    }

    /**
     * 配置数据库.
     *
     * @return void
     */
    protected function configMysql()
    {
        $this->output->warning(' > 开始配置 数据库信息');
        $hostName = $this->output->ask($this->input, '> 数据库地址, 默认 (127.0.0.1)') ?: '127.0.0.1';
        $hostPort = $this->output->ask($this->input, '> 数据库端口, 默认 (3306)') ?: 3306;
        $charset = $this->output->ask($this->input, '> 数据库编码, 默认 (utf8mb4) 支持Emoji') ?: 'utf8mb4';
        $dataBase = $this->output->ask($this->input, '> 数据库名, 默认 (think)') ?: 'think';
        $userName = $this->output->ask($this->input, '> 数据库用户名, 默认 (root)') ?: 'root';
        $passWord = $this->output->ask($this->input, '> 数据库密码, 默认 (空)') ?: '';

        $this->output->info('====== 数据库信息 ======');
        $this->output->writeln("数据库地址: $hostName");
        $this->output->writeln("数据库端口: $hostPort");
        $this->output->writeln("数据库编码: $charset");
        $this->output->writeln("数据库名称: $dataBase");
        $this->output->writeln("数据库用户名: $userName");
        $this->output->writeln($passWord ? '数据库密码: ' . $passWord : '数据库密码: 空');
        $this->output->info('========================');
        $this->output->writeln('');

        $connections = \config('database.connections');
        $connections['mysql']['hostname'] = $hostName;
        $connections['mysql']['database'] = $dataBase;
        $connections['mysql']['username'] = $userName;
        $connections['mysql']['password'] = $passWord;
        $connections['mysql']['hostport'] = $hostPort;
        $connections['mysql']['charset'] = $charset;

        \config([
            'connections' => $connections,
        ], 'database');

        $this->connection = $connections['mysql'];
    }

    /**
     * 配置超级管理员信息.
     *
     * @return void
     */
    public function configUser()
    {
        $this->output->warning(' > 接下来配置 超级管理员信息');

        $nickname = $this->output->ask($this->input, '> 用户昵称 默认(SeratiMa)') ?: 'Serati Ma';
        $loginName = $this->output->ask($this->input, '> 登录账号 默认(admin)') ?: 'admin';

        $defaultPassword = \randomKey();
        $loginPassword = $this->output->ask($this->input, "> 登录密码 默认自动生成({$defaultPassword})") ?: $defaultPassword;
        $email = $this->output->ask($this->input, '> 用户邮箱 默认(SeratiMa@aliyun.com)') ?: 'SeratiMa@aliyun.com';

        $this->output->info('====== 超级管理员信息 ======');
        $this->output->writeln("昵称: $nickname");
        $this->output->writeln("登录账号: $loginName");
        $this->output->writeln("登录密码: $loginPassword");
        $this->output->writeln("邮箱地址: $email");
        $this->output->info('======================');
        $this->output->writeln('');

        $user['nickname'] = $nickname;
        $user['loginName'] = $loginName;
        $user['loginPassword'] = $loginPassword;
        $user['email'] = $email;

        $this->user = $user;
    }

    /**
     * 生成 Env 文件.
     *
     * @return void
     */
    protected function createEnvFile()
    {
        $env = \parse_ini_file(root_path() . '.env.example', true);

        $env['DATABASE']['HOSTNAME'] = $this->connection['hostname'];
        $env['DATABASE']['DATABASE'] = $this->connection['database'];
        $env['DATABASE']['USERNAME'] = $this->connection['username'];
        $env['DATABASE']['PASSWORD'] = $this->connection['password'];
        $env['DATABASE']['HOSTPORT'] = $this->connection['hostport'];
        $env['DATABASE']['CHARSET'] = $this->connection['charset'];
        write_php_ini($env, root_path() . '.env');
        $this->output->info('生成 .env 文件成功');
    }

    /**
     * 执行安装.
     *
     * @return void
     */
    protected function startInstall()
    {
        $this->createEnvFile();
        $this->connectionDatabase();
        $this->createDatabase();
        $this->makeTokenSignerKey();
        $this->migrateDatabase();
        $this->createUser();
        $this->createPermission(Data::PERMISSION);
        $this->createRole();
        $this->createDept();

        $this->output->warning('安装成功');
    }

    /**
     * 连接数据库.
     *
     * @return void
     */
    protected function connectionDatabase()
    {
        try {
            $conn = new \mysqli($this->connection['hostname'], $this->connection['username'], $this->connection['password'], '', (int) $this->connection['hostport']);
            $conn->query('SET NAMES UTF8MB4');
        } catch (\Exception $e) {
            throw new \Exception('连接数据库失败');
        }

        $this->conn = $conn;
        $this->output->info('连接数据库成功');
    }

    /**
     * 创建数据库.
     *
     * @return void
     */
    protected function createDatabase()
    {
        $this->conn->query(sprintf(
            'CREATE DATABASE IF NOT EXISTS %s DEFAULT CHARSET %s COLLATE %s_unicode_ci;',
            $this->connection['database'],
            $this->connection['charset'],
            $this->connection['charset']
        ));

        $this->output->info('创建数据库成功');
    }

    /**
     * 生成 JWT Token 私钥.
     *
     * @return void
     */
    protected function makeTokenSignerKey()
    {
        Console::call('jwt:make');
        $this->output->info('生成成功 token 私钥');
    }

    /**
     * 数据库迁移.
     *
     * @return void
     */
    protected function migrateDatabase()
    {
        $output = Console::call('migrate:run');
        $this->output->info($output->fetch());
        $this->output->info('成功执行 数据库迁移');
    }

    /**
     * 创建超级管理账号.
     *
     * @return void
     */
    protected function createUser()
    {
        $default_password = $this->user['loginPassword'];
        $hash = \randomKey();
        $time = time();
        $pwd_peppered = hash_hmac('sha256', $default_password, $hash);
        $password = password_hash($pwd_peppered, PASSWORD_DEFAULT);

        $this->conn->query(sprintf(
            "INSERT INTO `%s`.`user` (`name`, `password`, `hash`, `nickname`, `dept_id`, `status`, `avatar`, `email`, `create_time`, `update_time`)
            VALUES ('%s', '%s', '%s', '%s', '0', '1', 'storage/topic/avatar.png', '%s', '%s', '%s');",
            $this->connection['database'],
            $this->user['loginName'],
            $password,
            $hash,
            $this->user['nickname'],
            $this->user['email'],
            $time,
            $time
        ));

        $this->output->info('成功执行 创建超级管理账号');
    }

    public function createPermission($rows)
    {
        foreach ($rows as $row) {
            $children = [];

            if (isset($row['children'])) {
                $children = $row['children'];
                unset($row['children']);
            }

            $this->conn->query(sprintf(
                "INSERT INTO `%s`.`permission` (`name`, `title`, `pid`, `type`, `status`, `path`, `redirect`, `component`, `icon`, `permission`, `keepAlive`, `hidden`, `hideChildrenInMenu`)
                    VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
                $this->connection['database'],
                $row['name'],
                $row['title'],
                $row['pid'],
                $row['type'],
                $row['status'],
                $row['path'],
                $row['redirect'],
                $row['component'],
                $row['icon'],
                $row['permission'],
                $row['keepAlive'],
                $row['hidden'],
                $row['hideChildrenInMenu']
            ));

            if (!empty($children)) {
                $this->createPermission($children);
            }
        }
    }

    protected function createRole()
    {
        $this->conn->query(sprintf(
            "INSERT INTO `%s`.`role` (`name`, `title`, `pid`, `mode`, `status`)
                VALUES ('%s', '%s', '%s', '%s', '%s');",
            $this->connection['database'],
            'root',
            '顶级角色',
            0,
            0,
            1
        ));

        $this->output->info('成功执行 创建角色');
    }

    protected function createDept()
    {
        $depts = Data::Dept;

        foreach ($depts as $dept) {
            $this->conn->query(sprintf(
                "INSERT INTO `%s`.`dept` (`dept_name`, `dept_pid`, `dept_status`)
                    VALUES ('%s', '%s', '%s');",
                $this->connection['database'],
                $dept['dept_name'],
                $dept['dept_pid'],
                1
            ));
        }

        $this->output->info('成功执行 创建部门');
    }
}
