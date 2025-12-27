@props(['disabled' => false])

@php
	$type = $attributes->get('type') ?: 'text';
	$isPassword = $type === 'password';
	$inputClasses = 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
	if ($isPassword) {
		$inputClasses .= ' pr-10';
	}
@endphp

@unless($isPassword)
	<input @disabled($disabled) {{ $attributes->merge(['class' => $inputClasses]) }}>
@else
	<div class="relative">
		<input @disabled($disabled) {{ $attributes->merge(['class' => $inputClasses.' block w-full']) }} data-password-input>

		<button type="button" class="absolute inset-y-0 end-0 me-2 flex items-center" aria-label="Toggle password visibility" data-password-toggle>
			<svg data-eye class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="margin-top: -40px;">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
			</svg>
			<svg data-eye-off class="hidden h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="margin-top: -40px;">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.943-9.543-7a9.956 9.956 0 012.223-3.398M6.1 6.1A9.953 9.953 0 0112 5c4.478 0 8.269 2.943 9.543 7a9.985 9.985 0 01-4.05 5.077M3 3l18 18" />
			</svg>
		</button>
	</div>

	<script>
		if (!window.passwordToggleInitialized) {
			window.passwordToggleInitialized = true;
			document.addEventListener('click', function (e) {
				const toggle = e.target.closest('[data-password-toggle]');
				if (!toggle) return;

				const wrapper = toggle.closest('.relative');
				if (!wrapper) return;

				const input = wrapper.querySelector('[data-password-input]');
				if (!input) return;

				const eye = toggle.querySelector('[data-eye]');
				const eyeOff = toggle.querySelector('[data-eye-off]');

				if (input.type === 'password') {
					input.type = 'text';
					if (eye) eye.classList.add('hidden');
					if (eyeOff) eyeOff.classList.remove('hidden');
				} else {
					input.type = 'password';
					if (eye) eye.classList.remove('hidden');
					if (eyeOff) eyeOff.classList.add('hidden');
				}
			});
		}
	</script>
@endunless
