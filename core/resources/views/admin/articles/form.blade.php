@php
    $attributes=['class'=>'form-control','label'=>'العنوان','placeholder'=>'العنوان'];
@endphp

@include('form.input',['name'=>'title','type'=>'text','attributes'=>$attributes])

{{--@php--}}
{{--    $attributes=['class'=>'form-control','label'=>'سمعل','placeholder'=>'سمعل'];--}}
{{--@endphp--}}

{{--@include('form.input',['name'=>'slug','type'=>'text','attributes'=>$attributes])--}}
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
@include('form.input',[
'name'=>'article_content',
'value'=>$row->article_content,
'type'=>'textarea',
'attributes'=>[
    'class'=>'form-control dateTimePicker',
    'id'=>'article_content',
    'label'=>'المحتوي',
    'placeholder'=>'المحتوي',
    ]
])

<br>
@include('form.file',[
 'name'=>'post_img',
 'value'=> $row->post_img,
 'class' => 'form-control',
 'attributes'=>[
 'label'=>'الصوره',
 'placeholder'=>'الصوره',
 ]])

<br>

@include('form.boolean',['value'=> $row->is_active ?? null,'name'=>'is_active','attributes'=>['label'=>'نشط' ,'required'=>1]])
<br>
@include('form.boolean',['value'=> $row->is_featured ?? null,'name'=>'is_featured','attributes'=>['label'=>'عرض' ,'required'=>1]])


<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@include('admin.layout.tinyMCE_config')
