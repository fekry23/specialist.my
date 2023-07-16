@extends('layout')

@section('styles')
    <style>
        .paymentContainer form {
            min-width: 500px;
            align-self: center;
            box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
                0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
            border-radius: 7px;
            padding: 40px;
        }

        .paymentContainer .hidden {
            display: none;
        }

        .paymentContainer #payment-message {
            color: rgb(105, 115, 134);
            font-size: 16px;
            line-height: 20px;
            padding-top: 12px;
            text-align: center;
        }

        .paymentContainer #payment-element {
            margin-bottom: 24px;
        }

        /* Buttons and links */
        .paymentContainer button {
            background: #5469d4;
            font-family: Arial, sans-serif;
            color: #ffffff;
            border-radius: 4px;
            border: 0;
            padding: 12px 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: block;
            transition: all 0.2s ease;
            box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
            width: 100%;
        }

        .paymentContainer button:hover {
            filter: contrast(115%);
        }

        .paymentContainer button:disabled {
            opacity: 0.5;
            cursor: default;
        }

        /* spinner/processing state, errors */
        .paymentContainer .spinner,
        .paymentContainer .spinner:before,
        .paymentContainer .spinner:after {
            border-radius: 50%;
        }

        .paymentContainer .spinner {
            color: #ffffff;
            font-size: 22px;
            text-indent: -99999px;
            margin: 0px auto;
            position: relative;
            width: 20px;
            height: 20px;
            box-shadow: inset 0 0 0 2px;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
        }

        .paymentContainer .spinner:before,
        .paymentContainer .spinner:after {
            position: absolute;
            content: "";
        }

        .paymentContainer .spinner:before {
            width: 10.4px;
            height: 20.4px;
            background: #5469d4;
            border-radius: 20.4px 0 0 20.4px;
            top: -0.2px;
            left: -0.2px;
            -webkit-transform-origin: 10.4px 10.2px;
            transform-origin: 10.4px 10.2px;
            -webkit-animation: loading 2s infinite ease 1.5s;
            animation: loading 2s infinite ease 1.5s;
        }

        .paymentContainer .spinner:after {
            width: 10.4px;
            height: 10.2px;
            background: #5469d4;
            border-radius: 0 10.2px 10.2px 0;
            top: -0.1px;
            left: 10.2px;
            -webkit-transform-origin: 0px 10.2px;
            transform-origin: 0px 10.2px;
            -webkit-animation: loading 2s infinite ease;
            animation: loading 2s infinite ease;
        }

        @-webkit-keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @media only screen and (max-width: 600px) {
            form {
                width: 80vw;
                min-width: initial;
            }
        }
    </style>
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="paymentContainer tw-container tw-mx-auto tw-p-28">

        <div class="tw-container tw-grid tw-grid-cols-2 gap-4 tw-divide-x">


            {{-- Left Container --}}
            <div class="tw-bg-white tw-mx-auto  tw-px-8 tw-py-4 tw-w-full tw-rounded">
                <x-employers.jobs-breadcrumb :previous_page="'Job Progress'" :current_page="'Payment Page'" :job_id="$job->id" />

                <form id="payment-form-1"
                    action="{{ route('employer.update_payment', ['job_id' => $job->id, 'rate' => $job->rate]) }}"
                    method="POST">
                    @csrf
                    <label for="specialist-rate-input" class="tw-block tw-text-gray-700 tw-font-semibold">
                        Specialist Price
                    </label>

                    @isset($paymentAmount)
                        <span id="amountDisplay" class="tw-text-2xl tw-font-bold">RM {{ $paymentAmount / 100 }}</span>
                    @endisset


                    <input id="specialist-rate-input" name="specialist_rate" type="number" value=""
                        class="tw-mt-4 tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm">

                    <input type="hidden" name="clientSecret" value="{{ $clientSecret }}">
                    <input type="hidden" name="paymentIntentId" value="{{ $paymentIntentId }}">


                    <span class="tw-block tw-text-gray-600 tw-text-sm">
                        Ensure that the price you enter aligns with the discussion you had with the specialist. </span>
                    <button type="submit" class="tw-my-4">Submit Price</button>

                </form>
                <div class="tw-py-4">

                </div>

            </div>

            <div>
                {{-- Right container --}}
                <form data-secret="{{ $clientSecret }}" id="payment-form-2" class="tw-bg-white">
                    @csrf
                    <div id="link-authentication-element">
                        <!--Stripe.js injects the Link Authentication Element-->
                    </div>

                    <div id="payment-element">
                        <!--Stripe.js injects the Payment Element-->
                    </div>

                    <button id="submit">
                        <div class="spinner tw-hidden" id="spinner"></div>
                        <span id="button-text">Pay now</span>
                    </button>

                    <div id="payment-message" class="tw-hidden"></div>

                    <div id="error-message">
                        <!-- Display error message to your customers here -->
                    </div>

                </form>
            </div>


        </div>


    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        // Retrieve your Stripe API key from the environment variables
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');

        // Retrieve the client secret from the server-side or wherever it is generated
        const clientSecret = '{{ $clientSecret }}';

        // Enable the skeleton loader UI for the optimal loading experience.
        const loader = 'auto';

        let elements;
        let paymentElement; // Declare the paymentElement variable

        initialize();
        checkStatus();

        // document.querySelector("#payment-form-1").addEventListener("submit", handleSubmitForm1);
        document.querySelector("#payment-form-2").addEventListener("submit", handleSubmit);


        // document
        //     .querySelector("#payment-form")
        //     .addEventListener("submit", handleSubmit);

        const specialistRateInput = document.querySelector('#specialist-rate-input');


        specialistRateInput.addEventListener("input", updateRate);

        function updateRate(e) {
            const updatedRate = e.target.value;
            const display = document.getElementById('amountDisplay');

            display.textContent = "RM " + updatedRate;

            console.log('Specialist Rate:', updatedRate);
        }

        let emailAddress = '{{ $user->email }}';

        // Fetches a payment intent and captures the client secret
        async function initialize() {
            // Customize the style of the card element
            elements = stripe.elements({
                clientSecret,
                loader,
                appearance: {
                    theme: 'stripe',
                    rules: {
                        '.Label': {
                            marginTop: '0.75rem',
                            color: '#374151',
                            fontWeight: '600',
                        },
                        '.Input': {
                            borderRadius: '0.375rem',
                            borderWidth: '1px',
                            borderColor: '#D1D5DB',
                            fontSize: '1rem',
                            lineHeight: '1.5',
                            color: '#374151',
                        },
                        // See all supported class names and selector syntax below
                    },
                },
            });

            const linkAuthenticationElement = elements.create('linkAuthentication', {
                defaultValues: {
                    email: '{{ $user->email }}',
                },
            });
            linkAuthenticationElement.mount('#link-authentication-element');

            const paymentElementOptions = {
                layout: {
                    type: 'accordion',
                    defaultCollapsed: false,
                    radios: true,
                    spacedAccordionItems: false
                },
            };

            paymentElement = elements.create('payment',
                paymentElementOptions); // Assign the created payment element to the paymentElement variable
            paymentElement.mount('#payment-element');

            // Handle card element change event
            paymentElement.addEventListener('change', function(event) {
                var displayError = document.getElementById('error-message');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
        }

        async function checkStatus() {
            if (!clientSecret) {
                return;
            }

            try {
                const {
                    paymentIntent
                } = await stripe.retrievePaymentIntent(clientSecret);

                switch (paymentIntent.status) {
                    case "succeeded":
                        showMessage("Payment succeeded!");
                        break;
                    case "processing":
                        showMessage("Your payment is processing.");
                        break;
                    case "requires_payment_method":
                        showMessage("Your payment was not successful, please try again.");
                        break;
                    default:
                        showMessage("Something went wrong.");
                        break;
                }
            } catch (error) {
                showMessage("An error occurred while checking payment status.");
            }
        }


        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);

            const {
                error
            } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    receipt_email: emailAddress,
                    // Return URL where the customer should be redirected after the PaymentIntent is confirmed.
                    return_url: 'https://www.specialist2.online/employer/jobs/' + {{ $job->id }} + '/' +
                        {{ $job->rate }} + '/payment/success',
                },
                // redirect: "if_required",
            });

            if (error && (error.type === "card_error" || error.type === "validation_error")) {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }

            setLoading(false);

            // Refresh the page after 3 seconds
            setTimeout(function() {
                location.reload();
            }, 2000);
        }

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("tw-hidden");
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.classList.add("tw-hidden");
                messageText.textContent = "";
            }, 4000);
        }

        function setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").classList.remove("tw-hidden");
                document.querySelector("#button-text").classList.add("tw-hidden");
            } else {
                document.querySelector("#submit").disabled = false;
                document.getElementById('button-text').textContent = 'Pay now';
                document.querySelector("#spinner").classList.add("tw-hidden");
                document.querySelector("#button-text").classList.remove("tw-hidden");
            }
        }
    </script>
@endsection
