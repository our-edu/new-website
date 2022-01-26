
<div class="row mg-t-20">
    <label class="col-sm-2">تحميل الكتاب</label>
<div class="col-lg-6">
    <div class="input-group">
          <span class="input-group-prepend">
            <a  data-input="bookpdf" data-preview="holder2" class="btn btn-primary  " id="lfm">
              <i class="fa fa-file  text-white "></i>
            </a>
          </span>
        {!! Form::text('bookpdf', (!empty($file) ? $file : null), ['class'=>'form-control','id'=>'bookpdf']) !!}
    </div>

</div>
<div class="col-md-4">
    <div id="holder2" style="margin-top:15px;max-height:150px;">
        @if(!empty($file))
            <a href="{{$file}}" type="application/pdf"  target="_blank">عرض الكتاب</a>
        @endif
    </div>
</div>
</div>