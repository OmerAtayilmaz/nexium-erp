<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\PageCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PageCategoryController
 */
final class PageCategoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $pageCategories = PageCategory::factory()->count(3)->create();

        $response = $this->get(route('page-categories.index'));
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PageCategoryController::class,
            'store',
            \App\Http\Requests\PageCategoryStoreRequest::class
        );
    }

    #[Test]
    public function store_behaves_as_expected(): void
    {
        $title = $this->faker->sentence(4);
        $description = $this->faker->text();

        $response = $this->post(route('page-categories.store'), [
            'title' => $title,
            'description' => $description,
        ]);
    }
}
