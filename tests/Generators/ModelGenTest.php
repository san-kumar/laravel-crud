<?php

namespace San\Crud\Tests\Generators;

use San\Crud\Generators\ModelGen;
use San\Crud\Tests\TestCase;

class ModelGenTest extends TestCase {

    public function testGetHasMany() {
        $modelGen = new ModelGen(['tickets', 'leads']);
        $hasMany = $modelGen->getHasMany();
        $this->assertStringContainsString("\$this->hasMany(Ticket::class", $hasMany);
    }

    public function testGetCasts() {
        //check if database drive is sqlite
        if (config('database.default') == 'sqlite') {
            //sqlite does not support json type
            $this->assertTrue(TRUE);
        } else {
            $modelGen = new ModelGen(['tickets']);
            $casts = $modelGen->getCasts();
            $this->assertStringContainsString("'extra_data' => AsArrayObject::class", $casts);
        }
    }

    public function testGetFillable() {
        $modelGen = new ModelGen(['tickets']);
        $fillable = $modelGen->getFillable();
        $this->assertStringContainsString("subject", $fillable);

        $modelGen = new ModelGen(['leads', 'tickets']);
        $fillable = $modelGen->getFillable();
        $this->assertStringNotContainsString("lead_id,", $fillable);
    }

    public function testGetModelName() {
        $modelGen = new ModelGen(['tickets']);
        $name = $modelGen->getModelName();
        $this->assertEquals("Ticket", $name);
    }

    public function testGetBelongsTo() {
        $modelGen = new ModelGen(['tickets']);
        $belongsTo = $modelGen->getBelongsTo();
        $this->assertStringContainsString("\$this->belongsTo(Lead::class)", $belongsTo);
    }

    public function testGetSoftDelete() {
        $modelGen = new ModelGen(['leads']);
        $softDelete = $modelGen->getSoftDelete();
        $this->assertStringContainsString("SoftDeletes;", $softDelete);

        $modelGen = new ModelGen(['tickets']);
        $softDelete = $modelGen->getSoftDelete();
        $this->assertStringNotContainsString("SoftDeletes;", $softDelete);
    }

    public function testGetUsesModels() {
        $modelGen = new ModelGen(['tickets']);
        $usesModels = $modelGen->getUsesModels();
        $this->assertStringContainsString("use App\Models\Ticket", $usesModels);
    }
}
