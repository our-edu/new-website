@php
    $attributes=['class'=>'form-control','label'=>'اسم الكتاب','placeholder'=>'اسم الكتاب'];
@endphp

@include('form.input',['name'=>'name','type'=>'text','attributes'=>$attributes])

@php
    $attributes=['class'=>'form-control','label'=>'اسم المؤلف','placeholder'=>'اسم المؤلف'];
@endphp

@include('form.input',['name'=>'author','type'=>'text','attributes'=>$attributes])

@php
    $attributes=['class'=>'form-control','label'=>'تاريخ النشر','placeholder'=>'تاريخ النشر'];
@endphp

@include('form.input',['name'=>'publish_date','type'=>'date','attributes'=>$attributes])

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


@include('form.file',[
 'name'=>'post_img',
 'value'=> $row->book_img,
 'class' => 'form-control',
 'attributes'=>[
 'label'=>'الصوره',
 'placeholder'=>'الصوره',
 ]])



@include('form.boolean',['value'=> $row->is_active ?? null,'name'=>'is_active','attributes'=>['label'=>'نشط' ,'required'=>1]])
@include('form.boolean',['value'=> $row->is_featured ?? null,'name'=>'is_featured','attributes'=>['label'=>'عرض' ,'required'=>1]])




<script>
    CKEDITOR.replace( 'description' );
</script>
