<!-- TITLE  -->
@section('title', 'Profile User')

<!-- EXTENTION WITH HEADER  -->
@extends('OpratorTeam.headers_oprators')

<!-- REQUIRE PAGE  -->
@section('content')
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main sidebar-default sidebar-separate">
            <div class="sidebar-content">

                <!-- User details -->
                <div class="content-group">
                    <div class="panel-body bg-slate-700 border-radius-top text-center">

                        <a href="#" class="display-inline-block content-group-sm">
                            <img src="{{ asset('assets/images/user_default.png') }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                        </a>
                        <div class="content-group-sm">
                            <h6 class="text-semibold no-margin-bottom">
                                {{ Auth::user()->name }}
                            </h6>
                            <span class="display-block">Oprator's / Admin</span>
                        </div>
                    </div>

                    <div class="panel no-border-top no-border-radius-top">
                        <ul class="navigation">
                            <li class="navigation-header">Navigation</li>
                            <li class="active"><a href="#profile" data-toggle="tab"><i class="icon-files-empty"></i> Profil</a></li>
                            <li><a href="#absen" data-toggle="tab"><i class="icon-files-empty"></i> Log Absen</a></li>
                            <li><a href="#aktivitas" data-toggle="tab"><i class="icon-files-empty"></i> Log Aktivitas</a></li>
                            <!-- <li class="navigation-divider"></li>  -->
                        </ul>
                    </div>
                </div>
                <!-- /user details -->


                <!-- Partner Team -->
                <div class="sidebar-category">
                    <div class="category-title">
                        <span>Partner Team</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                        </ul>
                    </div>

                    <div class="category-content">
                        <ul class="media-list">
                            <li class="media">
                                <a href="#" class="media-left"><img src="{{ asset('assets/images/user_default.png') }}" class="img-sm img-circle" alt=""></a>
                                <div class="media-body">
                                    <a href="#" class="media-heading text-semibold">Users 1</a>
                                    <span class="text-size-mini text-muted display-block">Front End Dev</span>
                                </div>
                                <div class="media-right media-middle">
                                    <span class="status-mark border-success"></span>
                                </div>
                            </li>

                            <li class="media">
                                <a href="#" class="media-left"><img src="{{ asset('assets/images/user_default.png') }}" class="img-sm img-circle" alt=""></a>
                                <div class="media-body">
                                    <a href="#" class="media-heading text-semibold">Users 2</a>
                                    <span class="text-size-mini text-muted display-block">Back End Dev</span>
                                </div>
                                <div class="media-right media-middle">
                                    <span class="status-mark border-danger"></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /partner Team -->

            </div>
        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Tab content -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="profile">
                    <!-- Profile info -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Profile information</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <form action="#">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Username</label>
                                            <input type="text" value="Eugene" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Full name</label>
                                            <input type="text" value="Kopyov" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Address line 1</label>
                                            <input type="text" value="Ring street 12" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Address line 2</label>
                                            <input type="text" value="building D, flat #67" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>City</label>
                                            <input type="text" value="Munich" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>State/Province</label>
                                            <input type="text" value="Bayern" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>ZIP code</label>
                                            <input type="text" value="1031" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                            <input type="text" readonly="readonly" value="eugene@kopyov.com" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Your country</label>
                                            <select name="select" class="form-control">
                                                <option value="opt1">Usual select box</option>
                                                <option value="opt2">Option 2</option>
                                                <option value="opt3">Option 3</option>
                                                <option value="opt4">Option 4</option>
                                                <option value="opt5">Option 5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Phone #</label>
                                            <input type="text" value="+99-99-9999-9999" class="form-control">
                                            <span class="help-block">+99-99-9999-9999</span>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="display-block">Upload profile image</label>
                                            <input type="file" class="file-styled">
                                            <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" id="btn-save">Save <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /profile info -->

                    <!-- Account settings -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Change Password</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <form action="#">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Current password</label>
                                            <input type="password" value="password" readonly="readonly" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>New password</label>
                                            <input type="password" placeholder="Enter new password" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Repeat password</label>
                                            <input type="password" placeholder="Repeat new password" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /account settings -->
                </div>

                <div class="tab-pane fade" id="absen">
                    <!-- My inbox -->
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h6 class="panel-title">Log Absen</h6>

                            <div class="heading-elements not-collapsible">
                                <span class="label bg-green heading-text">Log 1 Bulan</span>
                            </div>
                        </div>

                        <div class="panel-toolbar panel-toolbar-inbox">
                            <div class="navbar navbar-default">
                                <ul class="nav navbar-nav visible-xs-block no-border">
                                    <li>
                                        <a class="text-center collapsed" data-toggle="collapse" data-target="#inbox-toolbar-toggle-multiple">
                                            <i class="icon-circle-down2"></i>
                                        </a>
                                    </li>
                                </ul>

                                <div class="navbar-collapse collapse" id="inbox-toolbar-toggle-multiple">
                                    <div class="btn-group navbar-btn">
                                        <button type="button" class="btn btn-primary"><i class="icon-enter"></i> <span class="hidden-xs position-right">Absen Masuk</span></button>
                                        <button type="button" class="btn btn-danger"><i class="icon-exit"></i> <span class="hidden-xs position-right">Absen Keluar</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-inbox table-lg">
                                <tbody data-link="row" class="rowlink">
                                    <tr>
                                        <td class="table-inbox-star rowlink-skip">
                                            <i class="icon-star-full2 text-muted"></i>
                                        </td>
                                        <td class="table-inbox-message">
                                            <span class="table-inbox-preview">Melakukan Absen Keluar Pada Tanggal 2022-06-10</span>
                                        </td>
                                        <td class="table-inbox-time">
                                            20:04
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="table-inbox-star rowlink-skip">
                                            <i class="icon-star-full2 text-muted"></i>
                                        </td>
                                        <td class="table-inbox-message">
                                            <span class="table-inbox-preview">Management Inventory * Melakukan Update stok pada barang AC</span>
                                        </td>
                                        <td class="table-inbox-time">
                                            10:35
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="table-inbox-star rowlink-skip">
                                            <i class="icon-star-full2 text-muted"></i>
                                        </td>
                                        <td class="table-inbox-message">
                                            <span class="table-inbox-preview">Management Inventory * Menambahkan data stok AC baru</span>
                                        </td>
                                        <td class="table-inbox-time">
                                            10:21
                                        </td>
                                    </tr>

                                    <tr >
                                        <td class="table-inbox-star rowlink-skip">
                                            <i class="icon-star-empty3 text-muted"></i>
                                        </td>
                                        <td class="table-inbox-message">
                                            <span class="table-inbox-preview">Melakukan Absen Masuk Pada Tanggal 2022-06-10</span>
                                        </td>
                                        <td class="table-inbox-time">
                                            09:10
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="table-inbox-star rowlink-skip">
                                            <i class="icon-star-full2 text-muted"></i>
                                        </td>
                                        <td class="table-inbox-message">
                                            <span class="table-inbox-preview">Melakukan Absen Keluar Pada Tanggal 2022-06-09</span>
                                        </td>
                                        <td class="table-inbox-time">
                                            19:26
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /my inbox -->
                </div>

                <div class="tab-pane fade" id="aktivitas">

                    <!-- Available hours -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Sample Menu</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <h4 class="text-muted text-center"> SAMPLE MENU</h4>
                        </div>
                    </div>
                    <!-- /available hours -->


                    <!-- Calendar -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Sample Menu</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <h4 class="text-muted text-center"> SAMPLE MENU</h4>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /tab content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
@endsection