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
@include('form.file',[
 'name'=>'image',
 'class' => 'form-control',
 'attributes'=>[
 'label'=>'الصوره',
 'placeholder'=>'الصوره',
 ]])


