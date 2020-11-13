<?php

namespace Console\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ValidatorCommand extends Command 
{
    protected function configure()
    {
        $this->setName('validator')
        ->setDescription('Collects ads metrics from Facebook')
        ->setHelp('This command prints the current date and time');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $message = sprintf("Hello...");
	$output->writeln($message);
	
	return 0;
    }
}

