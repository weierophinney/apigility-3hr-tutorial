<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Configuration;

use Zend\Config\Writer\WriterInterface as ConfigWriter;

class ResourceFactory
{
    /**
     * @var ModuleUtils
     */
    protected $modules;

    /**
     * @var ConfigWriter
     */
    protected $writer;

    /**
     * @var ConfigResource[]
     */
    protected $resources = array();

    /**
     * @param  ModuleManager $modules
     * @param  ConfigWriter $writer
     */
    public function __construct(ModuleUtils $modules, ConfigWriter $writer)
    {
        $this->modules = $modules;
        $this->writer  = $writer;
    }

    /**
     * Retrieve a ConfigResource for a given module
     *
     * @param  string $moduleName
     * @return ConfigResource
     */
    public function factory($moduleName)
    {
        $moduleName = $this->normalizeModuleName($moduleName);
        if (isset($this->resources[$moduleName])) {
            return $this->resources[$moduleName];
        }

        $moduleConfigPath = $this->modules->getModuleConfigPath($moduleName);
        $config           = include($moduleConfigPath);

        $this->resources[$moduleName] = new ConfigResource($config, $moduleConfigPath, $this->writer);
        return $this->resources[$moduleName];
    }

    /**
     * @param array $config
     * @param $filePath
     * @return ConfigResource
     */
    public function createConfigResource(array $config, $filePath)
    {
        return new ConfigResource($config, $filePath, $this->writer);
    }

    protected function normalizeModuleName($moduleName)
    {
        return str_replace(array('.', '/'), '\\', $moduleName);
    }
}
