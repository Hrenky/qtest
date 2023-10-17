<div class="invalid-feedback d-flex flex-column">
    @foreach($errors->get($name) as $error)
        <span>{{ $error }}</span>
    @endforeach
</div>
