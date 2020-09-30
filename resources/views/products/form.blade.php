<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ !empty($product) ? $product->name : old('name') }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label" for="picture">
                Picture
            </label>
            @if(isset($product) && !empty($product->picture))
                <a href="{{ asset('uploads/products/' . $product->picture) }}"
                   target="_blank" class="float-right">
                    Link
                </a>
            @endif
            <input type="file" class="form-control" id="picture" name="picture"
                   value="{{ isset($product) && !empty($product) ? $product->picture : '' }}">
            <input type="hidden" name="old_picture"
                   value="{{ isset($product) && !empty($product) ? $product->picture : '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label" for="is_active">Is Active</label><br>
            <div class="checkbox-fade fade-in-primary">
                <label>
                    <input type="checkbox" value="1" name="is_active"
                        {{ isset($product) && $product->is_active == 1 ? 'checked="checked"' : '' }}>
                    <span class="cr">
                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                    </span> <span></span>
                </label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea rows="5" cols="5" class="form-control" name="description" id="description"
                      placeholder="Type here something...">{{ !empty($product) ? $product->description : old('description') }}</textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
    </div>
</div>
