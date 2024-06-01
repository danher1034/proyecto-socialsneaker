
    <form action="{{ route('users/update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="birthday">@lang('user.dateofbirth')</label><br>
            <input type="date" name="birthday" id="birthday" value="{{$user->birthday}}" class="form-control"><br>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="newpassword"><div class="badge bg-secondary text-wrap" style="width: 6rem;">@lang('user.optional')</div>@lang('user.newpassword')</label>
            <input type="password" id="newpassword" name="newpassword" class="form-control" aria-describedby="passwordHelpBlock">
            <div id="passwordHelpBlock" class="form-text">
                @lang('user.newpasswordtext')
            </div>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label for="newpassword_confirmation"><div class="badge bg-secondary text-wrap" style="width: 6rem;">@lang('user.optional')</div> @lang('user.repeatnewpassword')</label><br><br>
            <input type="password" name="newpassword_confirmation" id="newpassword_confirmation" class="form-control">
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="image_user">@lang('user.profileimage')</label>
            <input type="file" name="image_user" id="image_user" class="form-control">
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="password"><div class="badge bg-secondary text-wrap" style="width: 6rem;">@lang('user.required')</div>@lang('user.currentpassword')</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <input type="submit" value="@lang('user.savechanges')">
    </form>



