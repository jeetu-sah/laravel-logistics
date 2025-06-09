<div>
   
    <div class="alert alert-{{ $alert['type'] ?? '' }}"><strong>{{ ucfirst($alert['type'] ?? '') ?? '' }} </strong> {{ $alert['message'] ?? '' }} !!! </div>
    <!-- <div class="callout callout-danger"><strong>Danger </strong> {{ $alert['message'] ?? '' }} !!! </div>
    <div class="callout callout-info"><strong>Info </strong> {{ $alert['message'] ?? '' }} !!! </div>
    <div class="callout callout-warning"><strong>Warning </strong> {{ $alert['message'] ?? '' }} !!! </div> -->
</div>