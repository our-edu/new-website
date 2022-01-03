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
                        <h1>عرض مقاله</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">الرئيسيه</a></li>
                            <li class="breadcrumb-item active">عرض المقاله</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="ftco-section ftco-degree-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 ftco-animate">
                        <p class="mb-5">
                            <img src={{asset('assets/images/mada.png')}} alt="" class="img-fluid">
                        </p>
                        <p> {!! $row->created_at!!}</p>
                        <h3> {!! $row->title!!}</h3>
                        <p> {!! $row->article_content!!}</p>

                        <div class="about-author d-flex p-4 bg-light">
                            <div class="desc">
                                <h3>{{ $row->author}}</h3>
                            </div>
                        </div>



                    </div> <!-- .col-md-8 -->

                </div>
            </div>
        </section> <!-- .section -->
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@include('admin.layout.footer')

</html>
