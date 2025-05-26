<div class="tab-pane" id="password">
    <form class="form-horizontal" action="{{ route('profile-user.ubah-password', $user->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group row">
            <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="current_password" placeholder="Current Password"
                    name="current_password">
            </div>
        </div>
        <div class="form-group row">
            <label for="password_new" class="col-sm-3 col-form-label">New Password</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="password_new" placeholder="New Password"
                    name="password_new">
                    <small>Minimal 8 karakter</small>
            </div>
        </div>
        <div class="form-group row">
            <label for="password_new_confirmation" class="col-sm-3 col-form-label">Confirm New Password</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="password_new_confirmation" placeholder="Confirm New Password"
                    name="password_new_confirmation">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary btn-click-animate">Submit</button>
            </div>
        </div>
    </form>
</div>
