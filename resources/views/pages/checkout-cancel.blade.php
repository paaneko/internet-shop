@extends('layouts.main')

@section('content')
    <div class="flex flex-col flex-grow mt-10">
        <div>
            <div class="mb-20 pb-10 flex flex-col items-center space-y-2 bg-red-500 w-full rounded-md">
                @svg('heroicon-o-x-circle', 'w-[250px] h-[250px] text-white ')
                <h2 class="pb-2 font-bold text-5xl">Payment Unsuccessful</h2>
                <span class="font-semibold text-2xl">Something went wrong, please try again later 😥</span>
                <div class="flex space-x-2">
                    <button class="mt-3 flex items-center p-3 bg-white rounded-md hover:bg-gray-100">
                        <span class="mr-1  text-lg font-medium">Try Again</span>
                    </button>
                </div>
            </div>
            <div class="max-w-4xl mx-auto">
                <h1 class="text-3xl font-bold mb-6">What to Do if Your Order Was Unsuccessful</h1>
                <ul class="list-disc list-inside space-y-4">
                    <li class="text-lg">
                        <span class="font-semibold">Check Your Payment Information:</span> Ensure that all your payment
                        details are correct and up-to-date. Verify the card number, expiration date, CVV, and billing
                        address.
                    </li>
                    <li class="text-lg">
                        <span class="font-semibold">Verify Your Bank Account:</span> Contact your bank to make sure
                        there are no issues with your account or any restrictions on your card that might be causing the
                        transaction to fail.
                    </li>
                    <li class="text-lg">
                        <span class="font-semibold">Try a Different Payment Method:</span> If possible, use an
                        alternative payment method such as another credit/debit card, PayPal, or a different online
                        payment service.
                    </li>
                    <li class="text-lg">
                        <span class="font-semibold">Check for Order Confirmation:</span> Sometimes orders go through
                        even if you receive an error message. Verify with your email or account order history to ensure
                        the order was not placed before attempting again.
                    </li>
                    <li class="text-lg">
                        <span class="font-semibold">Clear Your Browser Cache:</span> Clearing your browser cache and
                        cookies can resolve issues caused by corrupted data and can help in successfully placing your
                        order.
                    </li>
                    <li class="text-lg">
                        <span class="font-semibold">Contact Customer Support:</span> If you are still unable to place
                        your order, reach out to customer support for assistance. Provide them with details about the
                        issue and any error messages you received.
                    </li>
                    <li class="text-lg">
                        <span class="font-semibold">Try Again Later:</span> Sometimes, technical issues are temporary.
                        Wait for a few minutes or hours and then attempt to place your order again.
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
