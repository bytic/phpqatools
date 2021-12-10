<?php
declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Composer;

/**
 *
 */
class ValidateCommand extends AbstractCommand
{
    public function getBaseName(): string
    {
        return 'composer:validate';
    }

    protected function configure()
    {
        parent::configure();
        $this->setAliasesWithPrefix(['ci:' . $this->getBaseName()]);
    }

    protected function composerCommand(): string
    {
        return 'validate';
    }
}