<?php if (isset($category_list) && sizeof($category_list) < 1): ?>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<div class="guideStep d-flex space-between align-center">
						<div class="stepTopArea d-flex align-center gap-20">
							<div class="step">
								1
							</div>
							<div class="stepDetails">
								<h4><?= __('add_categories'); ?></h4>
								<p> <?= __('you_have_to_add_category_before_create_a_new_product'); ?></p>
							</div>
						</div>

						<div class="stepBtn">
							<a href="<?= base_url("vendor/products/categories"); ?>" target="_blank" class="btn ci-outline-large"><i class="icofont-hand-drag1"></i> <?= __('add_categories'); ?> </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex gap-10 flex-1 align-center">
					<h5 class="card-title flex-0"><?= __('product_list'); ?></h5>
				</div>
				<div class="card-tools">
					<a href="<?= base_url("vendor/products/create_products"); ?>" class="btn btn-secondary text-right btn-sm addBtn"><i class="fa fa-plus"></i> <?= __('add_new'); ?></a>
				</div>
			</div>

			<div class="card-body pt-10">
				<div class="productCategoryList">
					<ul class="menuUl flex-nowrap">
						<li class="<?= !isset($get['category']) ? 'active' : ''; ?>"><a href="<?= base_url("vendor/products/"); ?>" class="px-1rm py-10"> <i class="fa fa-list"></i> <?= __('all'); ?></a></li>
						<?php foreach ($category_list as  $cat => $category): ?>
							<li class="<?= isset($get['category']) && $get['category'] == str_slug($category->category_name) ? 'active' : ''; ?>"><a href="<?= base_url("vendor/products/?category=" . str_slug($category->category_name)); ?>"> <img src="<?= __image(_x($category->thumb), 'thumb'); ?>" alt="category_image" class="avatar round"> <span class="badge badge-success"><?= _x($category->total_items); ?></span> <?= _x($category->category_name); ?></a></li>
						<?php endforeach; ?>

					</ul>
				</div>
				<div class="card-content">
					<div class="table-responsive responsiveTable">
						<table class="table table-bordered table-striped  data-table">
							<thead>
								<tr>
									<th>#</th>
									<th><?= __('image'); ?></th>
									<th><?= __('title'); ?></th>
									<th width="30%"><?= __('price'); ?></th>
									<th><?= __('extras'); ?></th>
									<th width="15%"><?= __('action'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($product_list as $key => $row) : ?>
									<tr id="hide_<?= $row->id; ?>" data-label="#">
										<td data-label="#"><?= $key + 1; ?></td>
										<td data-label="<?= __('image'); ?>">
											<?php
											$images = [];
											if (strpos($row->thumb, ',') !== false) {
												$images = explode(',', $row->thumb);
											} else {
												$images[] = $row->thumb;
											}
											?>
											<div class="productMixImg">
												<?php foreach ($images as $img) : ?>
													<img src="<?= __image($img, 'thumb') ?>" alt="product_img" class="avatar round">
												<?php endforeach; ?>
											</div>

										</td>
										<td data-label="<?= __('title'); ?>">
											<?= __names($row->item_details, 'title', true); ?>
										</td>
										<td data-label="<?= __('price'); ?>">
											<?= __variants($row, _ID(), '', true) ?>
										</td>
										<td data-label="<?= __('extras'); ?>">
											<?= __vegType($row, true); ?>
											<div class="d-flex">
												<?= __('tax'); ?> : &nbsp;<?= __itemTax($row->id) ?>
											</div>
										</td>
										<td class="text-center" data-label="<?= __('action'); ?>">
											<div class="btnGroup">
												<a class="btn btn-secondary btn-sm" href="<?= base_url("item/" . md5($row->id)) ?>" target="_blank"><i class="fa fa-eye"></i> <?= __('view'); ?></a>

												<a class="btn btn-info btn-sm" href="<?= base_url("/vendor/products/addons/{$row->id}") ?>"><i class="icofont-library"></i> <?= __('addons'); ?></a>


												<a class="btn btn-primary btn-sm" href="<?= base_url("/vendor/products/edit_product/{$row->id}") ?>"><i class="fa fa-edit"></i> <?= __('edit'); ?></a>



												<a href="<?= base_url("delete-item/{$row->id}/vendor_item_list") ?>" data-id="<?= $row->id; ?>" data-msg="<?= __('want_to_delete'); ?>" class="action_btn btn btn-danger btn-sm"><i class="fa fa-trash"></i>
													<?= __('delete'); ?></a>
											</div>



										</td>
									</tr>
								<?php endforeach ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>