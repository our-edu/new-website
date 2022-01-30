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
@include('form.input',[
'name'=>'research_content',
'value'=>$row->research_content,
'type'=>'textarea',
'attributes'=>[
    'class'=>'form-control dateTimePicker',
    'id'=>'article_content',
    'label'=>'المحتوي',
    'placeholder'=>'المحتوي',
    ]
])
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

@include('form.boolean',['value'=> $row->is_active ?? null,'name'=>'is_active','attributes'=>['label'=>'نشط' ,'required'=>1]])
<br>
@include('form.boolean',['value'=> $row->is_featured ?? null,'name'=>'is_featured','attributes'=>['label'=>'عرض' ,'required'=>1]])


<@section('scripts')

    @include('admin.layout.tinyMCE_config')
    @include("admin.layout.filemanger_scripts");
@endsection

