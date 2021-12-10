<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command;

use Bytic\Phpqa\Composer\DevToolsPlugin;
use Composer\Command\BaseCommand as ComposerBaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 */
abstract class BaseCommand extends ComposerBaseCommand
{
    public function __construct(string $name = null)
    {
        $name = $name ?? $this->withPrefix($this->getBaseName());

        parent::__construct($name);
    }

    final protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $exitCode = 0;

//        if (!$this->overrideDefault) {
            $exitCode = $this->doExecute($input, $output);
//        }

        return $exitCode + $this->getComposer()->getEventDispatcher()->dispatchScript((string) $this->getName());
    }

    /**
     * Called by the execute() command in this BaseCommand class
     */
    abstract protected function doExecute(InputInterface $input, OutputInterface $output): int;

    public function withPrefix(string $name): string
    {
        return $this->getPrefix() . ':' . $name;
    }

    public function getPrefix(): string
    {
        return DevToolsPlugin::$prefix;
    }

    public function setAliasesWithPrefix(iterable $aliases): self
    {
        $list = [];

        foreach ($aliases as $alias) {
            $list[] = $this->withPrefix($alias);
        }
        return parent::setAliases($list);
    }

    public function withBinPath(string $bin): string
    {
        return $this->getBinDir() . DIRECTORY_SEPARATOR . $bin;
    }

    public function getBinDir(): string
    {
        return $this->getComposer()->getConfig()->get('bin-dir');
    }
}