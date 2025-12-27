@props(['disabled' => false])

@php
	$type = $attributes->get('type') ?: 'text';
	$isPassword = $type === 'password';
	$inputClasses = $isPassword ? 'form-control pr-5' : 'form-control'; // Use Bootstrap form-control, add padding for password
@endphp

@unless($isPassword)
	<input @disabled($disabled) {{ $attributes->merge(['class' => $inputClasses]) }}>
@else
	<div class="position-relative">
		<input @disabled($disabled) {{ $attributes->merge(['class' => $inputClasses]) }} data-password-input>

		<button type="button" class="btn position-absolute" style="right: 0.5rem; top: 50%; transform: translateY(-50%); z-index: 5; border: none; background: transparent;" aria-label="Toggle password visibility" data-password-toggle>
			<i data-eye class="fas fa-eye text-muted"></i>
			<i data-eye-off class="fas fa-eye-slash text-muted d-none"></i>
		</button>
	</div>

	<script>
		if (!window.passwordToggleInitialized) {
			window.passwordToggleInitialized = true;
			document.addEventListener('click', function (e) {
				const toggle = e.target.closest('[data-password-toggle]');
				if (!toggle) return;

				const wrapper = toggle.closest('.position-relative');
				if (!wrapper) return;

				const input = wrapper.querySelector('[data-password-input]');
				if (!input) return;

				const eye = toggle.querySelector('[data-eye]');
				const eyeOff = toggle.querySelector('[data-eye-off]');

				if (input.type === 'password') {
					input.type = 'text';
					if (eye) eye.classList.add('d-none');
					if (eyeOff) eyeOff.classList.remove('d-none');
				} else {
					input.type = 'password';
					if (eye) eye.classList.remove('d-none');
					if (eyeOff) eyeOff.classList.add('d-none');
				}
			});
		}
	</script>
@endunless
