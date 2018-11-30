<?php
namespace Api;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ApiUninstallCommand extends BaseCommand
{

    protected function configure()
    {
        $this
            ->setName('uninstall')
            ->setDescription('Uninstalls the Api application (removes .env files, mysql data and logs)')
            ->setHelp('This command uninstalls the Api applications and deletes all the env files, mysql data and logs');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);
        $this->checkApiExistence();

        //Execute container kill command
        $command = $this->getApplication()->find('container:kill');

        $returnCode = $command->run($input, $output);
        if ($returnCode !== 0) {
            $this->sendErrorMessage('An error occurred when killing the containers');
        }

        $this->removeEnvFiles();
        $this->removeMysqlData();
        $this->removeLogs();

        $this->buildSuccessMessage('Uninstall completed!');

        return 0;
    }
}
