<section>
    <header class="perfil-header">
        <h2>Información del perfil</h2>
        <p>Actualiza tu nombre y correo electrónico.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="formulario">
        @csrf
        @method('patch')

        <div class="campo">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name', $user->name) }}"
                   required autofocus autocomplete="name">
            @error('name')<span class="error-campo">{{ $message }}</span>@enderror
        </div>

        <div class="campo">
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email', $user->email) }}"
                   required autocomplete="username">
            @error('email')<span class="error-campo">{{ $message }}</span>@enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="aviso-verificacion">
                    Tu correo no está verificado.
                    <button form="send-verification" class="btn-link">Reenviar verificación</button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="ok-msg">Se envió un nuevo enlace a tu correo.</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="acciones">
            <button type="submit" class="btn-guardar">Guardar</button>
            @if (session('status') === 'profile-updated')
                <span class="ok-inline">Guardado.</span>
            @endif
        </div>
    </form>
</section>