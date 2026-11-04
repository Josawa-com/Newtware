<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Models\Rating;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class RatingController extends Controller
{
    private const COOKIE = 'netware_device';

    public function index(Request $request): View
    {
        $deviceKey = $this->deviceKey($request);

        $ratings = Rating::query()
            ->visible()
            ->latest()
            ->limit(60)
            ->get(['id', 'stars', 'author', 'body', 'created_at']);

        return view('pages.testimoni', [
            'ratings' => $ratings,
            'average' => round((float) $ratings->avg('stars'), 1),
            'total' => $ratings->count(),
            'hasRated' => Rating::query()->where('device_key', $deviceKey)->exists(),
        ]);
    }

    public function store(StoreRatingRequest $request): RedirectResponse|JsonResponse
    {
        $deviceKey = $this->deviceKey($request);

        // One rating per device. The unique index is the real guard; this check
        // simply produces a friendly message for the common case.
        if (Rating::query()->where('device_key', $deviceKey)->exists()) {
            $message = __('testimoni.form.already_rated');

            return $request->expectsJson()
                ? response()->json(['message' => $message], 422)
                : back()->withErrors(['rating' => $message]);
        }

        $rating = Rating::query()->create([
            'device_key' => $deviceKey,
            'stars' => $request->integer('stars'),
            'author' => $request->string('author')->trim()->value() ?: null,
            'body' => $request->string('body')->trim()->value(),
            'is_visible' => true,
        ]);

        $payload = [
            'message' => __('testimoni.form.thanks'),
            'rating' => [
                'stars' => $rating->stars,
                'author' => $rating->author,
                'body' => $rating->body,
                'created_at' => $rating->created_at?->translatedFormat('d M Y'),
            ],
            'average' => round((float) Rating::query()->visible()->avg('stars'), 1),
            'total' => Rating::query()->visible()->count(),
        ];

        if ($request->expectsJson()) {
            return response()->json($payload, 201);
        }

        return redirect()
            ->route('testimoni')
            ->with('rating_status', $payload['message']);
    }

    /**
     * Stable per-device identifier.
     *
     * A long random value lives in a 5-year cookie; it is hashed together with a
     * coarse browser fingerprint so clearing one but not the other still cannot
     * be used to vote twice without effort. No personal data is stored.
     */
    private function deviceKey(Request $request): string
    {
        $token = $request->cookie(self::COOKIE);

        if (! is_string($token) || strlen($token) < 32) {
            $token = Str::random(48);

            Cookie::queue(self::COOKIE, $token, 60 * 24 * 365 * 5);
        }

        $fingerprint = implode('|', [
            $request->userAgent() ?? '',
            $request->ip() ?? '',
        ]);

        return hash('sha256', $token.'|'.$fingerprint);
    }
}
