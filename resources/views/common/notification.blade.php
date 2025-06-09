<div class="col-sm-12">
    @if(Session::has('alertMessage'))
    @php $alert = Session::get("alert") @endphp
    <x-alert :alert="$alert" />
    @endif
</div>
<div class="col-sm-12" id="notification"></div>