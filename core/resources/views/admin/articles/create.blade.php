<!DOCTYPE html>
<html lang="en">
@includeFirst(['admin.layout.header'])

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>انشاء مقاله</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">الرئيسيه</a></li>
                            <li class="breadcrumb-item active">انشاء مقاله</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="section-wrapper">
                <div class="form-layout form-layout-3">
                {!! Form::model($row,['method' => 'post','files' => true ] ) !!}
                {{ csrf_field() }}

                @include('admin.'.$module.'.form',$row)
                <!-- custom-file -->
                    <div class="form-layout-footer mg-t-50">
                        <button class="btn btn-primary bd-5">حفظ</button>
                    </div>
                {!! Form::close() !!}
                <!-- form-layout-footer -->
                </div>
                <!-- form-layout -->
            </div>
        </section>
        <!-- /.content -->
    </div>
<br>
<br>
<br>
    <!-- /.content-wrapper -->
@include('admin.layout.footer')

</html>
