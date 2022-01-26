<div class="row mg-t-20">
    <label class="col-sm-2">تحميل صوره</label>
    <div class="col-lg-6">
        <div class="input-group">
        <span class="input-group-prepend">
          <a data-input="thumbnail" data-preview="holder" class="btn btn-primary lfm ">
            <i class="fa fa-image  text-white "></i>
          </a>
        </span>
            {!! Form::text('image_url', (!empty($image) ? $image : (!empty($image_file) ? $image_file : null)) , ['class'=>'form-control','id'=>'thumbnail']) !!}

        </div>

    </div>
    <div class="col-lg-4">
        <div id="holder" style="margin-top:15px;max-height:150px; height: 100px">
            @if(!empty($image))
                <img src="{{$image}}" width="150px">
            @endif
                @if(!empty($image_file))
                    <img src="{{$image_file}}" width="150px">
                @endif
        </div>
    </div>
</div>

