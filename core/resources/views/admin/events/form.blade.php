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
<br>
@include("admin.layout.select_image")
<br>
@php
    $attributes=['class'=>'form-control','label'=>'تاريخ النشاط','placeholder'=>'تاريخ النشاط'];
@endphp

@include('form.input',['name'=>'event_date','type'=>'date','attributes'=>$attributes])
<br>
@php
    $attributes=['class'=>'form-control','label'=>'وقت البدء','placeholder'=>'وقت البدء'];
@endphp

@include('form.input',['name'=>'start_time','type'=>'time','attributes'=>$attributes])
<br>
@php
    $attributes=['class'=>'form-control','label'=>'وقت الانتهاء','placeholder'=>'وقت الانتهاء'];
@endphp

@include('form.input',['name'=>'end_time','type'=>'time','attributes'=>$attributes])
@section('scripts')

    @include('admin.layout.tinyMCE_config')
    @include("admin.layout.filemanger_scripts");
@endsection



