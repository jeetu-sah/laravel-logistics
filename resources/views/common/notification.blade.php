<div class="col-sm-12">
    @if(Session::has('alertMessage'))
        @php $alert = Session::get("alert") @endphp
        <x-alert :alert="$alert" />
    @endif
</div>
<div class="col-sm-12">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div class="col-sm-12" id="notification"></div>