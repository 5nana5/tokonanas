<form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
    @csrf
    @method('delete')

    <div class="mb-3">
        <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="Password">
        <x-input-error class="text-danger" :messages="$errors->userDeletion->get('password')" />
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-chevron-left"></i> Back
        </a>
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-user-slash"></i> Delete Account
        </button>
    </div>
</form>
