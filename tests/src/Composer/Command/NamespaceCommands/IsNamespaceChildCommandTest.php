<?php

namespace Bytic\Phpqa\Tests\src\Composer\Command\NamespaceCommands;

use Bytic\Phpqa\Composer\Command\Ci\CiCommand;
use Bytic\Phpqa\Composer\Command\CsFixer\CsFixerCommand;
use Bytic\Phpqa\Composer\Command\Fix\FixCommand;
use Bytic\Phpqa\PHPUnit\TestCase;
use Composer\Console\Application;
use Symfony\Component\Console\Tester\ApplicationTester;
use Symfony\Component\Console\Tester\CommandTester;

/**
 *
 */
class IsNamespaceChildCommandTest extends TestCase
{
    public function test_doExecute()
    {
        $fixCommand = new FixCommand();
        $ciCommand = new CiCommand();

        $csFixerCommand = $this->mockery(CsFixerCommand::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $csFixerCommand->shouldReceive('doExecuteProcess')
            ->twice()
            ->andReturn(0);
        $csFixerCommand->__construct();

        $application = new Application();
        $application->setAutoExit(false);
        $application->addCommands([$fixCommand, $ciCommand, $csFixerCommand]);

//        $tester = new ApplicationTester($application);

        $commandTester = new CommandTester($fixCommand);
        $commandTester->execute([]);
        $output = $commandTester->getDisplay();
        static::assertStringContainsString('bytic/phpqatools/vendor/bin/php-cs-fixer fix in', $output);

        $commandTester = new CommandTester($ciCommand);
        $commandTester->execute([]);
        $output = $commandTester->getDisplay();
        static::assertStringContainsString('bytic/phpqatools/vendor/bin/php-cs-fixer fix -v --dry-run --using-cache no --diff', $output);
    }

}