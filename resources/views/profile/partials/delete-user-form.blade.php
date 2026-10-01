<section>
    <header class="perfil-header">
        <h2>Eliminar cuenta</h2>
        <p>Una vez eliminada, no se puede recuperar.</p>
    </header>

    <button type="button" class="btn-peligro-grande" onclick="document.getElementById('modal-eliminar').classList.add('abierto')">
        Eliminar mi cuenta
    </button>

    {{-- Modal simple --}}
    <div id="modal-eliminar" class="modal-overlay">
        <div class="modal-box" onclick="event.stopPropagation()">
            <h3>¿Eliminar tu cuenta?</h3>
            <p>Esta acción es permanente. Ingresa tu contraseña para confirmar.</p>

            <form method="post" action="{{ route('profile.destroy') }}" class="formulario">
                @csrf
                @method('delete')

                <div class="campo">
                    <label for="password_delete">Contraseña</label>
                    <input type="password" id="password_delete" name="password"
                           placeholder="Tu contraseña actual" autocomplete="current-password">
                    @error('password', 'userDeletion')
                        <span class="error-campo">{{ $message }}</span>
                    @enderror
                </div>

                <div class="acciones">
                    <button type="submit" class="btn-peligro-grande">Eliminar</button>
                    <button type="button" class="btn-cancelar"
                            onclick="document.getElementById('modal-eliminar').classList.remove('abierto')">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>