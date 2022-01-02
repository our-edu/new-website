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
                    <h1>اتصل بنا</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">الرئيسيه</a></li>
                        <li class="breadcrumb-item active">اتصل بنا</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@section('content')
<div class="section-wrapper">

    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered pull-left">


            <tr>
                <td width="25%" class="align-left">الاسم</td>
                <td width="75%" class="align-left">{{@$row->name}}</td>
            </tr>

            <tr>
                <td width="25%" class="align-left">البريد الالكتروني</td>
                <td width="75%" class="align-left">{{@$row->email}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">الرساله</td>
                <td width="75%" class="align-left">{{@$row->message}}</td>
            </tr>


        </table>
    </div>
</div>
@endsection
