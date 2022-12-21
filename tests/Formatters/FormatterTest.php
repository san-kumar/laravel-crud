<?php

namespace San\Crud\Tests\Formatters;

use San\Crud\Formatters\Formatter;
use San\Crud\Tests\TestCase;

class FormatterTest extends TestCase {

    public function testFixSoftDelete() {
        $str = '//@softdelete
        $this->assertSoftDeleted($table, $data);
        //@endsoftdelete';

        $formatter = new Formatter(['tickets']);
        $result = $formatter->fixSoftDelete($str);
        $this->assertStringNotContainsString('@softdelete', $result);

        $formatter = new Formatter(['leads']);
        $result = $formatter->fixSoftDelete($str);
        $this->assertStringContainsString('@softdelete', $result);
    }
}
