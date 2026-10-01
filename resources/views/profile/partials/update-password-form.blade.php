<section>
    <header class="perfil-header">
        <h2>Actualizar contraseña</h2>
        <p>Usa una contraseña larga y segura.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="formulario">
        @csrf
        @method('put')

        <div class="campo">
            <label for="update_password_current_password">Contraseña actual</label>
            <input type="password" id="update_password_current_password"
                   name="current_password" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <span class="error-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo">
            <label for="update_password_password">Nueva contraseña</label>
            <input type="password" id="update_password_password"
                   name="password" autocomplete="new-password">
            @error('password', 'updatePassword')
                <span class="error-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="campo">
            <label for="update_password_password_confirmation">Confirmar contraseña</label>
            <input type="password" id="update_password_password_confirmation"
                   name="password_confirmation" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <span class="error-campo">{{ $message }}</span>
            @enderror
        </div>

        <div class="acciones">
            <button type="submit" class="btn-guardar">Guardar</button>
            @if (session('status') === 'password-updated')
                <span class="ok-inline">Guardado.</span>
            @endif
        </div>
    </form>
</section>