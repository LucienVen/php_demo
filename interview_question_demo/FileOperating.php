<?php

/**
 * php 目录文件操作 - 打印某目录下全部文件名称
 * 获取命令行中输入目录信息
 */

class FileOperating
{
    protected $path = '';

    public function __construct(string $path = '')
    {
        // print_r($argv);

        if (!empty($path)) {
            $this->path = $path;
        }
    }

    /**
     * 读取目录
     */
    public function listDir($path)
    {
        if (is_dir($path)) {
            // 目录资源句柄
            if ($dh = opendir($path)) {
                while (($file = readdir($dh)) !== false) {
                    if (is_dir($path . '/' . $file)  && $file != '.' && $file != '..' && $file != '.git' && $file != 'vendor') {
                        echo '打开目录：' . $path . '/' . $file . PHP_EOL;
                        $this->listDir($path . '/' . $file);
                    }else {
                        if ($file != '.' && $file != '..' && $file != '.git' && $file != 'vendor') {
                            echo $file . PHP_EOL;
                        }
                    }
                }

                closedir($dh);
            }
        }else{
            echo 'ERROR! path: \'', $path , '\' NOT A DIR';
        }
    }
}

// print_r($argv);
$path = $argv[1];

$fileOperating = new FileOperating();
$fileOperating->listDir($path);