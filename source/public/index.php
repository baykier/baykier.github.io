<?php
/**
 * Created by PhpStorm.
 * Author: Baykier<1035666345@qq.com>
 * Date: 2017/6/4
 * Time: 21:39
 */

/**
 * homepage 自动更新脚本
 */

/**
 * CSV 软件 Git
 */
define('CSV_SOFT','git');
/**
 * HASH for github.com
 */
define('HASH','59341c1092c47');
define('ROOT_PATH',dirname(dirname(__DIR__)));
define('LOG_FILE',ROOT_PATH .'/git-auto-pull.log');

/**
 * 获取上次命令的状态
 * echo $?
 * @return int
 */
function getShellStatus()
{
    return (int) shell_exec(' echo @?');
}
$hash = isset($_GET['hash']) ? trim($_GET['hash']) : '';

if ($hash != HASH)
{
    header('HTTP/1.0 403 Forbidden');
    exit('Forbidden');
}

chdir(ROOT_PATH);
shell_exec(sprintf("echo git auto pull time is %s >> %s",date('Y-m-d H:i:s'),LOG_FILE));
shell_exec(sprintf("git pull origin master >> %s 2>&1 &",LOG_FILE));
shell_exec(sprintf("echo git pull status is %s >> %s \n",getShellStatus(),LOG_FILE));

