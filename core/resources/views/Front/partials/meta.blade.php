<meta name="keywords" content="{{$row->meta()->count() > 0 ? $row->meta->meta_keys : null}}">
<meta name="description" content="{{$row->meta()->count() > 0 ? $row->meta->meta_description : null}}">
//og data
<meta property=”og:title” content=”{{$row->title}}” />
<meta property=”og:url” content=”{{$route}}” />
<meta property=”og:type” content=”website” />
<meta property=”og:description” content=”{{$row->meta()->count() > 0 ? $row->meta->meta_description : null}}” />