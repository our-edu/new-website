@php
    $attributes=['class'=>'form-control','label'=>'العنوان','placeholder'=>'العنوان'];
@endphp

@include('form.input',['name'=>'title','type'=>'text','attributes'=>$attributes])

<br>

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

<br>
@include('form.input',[
'name'=>'video_embed',
'value'=>$row->video_embed,
'type'=>'textarea',
'attributes'=>[
    'class'=>'form-control dateTimePicker',
    'id'=>'summary-ckeditor',
    'label'=>'video_embed',
    'placeholder'=>'video_embed',
    ]
])
<br>
@php
    $attributes=['class'=>'form-control','label'=>'رابط الفيديو','placeholder'=>'رابط الفيديو'];
@endphp

@include('form.input',['name'=>'video_url','type'=>'url','attributes'=>$attributes])



<script>
    CKEDITOR.replace( 'description' );
</script>
