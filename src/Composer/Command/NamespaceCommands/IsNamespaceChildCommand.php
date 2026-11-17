<?php
declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\NamespaceCommands;

use Symfony\Component\Console\Input\InputInterface;

/**
 *
 */
trait IsNamespaceChildCommand
{

    protected function configure(): void
    {
        parent::configure();
        $this->configureNamespaceCommandOption();
    }

    /**
     * @param InputInterface $input
     * @param $namespace
     * @return bool
     */
    protected function isRunFromNamespace(InputInterface $input, string $namespace): bool
    {
        return $this->getNamespaceContext() === $namespace
            || $input->getArgument('command') == $this->withPrefix($namespace);
    }

    protected function configureNamespaceCommandOption()
    {
//        $this->addOption(
//            FixCommand::FIX_ARGUMENT,
//            null,
//            InputOption::VALUE_OPTIONAL
//        );
    }

    /**
     * @param $namespaces
     * @return void
     */
    protected function setAliasesWithNamespacePrefix($namespaces = [])
    {
        $aliases = [];
        foreach ($namespaces as $namespace) {
            $aliases[] = $namespace . ':' . $this->getBaseName();
        }
        $this->setAliasesWithPrefix($aliases);
    }
}