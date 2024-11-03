<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_is_accessible()
    {
        $response = $this->get(route('contactUs'));
        $response->assertStatus(200);
    }

    public function test_store_contact_message()
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Yakup',
            'email' => 'yakup@gmail.com',
            'subject' => 'Penambahan Fitur',
            'message' => 'Tambahkan fitur AI!',
        ]);

        $response->assertRedirect(route('carikost'));
        $response->assertSessionHas('success', 'Your message has been sent successfully!');
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Yakup',
            'email' => 'yakup@gmail.com',
            'subject' => 'Penambahan Fitur',
            'message' => 'Tambahkan fitur AI!',
        ]);
    }
}
