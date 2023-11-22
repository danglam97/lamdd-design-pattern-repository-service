<?php

namespace DesignPattern\LaravelMakeRepositoryService\Generators;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class ServiceInterfaceGenerator
 * @package DesignPattern\LaravelMakeRepositoryService\Generators
 */
class ServiceInterfaceGenerator extends Generator
{

    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'service/interface';

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace(): string
    {
        return parent::getRootNamespace() . $this->getConfigGeneratorClassPath($this->getPathConfigNode());
    }

    /**
     * Get generator path config node.
     *
     * @return string
     */
    public function getPathConfigNode(): string
    {
        return 'service_interfaces';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->getBasePath() . '/' . $this->getConfigGeneratorClassPath($this->getPathConfigNode(), true) . '/' . $this->getName() . 'ServiceInterface.php';
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath(): string
    {
        return Config::get('repository.generator.basePath', App::path());
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements(): array
    {
        return array_merge(parent::getReplacements(), []);
    }
}
