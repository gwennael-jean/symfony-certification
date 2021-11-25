<?php

namespace App\DependencyInjection\CompilerPass;

use App\Service\UserQuizzResult\UserQuizzResultComputerInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class UserQuizzResultPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(UserQuizzResultComputerInterface::class)) {
            return;
        }

        $definition = $container->findDefinition(UserQuizzResultComputerInterface::class);

        $taggedServices = $container->findTaggedServiceIds('app.quizz.user_quizz.result_type');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addUserQuizzResult', [new Reference($id)]);
        }
    }

}
