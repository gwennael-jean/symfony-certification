<?php

namespace App\DataFixtures;

use App\Kernel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Description of AbstractFixture
 *
 * @author gjean
 */
abstract class AbstractFixture extends Fixture implements ContainerAwareInterface, FixtureGroupInterface
{
    protected ContainerInterface $container;

    protected Filesystem $filesystem;

    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }

    public static function getGroups(): array
    {
        return ['initial'];
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    protected function getData()
    {
        $data = $this->container->getParameter('fixture');
        $data['data_folder'] = $data['data_folder'] ?? 'data';

        return Yaml::parse(file_get_contents(implode(DIRECTORY_SEPARATOR, [
            $this->getAssetsPath(),
            $data['data_folder'],
            trim($this->getYamlPath())
        ])));
    }

    protected function getReferenceEntity($fixture, $id)
    {
        return $this->getReference($this->getReferencePath($fixture, $id));
    }

    protected function getReferencePath($fixture, $id)
    {
        return $fixture . $id;
    }

    protected function getAssetsPath(): string
    {
        return $this->getKernel()->getProjectDir() . '/assets/fixtures';
    }

    protected function getKernel(): ?KernelInterface
    {
        $kernel = $this->container->get('kernel');
        return $kernel instanceof KernelInterface ? $kernel : null;
    }

    protected abstract function getYamlPath(): string;
}
