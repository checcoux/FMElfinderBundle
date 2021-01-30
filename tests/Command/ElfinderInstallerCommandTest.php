<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('elfinder:install');
        $commandTester = new CommandTester($command);
        $commandTester->execute();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('elFinder assets successfully installed ', $output);
    }

    public function testExecuteWithDocroot()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('elfinder:install');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
          '--docroot' => 'web'
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('web/bundles/fmelfinder', $output);

    }
}
