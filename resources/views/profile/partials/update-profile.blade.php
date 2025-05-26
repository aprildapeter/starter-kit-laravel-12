<div class="active tab-pane" id="settings">
    <form class="form-horizontal" action="{{ route('profile-user.update', $user->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Name" name="name"
                    value="{{ $user->name ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email"
                    value="{{ $user->email ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary btn-click-animate">Submit</button>
            </div>
        </div>
    </form>
</div>
