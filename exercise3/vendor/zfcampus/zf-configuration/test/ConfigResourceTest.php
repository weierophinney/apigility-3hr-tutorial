<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZFTest\Configuration;

use PHPUnit_Framework_TestCase as TestCase;
use stdClass;
use Zend\Config\Writer\PhpArray;
use ZF\Configuration\ConfigResource;

class ConfigResourceTest extends TestCase
{
    public $file;
    /** @var ConfigResource */
    protected $configResource;
    protected $writer;

    public function setUp()
    {
        $this->removeScaffold();
        $this->file = tempnam(sys_get_temp_dir(), 'zfconfig');
        file_put_contents($this->file, '<' . "?php\nreturn array();");

        $this->writer = new TestAsset\ConfigWriter();
        $this->configResource = new ConfigResource(array(), $this->file, $this->writer);
    }

    public function tearDown()
    {
        $this->removeScaffold();
    }

    public function removeScaffold()
    {
        if ($this->file && file_exists($this->file)) {
            unlink($this->file);
        }
    }

    public function arrayIntersectAssocRecursive($array1, $array2)
    {
        if (!is_array($array1) || !is_array($array2)) {
            if ($array1 === $array2) {
                return $array1;
            }
            return false;
        }

        $commonKeys = array_intersect(array_keys($array1), array_keys($array2));
        $return = array();
        foreach ($commonKeys as $key) {
            $value = $this->arrayIntersectAssocRecursive($array1[$key], $array2[$key]);
            if ($value) {
                $return[$key] = $value;
            }
        }
        return $return;
    }

    public function testCreateNestedKeyValuePairExtractsDotSeparatedKeysAndCreatesNestedStructure()
    {
        $patchValues = array();
        $this->configResource->createNestedKeyValuePair($patchValues, 'foo.bar.baz', 'value');
        $this->assertArrayHasKey('foo', $patchValues);
        $this->assertInternalType('array', $patchValues['foo']);
        $this->assertArrayHasKey('bar', $patchValues['foo']);
        $this->assertInternalType('array', $patchValues['foo']['bar']);
        $this->assertArrayHasKey('baz', $patchValues['foo']['bar']);
        $this->assertEquals('value', $patchValues['foo']['bar']['baz']);

        // ensure second call to createNestedKeyValuePair does not destroy original values
        $this->configResource->createNestedKeyValuePair($patchValues, 'foo.bar.boom', 'value2');
        $this->assertCount(2, $patchValues['foo']['bar']);
    }

    public function testPatchListUpdatesFileWithMergedConfig()
    {
        $config = array(
            'foo' => 'bar',
            'bar' => array(
                'baz' => 'bat',
                'bat' => 'bogus',
            ),
            'baz' => 'not what you think',
        );
        $configResource = new ConfigResource($config, $this->file, $this->writer);

        $patch = array(
            'bar.baz' => 'UPDATED',
            'baz'     => 'what you think',
        );
        $response = $configResource->patch($patch);

        $this->assertEquals($patch, $response);

        $expected = array(
            'bar' => array(
                'baz' => 'UPDATED',
            ),
            'baz' => 'what you think',
        );
        $written = $this->writer->writtenConfig;
        $this->assertEquals($expected, $written);
    }

    public function testTraverseArrayFlattensToDotSeparatedKeyValuePairs()
    {
        $config = array(
            'foo' => 'bar',
            'bar' => array(
                'baz' => 'bat',
                'bat' => 'bogus',
            ),
            'baz' => 'not what you think',
        );
        $expected = array(
            'foo'     => 'bar',
            'bar.baz' => 'bat',
            'bar.bat' => 'bogus',
            'baz'     => 'not what you think',
        );

        $this->assertEquals($expected, $this->configResource->traverseArray($config));
    }

    public function testFetchFlattensComposedConfiguration()
    {
        $config = array(
            'foo' => 'bar',
            'bar' => array(
                'baz' => 'bat',
                'bat' => 'bogus',
            ),
            'baz' => 'not what you think',
        );
        $expected = array(
            'foo'     => 'bar',
            'bar.baz' => 'bat',
            'bar.bat' => 'bogus',
            'baz'     => 'not what you think',
        );
        $configResource = new ConfigResource($config, $this->file, $this->writer);

        $this->assertEquals($expected, $configResource->fetch());
    }

    public function testFetchWithTreeFlagSetToTrueReturnsConfigurationUnmodified()
    {
        $config = array(
            'foo' => 'bar',
            'bar' => array(
                'baz' => 'bat',
                'bat' => 'bogus',
            ),
            'baz' => 'not what you think',
        );
        $configResource = new ConfigResource($config, $this->file, $this->writer);
        $this->assertEquals($config, $configResource->fetch(true));
    }

    public function testPatchWithTreeFlagSetToTruePerformsArrayMergeAndReturnsConfig()
    {
        $config = array(
            'foo' => 'bar',
            'bar' => array(
                'baz' => 'bat',
                'bat' => 'bogus',
            ),
            'baz' => 'not what you think',
        );
        $configResource = new ConfigResource($config, $this->file, $this->writer);

        $patch = array(
            'bar' => array(
                'baz' => 'UPDATED',
            ),
            'baz' => 'what you think',
        );
        $response = $configResource->patch($patch, true);

        $this->assertEquals($patch, $response);

        $expected = array(
            'bar' => array(
                'baz' => 'UPDATED',
            ),
            'baz' => 'what you think',
        );
        $written = $this->writer->writtenConfig;
        $this->assertEquals($expected, $written);
    }

