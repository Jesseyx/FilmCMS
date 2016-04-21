@if ($errors->any())
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error  }}</li>
            @endforeach
        </ul>
    </div>
@endif