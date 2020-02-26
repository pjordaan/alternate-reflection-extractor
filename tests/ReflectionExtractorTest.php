<?php

namespace Pjordaan\AlternateReflectionExtractor;

use PHPUnit\Framework\TestCase;
use Pjordaan\AlternateReflectionExtractor\Mock\MockClass;

class ReflectionExtractorTest extends TestCase
{
    public function testMethod()
    {
        $item = new ReflectionExtractor();
        $this->assertEquals(
            ['publicValue', 'setterOnly', 'getterOnly'],
            $item->getProperties(MockClass::class)
        );
        $this->assertEquals(true, $item->isReadable(MockClass::class, 'publicValue'));
        $this->assertEquals(true, $item->isWritable(MockClass::class, 'publicValue'));
        $this->assertEquals(false, $item->isReadable(MockClass::class, 'protectedValue'));
        $this->assertEquals(false, $item->isWritable(MockClass::class, 'protectedValue'));
        $this->assertEquals(false, $item->isReadable(MockClass::class, 'privateValue'));
        $this->assertEquals(false, $item->isWritable(MockClass::class, 'privateValue'));
        $this->assertEquals(false, $item->isReadable(MockClass::class, 'setterOnly'));
        $this->assertEquals(true, $item->isWritable(MockClass::class, 'setterOnly'));
        $this->assertEquals(true, $item->isReadable(MockClass::class, 'getterOnly'));
        $this->assertEquals(false, $item->isWritable(MockClass::class, 'getterOnly'));
        $this->assertEquals(false, $item->isReadable(MockClass::class, 'missing'));
        $this->assertEquals(false, $item->isWritable(MockClass::class, 'missing'));
    }

    public function testMethodProtected()
    {
        $item = new ReflectionExtractor(null, null, null, true, ReflectionExtractor::ALLOW_PROTECTED|ReflectionExtractor::ALLOW_PUBLIC);
        $this->assertEquals(
            ['publicValue', 'protectedValue', 'setterOnly', 'getterOnly'],
            $item->getProperties(MockClass::class)
        );
        $this->assertEquals(true, $item->isReadable(MockClass::class, 'publicValue'));
        $this->assertEquals(true, $item->isWritable(MockClass::class, 'publicValue'));
        $this->assertEquals(true, $item->isReadable(MockClass::class, 'protectedValue'));
        $this->assertEquals(true, $item->isWritable(MockClass::class, 'protectedValue'));
        $this->assertEquals(false, $item->isReadable(MockClass::class, 'privateValue'));
        $this->assertEquals(false, $item->isWritable(MockClass::class, 'privateValue'));
        $this->assertEquals(true, $item->isReadable(MockClass::class, 'setterOnly'));
        $this->assertEquals(true, $item->isWritable(MockClass::class, 'setterOnly'));
        $this->assertEquals(true, $item->isReadable(MockClass::class, 'getterOnly'));
        $this->assertEquals(true, $item->isWritable(MockClass::class, 'getterOnly'));
        $this->assertEquals(false, $item->isReadable(MockClass::class, 'missing'));
        $this->assertEquals(false, $item->isWritable(MockClass::class, 'missing'));
    }

    public function testMethodPrivate()
    {
        $item = new ReflectionExtractor(null, null, null, true, ReflectionExtractor::ALLOW_PROTECTED|ReflectionExtractor::ALLOW_PUBLIC|ReflectionExtractor::ALLOW_PRIVATE);
        $this->assertEquals(
            ['publicValue', 'protectedValue', 'privateValue', 'setterOnly', 'getterOnly'],
            $item->getProperties(MockClass::class)
        );
        $this->assertEquals(true, $item->isReadable(MockClass::class, 'publicValue'));
        $this->assertEquals(true, $item->isWritable(MockClass::class, 'publicValue'));
        $this->assertEquals(true, $item->isReadable(MockClass::class, 'protectedValue'));
        $this->assertEquals(true, $item->isWritable(MockClass::class, 'protectedValue'));
        $this->assertEquals(true, $item->isReadable(MockClass::class, 'privateValue'));
        $this->assertEquals(true, $item->isWritable(MockClass::class, 'privateValue'));
        $this->assertEquals(true, $item->isReadable(MockClass::class, 'setterOnly'));
        $this->assertEquals(true, $item->isWritable(MockClass::class, 'setterOnly'));
        $this->assertEquals(true, $item->isReadable(MockClass::class, 'getterOnly'));
        $this->assertEquals(true, $item->isWritable(MockClass::class, 'getterOnly'));
        $this->assertEquals(false, $item->isReadable(MockClass::class, 'missing'));
        $this->assertEquals(false, $item->isWritable(MockClass::class, 'missing'));
    }
}
