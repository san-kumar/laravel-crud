<?php

namespace San\Crud\Tests\Utils;

use San\Crud\Tests\TestCase;
use San\Crud\Utils\TextUtils;

class TextUtilsTest extends TestCase {

    public function testReplaceBlanks() {
        $str = 'Hello /*_name_*/';
        $this->assertEquals('Hello John', TextUtils::replaceBlanks($str, ['name' => 'John']));

        $str = 'Hello _name_';
        $this->assertEquals('Hello John', TextUtils::replaceBlanks($str, ['name' => 'John']));
    }

    public function testArrayExport() {
        $arr = ['name', 'age'];
        $this->assertEquals('["name" => "Name", "age" => "Age"]', TextUtils::arrayExport($arr));
    }
}
