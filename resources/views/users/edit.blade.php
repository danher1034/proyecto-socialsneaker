
    <form action="{{ route('users/update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="birthday">Cumpleaños:</label><br>
            <input type="date" name="birthday" id="birthday" value="{{$user->birthday}}" class="form-control"><br>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="newpassword"><div class="badge bg-secondary text-wrap" style="width: 6rem;">Opcional</div> Nueva contraseña:</label>
            <input type="password" id="newpassword" name="newpassword" class="form-control" aria-describedby="passwordHelpBlock">
            <div id="passwordHelpBlock" class="form-text">
                La contraseña debe tener minimo 8, preferiblemente deberia contener letras y números, y no contener espacios, caracteres especiales ni emoji.
            </div>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="newpassword_confirmation"><div class="badge bg-secondary text-wrap" style="width: 6rem;">Opcional</div> Repite la nueva contraseña:</label><br><br>
            <input type="password" name="newpassword_confirmation" id="newpassword_confirmation" class="form-control">
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="image_user">Imagen perfil</label>
            <input type="file" name="image_user" id="image_user" class="form-control">
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="password"><div class="badge bg-secondary text-wrap" style="width: 6rem;">Obligatorio</div> Contraseña Actual:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <input type="submit" value="Guardar Cambios">
    </form>



