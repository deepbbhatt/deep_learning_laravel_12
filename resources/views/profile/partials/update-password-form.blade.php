<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="update_password_current_password">{{ __('Current Password') }}</label>
        <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
    </div>

    <div class="form-group">
        <label for="update_password_password">{{ __('New Password') }}</label>
        <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
    </div>

    <div class="form-group">
        <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-warning">{{ __('Save') }}</button>

        @if (session('status') === 'password-updated')
            <span class="text-success ml-2">{{ __('Saved.') }}</span>
        @endif
    </div>
</form>
