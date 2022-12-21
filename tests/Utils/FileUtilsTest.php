<?php

namespace San\Crud\Tests\Utils;

use San\Crud\Tests\TestCase;
use San\Crud\Utils\FileUtils;

class FileUtilsTest extends TestCase {

    public function testGetFiles() {
        $files = FileUtils::getFiles(__DIR__);
        $this->assertNotEmpty($files);
        $this->assertContains(__FILE__, $files);
    }

    public function testWriteFile() {
        if (file_exists(__DIR__ . '/test.txt')) {
            unlink(__DIR__ . '/test.txt');
        }

        $this->assertFileDoesNotExist(__DIR__ . '/test.txt');
        FileUtils::writeFile(__DIR__ . '/test.txt', 'test');
        $this->assertFileExists(__DIR__ . '/test.txt');
    }
}
