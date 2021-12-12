<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Fix;

use Bytic\Phpqa\Composer\Command\NamespaceCommand;
use Bytic\Phpqa\Composer\Command\NamespaceCommands\IsNamespaceChildCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class FixCommand extends NamespaceCommand
{
    use IsNamespaceChildCommand;

    public const NAMESPACE_NAME = self::FIX;

    protected function doExecute(InputInterface $input, OutputInterface $output): int
    {
        $this->populateInputWithNamespaceCommand($input);
        return parent::doExecute($input, $output);
    }
    protected function configure()
    {
        parent::configure();
        $this->configureNamespaceCommandOption();
    }

}