<?php

namespace Tests\Feature;

use Tests\TestCase;

class PageTest extends TestCase
{
    public function test_landing_page_returns_a_successful_response(): void
    {
        $this->get(route('beranda'))->assertOk();
    }

    public function test_barang_page_returns_a_successful_response(): void
    {
        $this->get(route('barang'))->assertOk();
    }

    public function test_layanan_page_returns_a_successful_response(): void
    {
        $this->get(route('layanan'))->assertOk();
    }

    public function test_testimoni_page_returns_a_successful_response(): void
    {
        $this->get(route('testimoni'))->assertOk();
    }

    public function test_layanan_page_lists_every_service(): void
    {
        $response = $this->get(route('layanan'));

        foreach (config('netware.services') as $service) {
            $response->assertSee($service['name']);
        }
    }

    public function test_layanan_page_shows_operational_hours(): void
    {
        $this->get(route('layanan'))
            ->assertSee(config('netware.hours.open'))
            ->assertSee(config('netware.hours.close'));
    }

    public function test_layanan_page_links_to_whatsapp_consultation(): void
    {
        $this->get(route('layanan'))
            ->assertSee('https://wa.me/'.config('netware.whatsapp'), escape: false);
    }

    public function test_navigation_marks_the_current_page(): void
    {
        $this->get(route('layanan'))
            ->assertSee('aria-current="page"', escape: false);
    }
}
