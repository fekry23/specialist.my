<style>
    .success-message,
    .error-message {
        position: fixed;
        top: 0px;
        background-color: #8dc7ff;
        padding: 0.75rem 12rem;
        padding-left: 12rem;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
    }

    .success-message p {
        color: white;
        font-size: larger;
    }

    .error-message {
        background-color: red
    }

    .error-message p {
        color: black;
        font-size: larger;
    }
</style>

@if (session()->has('success-message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="success-message">
        <p>
            {{ session('success-message') }}
        </p>
    </div>
@elseif (session()->has('error-message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="error-message">
        <p>
            {{ session('error-message') }}
        </p>
    </div>
@endif
