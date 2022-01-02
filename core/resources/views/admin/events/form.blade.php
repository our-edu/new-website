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
@include('form.file',[
 'name'=>'post_img',
 'value'=> $row->event_img,
 'class' => 'form-control',
 'attributes'=>[
 'label'=>'الصوره',
 'placeholder'=>'الصوره',
 ]])
@php
    $attributes=['class'=>'form-control','label'=>'تاريخ النشاط','placeholder'=>'تاريخ النشاط'];
@endphp

@include('form.input',['name'=>'event_date','type'=>'date','attributes'=>$attributes])

@php
    $attributes=['class'=>'form-control','label'=>'وقت البدء','placeholder'=>'وقت البدء'];
@endphp

@include('form.input',['name'=>'start_time','type'=>'time','attributes'=>$attributes])

@php
    $attributes=['class'=>'form-control','label'=>'وقت الانتهاء','placeholder'=>'وقت الانتهاء'];
@endphp

@include('form.input',['name'=>'end_time','type'=>'time','attributes'=>$attributes])




<script>
    CKEDITOR.replace( 'description' );
</script>
