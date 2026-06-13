<form method="post" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('patch')

    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        <x-input-error class="text-danger" :messages="$errors->get('name')" />
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
        <x-input-error class="text-danger" :messages="$errors->get('email')" />
    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="alert alert-warning">
            Your email address is unverified.
            <button form="send-verification" class="btn btn-link p-0">Click here to re-send the verification email.</button>
        </div>

        @if (session('status') === 'verification-link-sent')
            <div class="alert alert-success">A new verification link has been sent to your email address.</div>
        @endif
    @endif

    <div class="d-flex align-items-center gap-2">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Save Profile
        </button>
        @if (session('status') === 'profile-updated')
            <span class="text-success">Saved.</span>
        @endif
    </div>
</form>

<form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-none">
    @csrf
</form>
