<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Fix;

use Bytic\Phpqa\Composer\Command\NamespaceCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class FixCommand extends NamespaceCommand
{
    use HasFixOption;

    public const FIX_ARGUMENT = 'fix';

    public function getBaseName(): string
    {
        return 'fix';
    }

    protected function doExecute(InputInterface $input, OutputInterface $output): int
    {
        $input->setOption(self::FIX_ARGUMENT, null);
        return parent::doExecute($input, $output);
    }
    protected function configure()
    {
        parent::configure();

        $this->addOptionFix();
    }

}