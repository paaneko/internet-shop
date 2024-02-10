<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Newsletter
{
    public function subscribe(string $email): int
    {
        $response = Http::withBasicAuth(
            config('services.esputnik.api_username'),
            config('services.esputnik.api_key')
        )
            ->post(
                config('services.esputnik.domain')
                .'/api/v1/contact',
                [
                    'contacts' => [
                        'channels' => [
                            'value' => $email,
                            'type' => 'email',
                        ],
                        'groups' => [
                            'id' => config(
                                'services.esputnik.groups.newsletters'
                            ),
                        ],
                    ],
                    'dedupeOn' => 'email',
                ],
            );

        return $response->status();
    }
}
