<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\GuineaPig;
use App\Models\Category;
use App\Models\Adoption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_apply_for_adoption()
    {
        $user = User::factory()->create(['role' => 'client']);
        $category = Category::factory()->create();
        $pig = GuineaPig::factory()->create(['category_id' => $category->id, 'status' => 'available']);

        $response = $this->actingAs($user)->post(route('adoptions.store', $pig), [
            'notes' => 'I love pigs',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('adoptions', [
            'user_id' => $user->id,
            'guinea_pig_id' => $pig->id,
            'notes' => 'I love pigs',
        ]);
    }

    public function test_admin_can_access_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $client = User::factory()->create(['role' => 'client']);

        $response = $this->actingAs($admin)->get(route('admin.adoptions.index'));
        $response->assertStatus(200);

        $response = $this->actingAs($client)->get(route('admin.adoptions.index'));
        $response->assertStatus(403);
    }

    public function test_guinea_pig_status_change()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $pig = GuineaPig::factory()->create(['category_id' => $category->id, 'status' => 'available']);
        $user = User::factory()->create();
        $adoption = Adoption::factory()->create(['user_id' => $user->id, 'guinea_pig_id' => $pig->id, 'status' => 'pending']);

        $response = $this->actingAs($admin)->post(route('admin.adoptions.updateStatus', $adoption), [
            'status' => 'approved',
        ]);

        $this->assertDatabaseHas('adoptions', ['id' => $adoption->id, 'status' => 'approved']);
        $this->assertDatabaseHas('guinea_pigs', ['id' => $pig->id, 'status' => 'adopted']);
    }

    public function test_hotel_booking_requires_date()
    {
        $user = User::factory()->create(['role' => 'client']);

        $response = $this->actingAs($user)->post(route('hotel.store'), [
            'guinea_pig_name' => 'Fluffy',
            // Missing dates
        ]);

        $response->assertSessionHasErrors(['start_date', 'end_date']);
    }

    public function test_api_returns_guinea_pigs_list()
    {
        $category = Category::factory()->create();
        GuineaPig::factory()->count(3)->create(['category_id' => $category->id, 'status' => 'available']);

        $response = $this->get(route('adoptions.index'));

        $response->assertStatus(200);
        $response->assertViewHas('guineaPigs');
    }
}
