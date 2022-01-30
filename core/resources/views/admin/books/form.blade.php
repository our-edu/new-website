@php
    $attributes=['class'=>'form-control','label'=>'اسم الكتاب','placeholder'=>'اسم الكتاب'];
@endphp

@include('form.input',['name'=>'name','type'=>'text','attributes'=>$attributes])
<br>
@php
    $attributes=['class'=>'form-control','label'=>'اسم المؤلف','placeholder'=>'اسم المؤلف'];
@endphp

@include('form.input',['name'=>'author','type'=>'text','attributes'=>$attributes])
<br>
@php
    $attributes=['class'=>'form-control','label'=>'تاريخ النشر','placeholder'=>'تاريخ النشر'];
@endphp

@include('form.input',['name'=>'publish_date','type'=>'date','attributes'=>$attributes])
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
@include("admin.layout.select_image")
<br>

<br>
@include("admin.layout.select_file")
<br>

@include('form.boolean',['value'=> $row->is_active ?? null,'name'=>'is_active','attributes'=>['label'=>'نشط' ,'required'=>1]])
<br>
@include('form.boolean',['value'=> $row->is_featured ?? null,'name'=>'is_featured','attributes'=>['label'=>'عرض' ,'required'=>1]])
<br>
@include('form.boolean',['value'=> $row->is_recommended ?? null,'name'=>'is_recommended','attributes'=>['label'=>'مفضله' ,'required'=>1]])


@section('scripts')

    @include('admin.layout.tinyMCE_config')
    @include("admin.layout.filemanger_scripts");
@endsection





