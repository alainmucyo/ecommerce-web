@csrf
@include("includes.error")
<div class="form-group">
    <label for="title">Product title</label>
    <input type="text" name="title" id="title" value="{{ old("title",$product->title) }}" class="form-control"
           required/>
</div>
<div class="form-group">
    <label for="details">Product location</label>
    <input type="text" name="details" id="details" value="{{ old("details",$product->details) }}" class="form-control"
           required/>
</div>
<div class="form-group">
    <label for="customFile">Upload Image</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" name="image" id="customFile"/>
        <label class="custom-file-label" for="customFile">Choose image</label>
    </div>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="{{ $btnText }}"/>
</div>
