@php
    $attributes=['class'=>'form-control','label'=>'العنوان','placeholder'=>'العنوان'];
@endphp

@include('form.input',['name'=>'title','type'=>'text','attributes'=>$attributes])



@include('form.input',[
'name'=>'description',
'value'=>$row->description,
'type'=>'textarea',
'attributes'=>[
    'class'=>'form-control dateTimePicker',
    'id'=>'summary-ckeditor',
    'label'=>'الوصف',
    'placeholder'=>'الوصف',
    ]
])

@php
    $attributes=['class'=>'form-control','label'=>'رابط الفيديو','placeholder'=>'رابط الفيديو'];
@endphp

@include('form.input',['name'=>'video_url','type'=>'url','attributes'=>$attributes])



<script>
    CKEDITOR.replace( 'description' );
</script>
