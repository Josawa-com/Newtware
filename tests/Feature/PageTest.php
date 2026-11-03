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

    public function test_whatsapp_number_is_never_rendered_as_visible_text(): void
    {
        // The number lives in wa.me links on purpose; it must not be printed on the page.
        foreach ([route('beranda'), route('layanan')] as $url) {
            $response = $this->get($url);

            $response->assertOk();
            $response->assertDontSee('+62 851-9124-9364');
            $response->assertDontSee('851-9124-9364');
        }
    }

    public function test_navigation_marks_the_current_page(): void
    {
        $this->get(route('layanan'))
            ->assertSee('aria-current="page"', escape: false);
    }

    public function test_site_defaults_to_indonesian(): void
    {
        $this->get(route('beranda'))
            ->assertSee('lang="id"', escape: false)
            ->assertSee('Perangkat bermasalah?');
    }

    public function test_language_can_be_switched_to_english(): void
    {
        $this->post(route('locale.switch'), ['locale' => 'en'])->assertRedirect();

        $this->get(route('beranda'))
            ->assertSee('lang="en"', escape: false)
            ->assertSee('Device acting up?')
            ->assertSee('Home');
    }

    public function test_language_switch_rejects_unsupported_locales(): void
    {
        $this->post(route('locale.switch'), ['locale' => 'fr'])
            ->assertSessionHasErrors('locale');

        $this->get(route('beranda'))->assertSee('lang="id"', escape: false);
    }

    public function test_theme_toggle_is_present(): void
    {
        $this->get(route('beranda'))
            ->assertSee('data-theme-toggle', escape: false)
            ->assertSee('data-nav-item', escape: false);
    }
}
