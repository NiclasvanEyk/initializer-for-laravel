@php
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\Laravel\ComposerPackages\Packages;
    use Domains\CreateProjectForm\Sections\Cashier\CashierDriverOption;

    $driverParameter = P::CASHIER_DRIVER;
    $driver = option_selected($driverParameter, CashierDriverOption::default());
    $model = Str::studly($driverParameter);

    $paddle = new Packages\CashierPaddle();
    $paddleOption = CashierDriverOption::PADDLE;

    $stripe = new Packages\CashierStripe();
    $stripeOption = CashierDriverOption::STRIPE;

    $mollie = new Packages\CashierMollie();
    $mollieOption = CashierDriverOption::MOLLIE;
@endphp

<x-form-section name="Payment & Billing">
    <x-slot name="description">
        <p>
            Dealing with money, credit cards or billing is always scary.
            Luckily Laravel Cashier provides first-party integrations for the
            popular payment processing platforms
            <x-link href="https://stripe.com">Stripe</x-link>,
            <x-link href="https://paddle.com">Paddle</x-link> and
            <x-link href="https://mollie.com">Mollie</x-link>.
        </p>

        <p>
            Simply choose an implementation and configure your credentials.
            We'll automatically add billing capabilities to your user model.
        </p>
    </x-slot>

    <x-slot name="icon">
        <x-icons.credit-card />
    </x-slot>

    <x-form-control.group
        heading="Cashier"
        x-data="{'{{ $model }}': '{{ $driver }}'}"
    >
        <x-radio-option-none
            :model="$model"
            :name="$driverParameter"
        />

        <x-radio-option
            :id="$stripeOption"
            :label="$stripe->name()"
            :href="$stripe->href()"
            :model="$model"
            :name="$driverParameter"
        >
            {{ $stripe->description() }}
        </x-radio-option>

        <x-radio-option
            :id="$paddleOption"
            :label="$paddle->name()"
            :href="$paddle->href()"
            :model="$model"
            :name="$driverParameter"
        >
            {{ $paddle->description() }}
        </x-radio-option>

        <x-radio-option
            :id="$mollieOption"
            :label="$mollie->name()"
            :href="$mollie->href()"
            :model="$model"
            :name="$driverParameter"
        >
            {{ $mollie->description() }}
        </x-radio-option>
    </x-form-control.group>
</x-form-section>