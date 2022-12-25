<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Repository\SubscriptionRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function store(Request $request, SubscriptionRepository $subscriptionRepository)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'username' => ['required', 'string'],
            'country' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'formFile.*' => ['required', 'file', 'image'],
            'dialCode' => ['required', 'integer'],
        ]);

        $images = [];
        if ($request->hasfile('formFile')) {
            foreach ($request->file('formFile') as $i => $file) {
                $filename = $file->store('subscription-image');
                $images[] = $filename;
            }
        }

        $subscriber = (object) array_merge(
            $request->only('name', 'surname', 'username', 'country', 'address'),
            [
                'phone' => '+' . $request->dialCode . ' ' . $request->phone,
                'images' => $images
            ]
        );

        SendMail::
            dispatch($subscriber, env('MAIL_OBJECT', 'Souscription'), $subscriptionRepository->getMailReceiver($request->dialCode))
            ->delay(now()->addMinutes(1));

        return view('goodbuy');
    }

}
