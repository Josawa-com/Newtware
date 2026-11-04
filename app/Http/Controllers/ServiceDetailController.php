<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

/**
 * Detail page for a single service.
 *
 * The long-form copy (intro paragraphs, scope list, workflow, commitment) lives
 * in lang/{locale}/services.php, keyed by the service slug. The controller only
 * has to resolve the slug and hand everything to the view.
 */
class ServiceDetailController extends Controller
{
    /**
     * All slugs defined in the service detail translations, keyed for the route
     * constraint so an unknown slug becomes a 404 instead of an error page.
     *
     * @return array<int, string>
     */
    public static function slugs(): array
    {
        return array_keys(trans('services'));
    }

    public function show(string $slug): View
    {
        $services = collect(config('netware.services'));
        $index = $services->search(fn (array $service): bool => self::slugFor($service) === $slug);

        abort_if($index === false, 404);

        $locale = app()->getLocale();
        $detail = trans("services.{$slug}");

        // The canonical service entry from config, so the headline matches the
        // card the visitor came from.
        $service = $services[$index];

        $others = $services
            ->reject(fn (array $candidate): bool => self::slugFor($candidate) === $slug)
            ->map(fn (array $candidate): array => [
                'slug' => self::slugFor($candidate),
                'name' => $candidate['name'][$locale] ?? $candidate['name']['id'],
                'description' => $candidate['description'][$locale] ?? $candidate['description']['id'],
            ])
            ->values()
            ->all();

        return view('pages.layanan-detail', [
            'slug' => $slug,
            'name' => $service['name'][$locale] ?? $service['name']['id'],
            'detail' => $detail,
            'others' => $others,
        ]);
    }

    /**
     * Derive the slug from the Indonesian name, so config stays the single
     * source of truth and the URL is readable.
     *
     * @param  array{name: array<string, string>}  $service
     */
    public static function slugFor(array $service): string
    {
        return (string) Str::slug($service['name']['id']);
    }
}
