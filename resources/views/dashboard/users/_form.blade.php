    @if ($errors->any())
        <div class="alert alert-danger">
            <h4>Error Occured!</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    @if (session('customError'))
        <div class="alert alert-danger">
            <h4>Error Occurred!</h4>
            <p>{{ session('customError') }}</p>
        </div>
    @endif


    <div class="col-lg-12 col-md-12">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>خطا</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('dashboard.users.index') }}">back</a>
                    </div>
                </div><br>

                <div class="">

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6" id="fnWrapper">
                            <x-form.input class="form-control form-control-sm mg-b-20"
                                data-parsley-class-handler="#lnWrapper" name="name" required="" type="text"
                                label="user name" value="{{ $user->name }}" />
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <x-form.input class="form-control form-control-sm mg-b-20"
                                data-parsley-class-handler="#lnWrapper" name="email" required="" type="email"
                                value="{{ $user->email }}" label="E-mail" />
                        </div>
                    </div>

                </div>

                <div class="row mg-b-20">
                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <x-form.input class="form-control form-control-sm mg-b-20"
                            data-parsley-class-handler="#lnWrapper" name="password" required="" type="password"
                            label="password" value="{{ $user->password }}" />
                    </div>

                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <x-form.input class="form-control form-control-sm mg-b-20"
                            data-parsley-class-handler="#lnWrapper" name="confirm-password" required=""
                            type="password" label="confirm password" value="{{ $user->password }}" />
                    </div>
                </div>

                <div class="row mg-b-20">
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                            <label class="form-label">user role</label>
                            <select name="role_id" id="select-beast" class="form-control  nice-select  custom-select">
                                <option disabled value="">select role</option>
                                @foreach ($roles as $role_name => $role_id)
                                    <option value="{{ $role_id }}">{{ $role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="form-group">
        @if ($user->exists)
            <button type="submit" class="mt-3 btn btn-primary">edit user</button>
        @else
            <button type="submit" class="mt-3 btn btn-primary" id="submit">Add user</button>
        @endif
    </div>
