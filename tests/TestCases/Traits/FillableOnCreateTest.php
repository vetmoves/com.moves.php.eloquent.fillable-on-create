<?php

namespace Tests\TestCases\Traits;

use Tests\Models\FillableOnCreateModel;
use Tests\TestCases\TestCase;

class FillableOnCreateTest extends TestCase
{
    public function testGetFillableOnCreate()
    {
        $model = new FillableOnCreateModel();

        $this->assertNull($model->getFillableOnCreate());

        $model->fillableOnCreate = ['a', 'b', 'c'];

        $this->assertIsArray($model->getFillableOnCreate());
        $this->assertCount(3, $model->getFillableOnCreate());
        $this->assertEquals(['a', 'b', 'c'], $model->getFillableOnCreate());
    }

    public function testGetFillableIncludesFillableOnCreateWhenNotExists()
    {
        $model = new FillableOnCreateModel();

        $this->assertIsArray($model->getFillable());
        $this->assertEmpty($model->getFillable());

        $model->fillable = ['a', 'b', 'c'];

        $this->assertIsArray($model->getFillable());
        $this->assertCount(3, $model->getFillable());
        $this->assertEquals(['a', 'b', 'c'], $model->getFillable());

        $model->fillableOnCreate = ['d', 'e', 'f'];

        $this->assertIsArray($model->getFillable());
        $this->assertCount(6, $model->getFillable());
        $this->assertEquals(['a', 'b', 'c', 'd', 'e', 'f'], $model->getFillable());
    }

    public function testGetFillableNotIncludesFillableOnCreateWhenExists()
    {
        $model = new FillableOnCreateModel();

        $model->fillable = ['a', 'b', 'c'];
        $model->fillableOnCreate = ['d', 'e', 'f'];

        $model->exists = true;

        $this->assertIsArray($model->getFillable());
        $this->assertCount(3, $model->getFillable());
        $this->assertEquals(['a', 'b', 'c'], $model->getFillable());
    }

    public function testFillableOnCreateEnforcedWhenNotExists()
    {
        $model = new FillableOnCreateModel();

        $model->fillable = ['a', 'b', 'c'];
        $model->fillableOnCreate = ['d', 'e', 'f'];

        $model->fill([
            'a' => 1,
            'b' => 2,
            'c' => 3,
            'd' => 4,
            'e' => 5,
            'f' => 6,
        ]);

        $this->assertEquals([
            'a' => 1,
            'b' => 2,
            'c' => 3,
            'd' => 4,
            'e' => 5,
            'f' => 6,
        ], $model->getAttributes());

        $model->exists = true;

        $model->fill([
            'a' => 10,
            'b' => 20,
            'c' => 30,
        ]);

        $model->fill([
            'd' => 40,
            'e' => 50,
            'f' => 60,
        ]);

        $this->assertEquals([
            'a' => 10,
            'b' => 20,
            'c' => 30,
            'd' => 4,
            'e' => 5,
            'f' => 6,
        ], $model->getAttributes());
    }

    public function testGetGuardedOnCreate()
    {
        $model = new FillableOnCreateModel();

        $this->assertNull($model->getGuardedOnCreate());

        $model->guardedOnCreate = ['a', 'b', 'c'];

        $this->assertIsArray($model->getGuardedOnCreate());
        $this->assertCount(3, $model->getGuardedOnCreate());
        $this->assertEquals(['a', 'b', 'c'], $model->getGuardedOnCreate());
    }

    public function testGetGuardedIncludesGuardedOnCreateWhenNotExists()
    {
        $model = new FillableOnCreateModel();

        $this->assertIsArray($model->getGuarded());
        $this->assertEmpty($model->getGuarded());

        $model->guarded = ['a', 'b', 'c'];

        $this->assertIsArray($model->getGuarded());
        $this->assertCount(3, $model->getGuarded());
        $this->assertEquals(['a', 'b', 'c'], $model->getGuarded());

        $model->guardedOnCreate = ['d', 'e', 'f'];

        $this->assertIsArray($model->getGuarded());
        $this->assertCount(6, $model->getGuarded());
        $this->assertEquals(['a', 'b', 'c', 'd', 'e', 'f'], $model->getGuarded());
    }

    public function testGetGuardedNotIncludesGuardedOnCreateWhenExists()
    {
        $model = new FillableOnCreateModel();

        $model->guarded = ['a', 'b', 'c'];
        $model->guardedOnCreate = ['d', 'e', 'f'];

        $model->exists = true;

        $this->assertIsArray($model->getGuarded());
        $this->assertCount(3, $model->getGuarded());
        $this->assertEquals(['a', 'b', 'c'], $model->getGuarded());
    }
}
