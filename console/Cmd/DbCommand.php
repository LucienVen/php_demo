<?php
namespace Cmd;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DbCommand extends Command
{
    // private $_db = null;

    // public function __construct()
    // {
    //     $this->_db = 'a db connection';
    // }

    protected function configure()
    {
        $this
            // 命令的名称 （"php console_command" 后面的部分）
            ->setName('db:connect')
            // 运行 "php console_command list" 时的简短描述
            ->setDescription('mysql connection')
            // 运行命令时使用 "--help" 选项时的完整命令描述
            ->setHelp('HHHHHHHHHHHelo world!')
            // 配置一个参数
            ->addArgument('limit', InputArgument::REQUIRED, 'what\'s model you want to create ?')
            // 配置一个可选参数
            ->addArgument('user_start', InputArgument::OPTIONAL, 'this is a optional argument');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user_start = ((null !== $input->getArgument('user_start')) && !empty($input->getArgument('user_start'))) ? $input->getArgument('user_start') : 0;

        $output->writeln('limit = '. $input->getArgument('limit'));
        $output->writeln('user_start = ' . $user_start);
        $output->writeln('db: ' . 'aaaaaaaaa');
        $output->writeln('the end.');
    }
}