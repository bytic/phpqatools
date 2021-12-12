<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Composer;

use Bytic\Phpqa\Composer\Command\NamespaceCommand;
use Bytic\Phpqa\Composer\Command\NamespaceCommands\IsNamespaceChildCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class NormalizeCommand extends AbstractCommand
{
    use IsNamespaceChildCommand;

    public function getBaseName(): string
    {
        return 'composer:normalize';
    }

    protected function doExecute(InputInterface $input, OutputInterface $output): int
    {
        if (false === $this->inputHasFixOption($input)) {
            $input->setOption('dry-run', null);
        }
        return parent::doExecute($input, $output);
    }

    protected function configure()
    {
        parent::configure();

        $this->addOption('dry-run', '', InputOption::VALUE_NONE);
        $this->configureNamespaceCommandOption();
        $this->setAliasesWithNamespacePrefix([NamespaceCommand::CI, NamespaceCommand::FIX]);
    }

    protected function composerCommand(): string
    {
        return 'normalize';
    }
}