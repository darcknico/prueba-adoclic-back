<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\{Entity,Category};

class EntitiesTest extends TestCase
{
    /**
     * Insert and save a Entity information, check data integration if is saved
     */
    public function test_save_entity(): void
    {
        $entity = new Entity;
        $model = Entity::updateOrCreate(
            [
                'api' => "test",
            ],
            [
                'description' => "test",
                'link' => "test",
                'category_id' => 3,
            ]
        );
        $this->assertTrue($model != null);
        $model->delete();
    }
}
