<form method="post" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="update_password_current_password">Current Password</label>
        <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
        <x-input-error class="text-danger" :messages="$errors->updatePassword->get('current_password')" />
    </div>

    <div class="form-group">
        <label for="update_password_password">New Password</label>
        <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
        <x-input-error class="text-danger" :messages="$errors->updatePassword->get('password')" />
    </div>

    <div class="form-group">
        <label for="update_password_password_confirmation">Confirm Password</label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
        <x-input-error class="text-danger" :messages="$errors->updatePassword->get('password_confirmation')" />
    </div>

    <button type="submit" class="btn btn-warning">
        <i class="fas fa-save"></i> Save
    </button>

    @if (session('status') === 'password-updated')
        <span class="text-success ms-3">Saved.</span>
    @endif
</form>
