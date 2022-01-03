<!DOCTYPE html>
<html lang="ar">
@includeFirst(['admin.layout.header'])

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>قائمه الفيديوهات</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">الرئيسيه</a></li>
                            <li class="breadcrumb-item active">قائمه الفيديوهات</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="p-2">
                <a href="videos/create" class="btn btn-success">
                    <i class="fa fa-plus"></i> انشاء فيديو
                </a>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>العنوان</th>
                                        <th>الوصف</th>
                                        <th>رابط الفيديو</th>
                                        <th>video_embed</th>
                                        <th></th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($rows as $row)
                                        <tr>
                                            <td>{{$row->title}}</td>
                                            <td>{{ Str::limit($row->description, 10) }}</td>
                                            <td>{{$row->video_url}}</td>
                                            <td>{{$row->video_embed}}</td>
                                            <td class="text-center">

                                                @if(request('deleted') != 'yes')
                                                    <a class="btn btn-success btn-xs" href="{{$module}}/edit/{{$row->uuid}}" title="تعديل">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form  class="d-inline" method="POST" title="حذف" action="{{route('videos.delete' , $row->uuid)}}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button  type="submit" class="btn btn-danger btn-xs" value="Delete celebrities"
                                                                 data-confirm="هل انت متاكد من حذف هذا العنصر ؟">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">لا يوجد بيانات</td>
                                        </tr>
                                    @endforelse

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@include('admin.layout.footer')

</html>
