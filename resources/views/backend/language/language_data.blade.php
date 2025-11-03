@extends('backend.admin.layouts.app')

@section('content')
    <div class="ci-paginationArea">
        <div class="row ">
            <div class="col-md-8">
                <div class="hide_lang_details mb-1rm">
                    <label class="fz-1rm"><input type="checkbox" value="1" class="details_check">
                        <?= lang('show_details') ?></label>
                </div>
            </div>
            <div class="col-md-12 col-lg-10 mb-2rm">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('add/language_data') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label><?= lang('keyword') ?></label>
                                    <input type="text" name="keyword" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label><?= lang('value') ?></label>
                                    <input type="text" name="value" class="form-control">
                                </div>
                                <?= hidden('id', 0) ?>
                                <div class="col-md-3 mt-12">
                                    <div class="">
                                        <button type="submit" class="btn-primary custom_btn btn mt-20"><i
                                                class="icofont-hand-drag1"></i> <?= lang('submit') ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?= __('language_data') ?> </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="card-body">

                        <div class="langauageFilter space-between flex-row align-center gap-1rm mb-2rm">

                            <select name="limit" class="form-control wd-5rm " id=""
                                onchange="location=this.value;">
                                <option value=""
                                    <?= isset($_GET['limit']) && $_GET['limit'] == 30 ? 'selected' : '' ?>>30</option>
                                <option value=""
                                    <?= isset($_GET['limit']) && $_GET['limit'] == 50 ? 'selected' : '' ?>>50</option>
                                <option value=""
                                    <?= isset($_GET['limit']) && $_GET['limit'] == 100 ? 'selected' : '' ?>>100</option>
                                <option value=""
                                    <?= isset($_GET['limit']) && $_GET['limit'] == 200 ? 'selected' : '' ?>>200</option>
                                <option value=""
                                    <?= isset($_GET['limit']) && $_GET['limit'] == 300 ? 'selected' : '' ?>>300</option>
                                <option value=""
                                    <?= isset($_GET['limit']) && $_GET['limit'] == 500 ? 'selected' : '' ?>>500</option>
                            </select>
                            <div class="searchArea text-right">
                                <form action="<?= url('admin/dashboard_languages') ?>" method="get" class="">
                                    <div class="input-group">
                                        <input type="text" name="q" class="form-control h-i"
                                            placeholder="<?= lang('search') ?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-secondary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="active nav-item nav-link" data-toggle="tab" href="#en"
                                    role="tab">English</a>
                                <a class=" nav-item nav-link" data-toggle="tab" href="#ar" role="tab">عربي</a>
                                <a class=" nav-item nav-link" data-toggle="tab" href="#es" role="tab">Español</a>
                            </div>
                        </nav>



                        <div class="tab-content">
                            <div id="en" class="tab-pane fade in active show">
                                <div class="row flex justify-content-end">
                                    <div class="text-right col-md-12">

                                        <div class="exportDataArea mt-1rm  mb-1rm">
                                            <a href="#lnModal_en" data-toggle="modal" class="btn btn-success btn-sm"><i
                                                    class="icofont-upload"></i>
                                                <?= lang('import') ?> </a>
                                            <a href="" class="btn btn-secondary btn-sm"> <i
                                                    class="icofont-download"></i>
                                                <?= lang('export') ?></a>

                                        </div>
                                    </div>

                                </div>
                                <form action="" method="post">
                                    @csrf

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="20%">
                                                        <?= !empty(lang('keyword')) ? lang('keyword') : 'Keyword' ?></th>
                                                    <th class="hide_details " width="30%">
                                                        <?= !empty(lang('details')) ? lang('details') : 'Details' ?></th>
                                                    <th width="45%">
                                                        <?= !empty(lang('value')) ? lang('value') : 'value' ?></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>add_new</td>
                                                    <td class="hide_details">
                                                        <input type="text" name="details[]" class="form-control"
                                                            value="Add New">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="en[]" class="form-control"
                                                            value="Add New">
                                                    </td>
                                                </tr>
                                                <input type="hidden" name="keyword[]" value="">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit"
                                            class="btn btn-info btn-block"><?= !empty(lang('save_change')) ? lang('save_change') : 'save change' ?></button>
                                    </div>
                                </form>
                            </div>
                            <!--  -->
                        </div>
                    </div><!-- /.box-body -->
                    <section>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="paginationArea mb-1rm">

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>


        </div>

        <!-- Modal -->
        <div id="lnModal_en" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">english</h4>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="file" name="file" required accept=".json">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><?= lang('submit') ?></button>
                        </div>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection
