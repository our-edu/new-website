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
    'id'=>'description',
    'label'=>'الوصف',
    'placeholder'=>'الوصف',
    ]
])
<br>
<br>
@include('form.input',['name'=>"meta[meta_keys]",'type'=>'text','attributes'=>[
    "label"=>"كلمات دلالية", 'placeholder'=>'كلمات دلالية','class'=>'form-control'
]])

<br>
@include('form.input',[
'name'=>'meta[meta_description]',
'value'=>null,
'type'=>'textarea',
'attributes'=>[
    'class'=>'form-control',
    'id'=>'description',
    'label'=>'الوصف التعريفي للمحرك البحث',
    'placeholder'=>'الوصف التعريفي للمحرك البحث',
    ]
])
<br>
@include('form.input',[
'name'=>'body',
'value'=>$row->body,
'type'=>'textarea',
'attributes'=>[
    'class'=>'form-control dateTimePicker',
    'id'=>'article_content',
    'label'=>'المحتوي',
    'placeholder'=>'المحتوي',
    ]
])


<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@include('admin.layout.tinyMCE_config')
