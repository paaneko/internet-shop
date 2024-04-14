<?php

namespace App\Http\Controllers;

use App\Services\NewsletterService;
use Illuminate\Http\RedirectResponse;

class NewsletterController extends Controller
{
    public function __invoke(NewsletterService $newsletter): RedirectResponse
    {
        request()->validate([
            'email' => 'required|email|max:255',
        ]);

        $status = $newsletter->subscribe(request('email'));

        switch ($status) {
            case 200:
                session()->flash(
                    'success',
                    'You have successfully subscribed to the newsletter!'
                );
                break;
            case 429:
                session()->flash(
                    'success',
                    'You already subscribed to the newsletter!'
                );
                break;
            case 500:
                session()->flash(
                    'success',
                    'Something went wrong please try later!'
                );
                break;
        }

        return back();
    }
}
