<form enctype="multipart/form-data" method="post" action="/api/photo/post">
    {{ csrf_field() }}
    <div class="form-group">

        <input data-preview="#preview" name="input_img" type="file" id="imageInput">
        <img class="col-sm-6" id="preview"  src="" ></img>
    </div>
    <div class="form-group">
        <input class="form-control" type="submit">
    </div></form>