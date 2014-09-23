<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Configuration;

use stdClass;
use Traversable;
use Zend\Config\Writer\WriterInterface as ConfigWriter;
use Zend\Stdlib\ArrayUtils;

class ConfigResource
{
    /**
     * @var array
     */
    protected $config;

    /**
     * File to which to write configuration
     *
     * @var string
     */
    protected $fileName;

    /**
     * Whether or not OpCache is enabled
     *
     * @var bool
     */
    protected $opcacheEnabled = false;

    /**
     * @var ConfigWriter
     */
    protected $writer;

    /**
     * @param array $config
     */
    public function __construct(array $config, $fileName, ConfigWriter $writer)
    {
        $this->opcacheEnabled = function_exists('opcache_invalidate') && ini_get('opcache.enable');

        $this->config   = $config;
        $this->fileName = $fileName;
        $this->writer   = $writer;
    }

    /**
     * Allow patching one or more key/value pairs
     *
     * Expects data to be in the form of key/value pairs
     *
     * @param  array|stdClass|Traversable $data
     * @return array
     */
    public function patch($data, $tree = false)
    {
        if ($data instanceof Traversable) {
            $data = ArrayUtils::iteratorToArray($data);
        }

        if ($data instanceof stdClass) {
            $data = (array) $data;
        }

        // Update configuration from dot-separated key/value pairs
        if (!$tree) {
            $patchValues = array();
            foreach ($data as $key => $value) {
                $this->createNestedKeyValuePair($patchValues, $key, $value);
            }
        } else {
            $patchValues = $data;
        }

        // Get local config file
        $localConfig = array();
        if (file_exists($this->fileName)) {
            $localConfig = include $this->fileName;
            if (!is_array($localConfig)) {
                $localConfig = array();
            }
        }
        $localConfig = ArrayUtils::merge($localConfig, $patchValues);

        // Write to configuration file
        $this->writer->toFile($this->fileName, $localConfig);
        $this->invalidateCache($this->fileName);

        // Reseed configuration
        $this->config = $localConfig;

        // Return written values
        return $data;
    }

    /**
     * Patch a single (potentially nested) key in the config file
     *
     * @param  string $key
     * @param  mixed $value
     * @return array
     */
    public function patchKey($key, $value)
    {
        // Get local config file
        $config = array();
        if (file_exists($this->fileName)) {
            $config = include $this->fileName;
            if (!is_array($config)) {
                $config = array();
            }
        }
        $config = $this->replaceKey($key, $value, $config);

        // Write to configuration file
        $this->writer->toFile($this->fileName, $config);
        $this->invalidateCache($this->fileName);

        // Reseed configuration
        $this->config = $config;

        // Return written values
        return $config;
    }

    /**
     * Overwrite configuration
     *
     * Used by consumers only; takes the configuration data and writes it verbatim.
     *
     * @param  array $data
     * @return array
     */
    public function overWrite(array $data)
    {
        $this->writer->toFile($this->fileName, $data);
        $this->invalidateCache($this->fileName);

        // Reseed configuration
        $this->config = $data;

        return $data;
    }

    /**
     * Fetch all configuration values
     *
     * Flattens nested configuration to dot-separated key/value pairs and returns them.
     *
     * @param  array $params
     * @return array
     */
    public function fetch($tree = false)
    {
        // If requested as a tree, return as-is
        if ($tree) {
            return $this->config;
        }

        // Collapse to key/value pairs -- meaning to dot-separated nested keys
        return $this->traverseArray($this->config);
    }

    /**
     * Replace a nested key
     *
     * First invocation should pass a dot-separated string representing a
     * nested key.
     *
     * This value will be exploded to a list of keys, and the first element of
     * the list will be compared against the provided configuration array; the
     * method will recurse as necessary in order to replace the key.
     *
     * @param  string|array $keys
     * @param  mixed $value
     * @param  array $config
     * @return array
     */
    public function replaceKey($keys, $value, array $config)
    {
        if (!is_array($keys)) {
            $keys = explode('.', $keys);
        }

        $key = array_shift($keys);

        $haveKeys = (count($keys) > 0) ? true : false;

        // If no more keys, overwrite and return
        if (!$haveKeys) {
            $config[$key] = $value;
            return $config;
        }

        // If key does not exist, or the current value is not an associative
        // array, create nested set and return
        if (!isset($config[$key])
            || !ArrayUtils::isHashTable($config[$key])
        ) {
            $config[$key] = $this->replaceKey($keys, $value, array());
            return $config;
        }

        // Otherwise, recurse through it
        $config[$key] = $this->replaceKey($keys, $value, $config[$key]);
        return $config;
    }

    /**
     * Delete a key from the configuration array
     *
     * $key may be either an array of keys or a dot-separated set of keys.
     *
     * @param  array|string $keys
     * @return array
     */
    public function deleteKey($keys)
    {
        // Get local config file
        $config = array();
        if (file_exists($this->fileName)) {
            $config = include $this->fileName;
            if (!is_array($config)) {
                $config = array();
            }
        }

        if (!is_array($keys)) {
            $keys = explode('.', $keys);
        }

        if (empty($keys)) {
            return $config;
        }

        $this->deleteByKey($config, $keys);
        $this->writer->toFile($this->fileName, $config);
        $this->invalidateCache($this->fileName);

        // Reseed configuration
        $this->config = $config;

        return $config;
    }

    /**
     * Traverse a nested array and flatten to dot-separated key/value pairs
     *
     * @param  array $array
     * @param  string $currentKey Current key, if called recursively
     * @return array
     */
    public function traverseArray(array $array, $currentKey = '')
    {
        $flattened = array();
        foreach ($array as $key => $value) {
            $targetKey = ('' === $currentKey) ? $key : $currentKey . '.' . $key;
            if (is_array($value)) {
                $value = $this->traverseArray($value, $targetKey);
                $flattened = array_merge($flattened, $value);
                continue;
            }

            $flattened[$targetKey] = $value;
        }
        return $flattened;
    }

    /**
     * Create a nested key/value pair from a dot-separated key value pair
     *
     * Extracts the nested pair into the array provided in $patchValues
     *
     * @param array $patchValues
     * @param string $key
     * @param mixed $value
     */
    public function createNestedKeyValuePair(&$patchValues, $key, $value)
    {
        if (!is_array($patchValues)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects the $patchValues argument to be an array; received %s',
                __METHOD__,
                (is_object($patchValues) ? get_class($patchValues) : gettype($patchValues))
            ));
        }

        $this->extractAndSet(explode('.', $key), $value, $patchValues);
    }

    /**
     * Recursively extract keys into a nested array
     *
     * @param array $keys
     * @param string $value
     * @param array $array
     */
    protected function extractAndSet(array $keys, $value, &$array)
    {
        $key = array_shift($keys);
        if (count($keys)) {
            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = array();
            }
            $reference   = &$array[$key];
            $this->extractAndSet($keys, $value, $reference);
            return;
        }
        $array[$key] = $value;
    }

    /**
     * Delete a nested key/value pair in an array
     *
     * @param  array $array
     * @param  array $keys
     */
    protected function deleteByKey(&$array, array $keys)
    {
        $key = array_shift($keys);
        if (!is_array($array) || !array_key_exists($key, $array)) {
            return;
        }

        if (1 > count($keys)) {
            unset($array[$key]);
            return;
        }
        $this->deleteByKey($array[$key], $keys);
    }

    /**
     * Invalidate the opcache for a given file
     *
     * @param  string $filename
     */
    protected function invalidateCache($filename)
    {
        if (!$this->opcacheEnabled) {
            return;
        }

        opcache_invalidate($filename, true);
    }
}
