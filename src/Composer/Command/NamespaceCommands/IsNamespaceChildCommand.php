<?php
declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\NamespaceCommands;

use Symfony\Component\Console\Input\InputInterface;

/**
 *
 */
trait IsNamespaceChildCommand
{

    protected function configure()
    {
        parent::configure();
        $this->configureNamespaceCommandOption();
    }

    protected function populateInputWithNamespaceCommand(InputInterface $input)
    {
//        $input->setOption(self::FIX_ARGUMENT, true);
    }

    /**
     * @param InputInterface $input
     * @param $namespace
     * @return bool
     */
    protected function isRunFromNamespace(InputInterface $input, $namespace = null): bool
    {
        return $input->getArgument('command') == $this->withPrefix($namespace);
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