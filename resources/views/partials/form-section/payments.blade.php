@php
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\Laravel\ComposerPackages\Packages;

    $paddle = new Packages\CashierPaddle();
    $paddleParameter = P::USES_PADDLE;
    $usesPaddle = old($paddleParameter, request()->has($paddleParameter));

    $stripe = new Packages\CashierStripe();
    $stripeParameter = P::USES_STRIPE;
    $usesStripe = old($stripeParameter, request()->has($stripeParameter));

    $mollie = new Packages\CashierMollie();
    $mollieParameter = P::USES_MOLLIE;
    $usesMollie = old($mollieParameter, request()->has($mollieParameter));
@endphp

<x-form-section name="Payment & Billing">
    <x-slot name="description">
        Laravel
        If you want to give your users the ability to execute full-text search
        queries, which go beyond what a simple <code>where</code> SQL clause
        could achieve, this section might be for you.
    </x-slot>

    <x-slot name="icon">
        <x-icons.credit-card />
    </x-slot>

    <x-form-control.group heading="Cashier">
        <x-first-party-package.option
            :id="$paddleParameter"
            :checked="$usesPaddle"
            :package="$paddle"
            flush
        ></x-first-party-package.option>

        <x-first-party-package.option
            :id="$stripeParameter"
            :checked="$usesStripe"
            :package="$stripe"
            flush
        ></x-first-party-package.option>

        <x-first-party-package.option
            :id="$mollieParameter"
            :checked="$usesMollie"
            :package="$mollie"
            flush
        ></x-first-party-package.option>
    </x-form-control.group>
</x-form-section>
