<form enctype="multipart/form-data" method="post" action="/lights/post">
        {{ csrf_field() }}
         <div class="form-group">
            <label for="imageInput">Coordinates input: ___________</label>
            <p class="help-block">Example block-level help text here.</p>
        </div>
        <div class="form-group">
            <label for="">submit</label>
            <input class="form-control" type="submit">
        </div></form>

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