    public function replaceKeyPairs()
    {
        return array(
            'scalar-top-level' => array('top', 'updated', array('top' => 'updated')),
            'overwrite-hash' => array('sub', 'updated', array('sub' => 'updated')),
            'nested-scalar' => array('sub.level', 'updated', array('sub' => array('level' => 'updated'))),
            'nested-list' => array('sub.list', array('three', 'four'), array('sub' => array('list' => array('three', 'four')))),
            'nested-hash' => array('sub.hash.two', 'updated', array('sub' => array('hash' => array('two' => 'updated')))),
            'overwrite-nested-null' => array('sub.null', 'updated', array('sub' => array('null' => 'updated'))),
            'overwrite-nested-object' => array('sub.object', 'updated', array('sub' => array('object' => 'updated'))),
        );
    }

    /**
     * @dataProvider replaceKeyPairs
     */
    public function testReplaceKey($key, $value, $expected)
    {
        $config = array(
            'top' => 'level',
            'sub' => array(
                'level' => 2,
                'list'  => array(
                    'one',
                    'two',
                ),
                'hash' => array(
                    'one' => 1,
                    'two' => 2,
                ),
                'null' => null,
                'object' => new stdClass(),
            ),
        );

        $updated = $this->configResource->replaceKey($key, $value, $config);
        $intersection = $this->arrayIntersectAssocRecursive($expected, $updated);
        $this->assertEquals($expected, $intersection);
        $this->assertEquals(2, count($updated));
    }

    public function deleteKeyPairs()
    {
        return array(
            'scalar-top-level' => array('top', array('sub' => array(
                'level' => 2,
                'list'  => array(
                    'one',
                    'two',
                ),
                'hash' => array(
                    'one' => 1,
                    'two' => 2,
                ),
            ))),
            'delete-hash' => array('sub', array('top' => 'level')),
            'delete-nested-via-arrays' => array(array('sub', 'level'), array(
                'top' => 'level',
                'sub' => array(
                    'list'  => array(
                        'one',
                        'two',
                    ),
                    'hash' => array(
                        'one' => 1,
                        'two' => 2,
                    ),
                ),
            )),
            'delete-nested-via-dot-separated-values' => array('sub.level', array(
                'top' => 'level',
                'sub' => array(
                    'list'  => array(
                        'one',
                        'two',
                    ),
                    'hash' => array(
                        'one' => 1,
                        'two' => 2,
                    ),
                ),
            )),
            'delete-nested-array' => array('sub.list', array(
                'top' => 'level',
                'sub' => array(
                    'level' => 2,
                    'hash' => array(
                        'one' => 1,
                        'two' => 2,
                    ),
                ),
            )),
        );
    }

    /**
     * @dataProvider deleteKeyPairs
     */
    public function testDeleteKey($key, array $expected)
    {
        $config = array(
            'top' => 'level',
            'sub' => array(
                'level' => 2,
                'list'  => array(
                    'one',
                    'two',
                ),
                'hash' => array(
                    'one' => 1,
                    'two' => 2,
                ),
            ),
        );
        $writer = new PhpArray();
        $writer->toFile($this->file, $config);
        // Ensure the writer has written to the file!
        $this->assertEquals($config, include $this->file);

        // Create config resource, and delete a key
        $configResource = new ConfigResource($config, $this->file, $writer);
        $test = $configResource->deleteKey($key);

        // Verify what was returned was what we expected
        $this->assertEquals($expected, $test);

        // Verify the file contains what we expect
        $this->assertEquals($expected, include $this->file);
    }

    public function testDeleteNestedKeyShouldAssignArrayToParent()
    {
        $config = array(
            'top' => 'level',
            'sub' => array(
                'sub2'  => array(
                    'sub3' => array(
                        'two',
                    ),
                ),
            ),
        );
        $writer = new PhpArray();
        $writer->toFile($this->file, $config);
        // Ensure the writer has written to the file!
        $this->assertEquals($config, include $this->file);

        // Create config resource, and delete a key
        $configResource = new ConfigResource($config, $this->file, $writer);
        $test = $configResource->deleteKey('sub.sub2.sub3');

        // Verify what was returned was what we expected
        $expected = array(
            'top' => 'level',
            'sub' => array(
                'sub2' => array(),
            ),
        );
        $this->assertEquals($expected, $test);
        $this->assertSame($expected['sub']['sub2'], $test['sub']['sub2']);

        // Verify the file contains what we expect
        $test = include $this->file;
        $this->assertEquals($expected, $test);
        $this->assertSame($expected['sub']['sub2'], $test['sub']['sub2']);
    }

    public function testDeleteNonexistentKeyShouldDoNothing()
    {
        $config = array();
        $writer = new PhpArray();
        $writer->toFile($this->file, $config);
        // Ensure the writer has written to the file!
        $this->assertEquals($config, include $this->file);

        // Create config resource, and delete a key
        $configResource = new ConfigResource($config, $this->file, $writer);
        $test = $configResource->deleteKey('sub.sub2.sub3');

        // Verify what was returned was what we expected
        $expected = array();
        $this->assertEquals($expected, $test);

        // Verify the file contains what we expect
        $test = include $this->file;
        $this->assertEquals($expected, $test);
    }
}
