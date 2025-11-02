<?php $tax_data = isset($data->tax) && isJson($data->tax) ? json_decode($data->tax) : []; ?>

<?php if (isset($tax_list) && sizeof($tax_list) == 0): ?>
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
								<h4><?= __('tax_configuration'); ?></h4>
								<p> <?= __('please_configure_tax_before_create_a_new_product'); ?></p>
							</div>
						</div>

						<div class="stepBtn">
							<a href="<?= base_url("vendor/settings/tax_configuration"); ?>" target="_blank" class="btn ci-outline-large"><i class="icofont-hand-drag1"></i> <?= __('add_tax'); ?> </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
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
<form action="<?= base_url("vendor/products/add_product") ?>" method="post" onsubmit="formSubmit(event,this);">
	<?= csrf(); ?>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><?= __('create_product_item'); ?></h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="form-group col-md-6">
							<label><?= __('category_name'); ?></label>
							<select name="category_id" id="category_id" class="form-control" onchange="get_subcat(this.value)">
								<option value=""><?= __('select'); ?></option>
								<?php foreach ($category_list as  $category_key => $category) : ?>
									<option value="<?= $category->id; ?>" <?= isset($data->category_id) && $data->category_id == $category->id ? "selected" : ""; ?>>
										<?= __names(
											$category->category_names,
											'category_name'
										); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label><?= __('subcategories'); ?></label>
							<select name="subcategory_id" id="subcategory_id" class="form-control">
								<option value=""><?= __('select'); ?></option>
								<?php if (isset($data->subcategory_id)) : ?>
									<?php $subcategory_list = $this->vendor_m->get_subcategories_by_cat_id($data->category_id); ?>
									<?php foreach ($subcategory_list as  $key => $subcat) : ?>
										<?php $catdata = langData($subcat->id, 'subcategory_id', 'vendor_subcategory_list_ln'); ?>
										<option value="<?= $subcat->id ?>" <?= __checked($subcat->id, $data->subcategory_id, 'selected') ?>>
											<?= isset($catdata) && !empty($catdata) ? __names($catdata, 'subcategory_name', false) : ''; ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
						</div>
					</div>

					<?php if (__feature('variants')) : ?>
						<div class="row">
							<div class="col-md-8">
								<div class="d-flex mb-10">
									<label class="pointer checkBtn c-white btn btn-purple custom-checkbox"><input type="checkbox" name="is_variants" class="is_size defaultToggle" value="1" <?= isset($data->is_variants) && $data->is_variants == 1 ? "checked" : ""; ?>>&nbsp; Is variants</label>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<div class="row itemPriceArea <?= isset($data->is_variants) && $data->is_variants == 1 ? "hidden" : ""; ?>">

						<div class="form-group col-md-6">
							<label><?= __('current_price'); ?></label>
							<div class="ci-input-group input-group-prepand">
								<input type="text" name="price" class="form-control number" placeholder="<?= __('current_price'); ?>" value="<?= __isset($data, 'price', 0); ?>">
								<div class="input-group">
									<span>
										<?= __vcountry()->currency_icon; ?>
									</span>
								</div>
							</div>


						</div>

						<div class="form-group col-md-6">
							<label><?= __('previous_price'); ?></label>
							<div class="ci-input-group input-group-prepand">
								<input type="text" name="previous_price" class="form-control number" placeholder="<?= __('previous_price'); ?>" value="<?= __isset($data, 'previous_price', 0); ?>">
								<div class="input-group">
									<span>
										<?= __vcountry()->currency_icon; ?>
									</span>
								</div>
							</div>
						</div>
					</div>
					<?php if (__vConfig('tax_config', 'is_item_tax') == 1): ?>
						<div class="row">
							<div class="col-md-6 form-group">
								<label><?= __('tax'); ?></label>

								<select name="tax[]" id="tax" class="form-control select2" multiple>
									<?php foreach ($tax_list as  $key => $tax) : ?>
										<option value="<?= $tax->id ?>" <?= in_array($tax->id, $tax_data) ? "selected" : "" ?>><?= $tax->tax_name; ?> (<?= $tax->tax_percentage; ?>%)</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					<?php endif; ?>

					<!----------------------------------------------
					  Multilanguagl area 
					---------------------------------------------->
					<div class="multLangArea">
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<?php foreach (shop_language() as  $key => $ln) : ?>
									<a class="nav-item nav-link <?= $ln['slug'] == __vsettings('language') ? "active" : " "; ?>" id="nav-<?= $ln['slug']; ?>-tab" data-toggle="tab" href="#<?= $ln['slug']; ?>" role="tab" aria-controls="nav-<?= $ln['slug']; ?>" aria-selected="true"> <?= country($ln['country_id'])->flag; ?> &nbsp; <?= $ln['language_name']; ?></a>
								<?php endforeach; ?>
							</div>
						</nav>
						<div class="tab-content pt-10" id="nav-tabContent">
							<?php foreach (shop_language() as  $key => $ln) : ?>

								<?php

								$current_details = null;
								if (isset($data->item_details) && !empty($data->item_details)) :
									foreach ($data->item_details as $details) {
										if ($details->language == $ln['slug']) {
											$current_details = $details;
											break;
										}
									}
								endif;
								?>


								<div class="tab-pane fade <?= $ln['slug'] == __vsettings('language') ? "show active" : ""; ?>" id="<?= $ln['slug']; ?>" role="tabpanel" aria-labelledby="nav-<?= $ln['slug']; ?>-tab" dir="<?= $ln['direction']; ?>">
									<div class="row">
										<div class="form-group col-md-12">
											<label><?= country($ln['country_id'])->flag; ?> <?= __slang($ln['slug'], 'title'); ?></label>
											<input type="text" name="title[<?= $ln['slug']; ?>]" class="form-control" placeholder="<?= __slang($ln['slug'], 'title'); ?>" value="<?= __isset($current_details, 'title'); ?>">
										</div>
									</div>

									<div class="row">
										<div class="col-md-12 show_variatns_price <?= isset($data->is_variants) && $data->is_variants == 1 ? "" : "hidden"; ?> ">
											<div class="card border-radius-0">
												<div class="card-header">
													<h4 class="card-title"><?= __slang($ln['slug'], 'variants'); ?></h4>
													<?= __addbtn('', __slang($ln['slug'], 'add_variants'), ['is_modal' => true, 'target' => 'variantModal_' . $ln['slug']]) ?>
												</div>
												<div class="card-body">
													<div class="variantsLoad_<?= $ln['slug']; ?>">
														<?php include APPPATH . 'views/backend/products/inc/ajax_update_variants.php' ?>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group col-md-12">
											<label> <?= __slang($ln['slug'], 'description'); ?></label>
											<textarea name="description[<?= $ln['slug']; ?>]" class="form-control textarea"><?= __isset($current_details, 'description'); ?></textarea>
										</div>
									</div>
								</div>
								<input type="hidden" name="languages[]" value="<?= $ln['slug']; ?>">
							<?php endforeach; ?>
						</div><!-- tab-content -->

					</div>
					<!----------------------------------------------
					  Multilanguagl area 
					---------------------------------------------->


				</div><!-- card-body -->

			</div>
		</div><!-- col/8 -->
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<label><?= __('images'); ?></label>
						<div class="mb-4">
							<?= media_files('images', 'multiple', __isset($data->images ?? [], 'thumb')); ?>
						</div>

					</div>
					<?php if (__feature('veg_types')) : ?>
						<div class="form-group">
							<label><?= __('food_preference'); ?></label>
							<select name="veg_type" id="veg_type" class="form-control niceSelect">
								<option value=""><?= __('none'); ?></option>
								<option value="veg" <?= isset($data->veg_type) && $data->veg_type == 'veg' ? "selected" : "" ?>><?= __('vegetarian'); ?></option>
								<option value="nonveg" <?= isset($data->veg_type) && $data->veg_type == 'nonveg' ? "selected" : "" ?>><?= __('non_vegetarian'); ?></option>
							</select>
						</div>
					<?php endif; ?>


					<?php if (__feature('allergens')) : ?>
						<?php if (isset($allergen_list) && !empty($allergen_list)) : ?>
							<?php $allergenData = isset($data->allergen_ids) && isJson($data->allergen_ids) ? json_decode($data->allergen_ids) : []; ?>
							<div class="form-group">
								<label><?= __('allergens'); ?></label>
								<select name="allergen_names[]" id="veg_type" class="form-control select2" multiple>
									<?php foreach ($allergen_list as  $key => $allergen) : ?>

										<option value="<?= $allergen->id; ?>" <?= in_array($allergen->id, $allergenData) ? "selected" : "" ?>>
											<?= __names(
												$allergen->_names,
												'allergen_name'
											); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						<?php endif; ?>
					<?php endif; ?>

					<div class="form-group">
						<div class="mt-2rm">
							<label class="custom-checkbox btn btn-info pl-5"><input type="checkbox" name="is_feature" value="1" <?= isset($data->is_feature) && $data->is_feature == 1 ? "checked" : ""; ?>> <?= __('mark_as_feature_item'); ?></label>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					<input type="hidden" name="id" value="<?= __isset($data, 'id', 0) ?>">
					<button type='submit' class='btn btn-primary btn-block '><?= __('submit'); ?> <i class='icofont-hand-drag1'></i></button>
				</div>
			</div>
		</div>
	</div><!-- row -->
</form>




<?php foreach (shop_language() as  $key => $vlang) : ?>
	<?php $vsession = __tempData('variants_' . $vlang['slug']); ?>
	<div id="variantModal_<?= $vlang['slug']; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<form action="<?= base_url('vendor/products/create_product_variants/' . $vlang['slug']) ?>" method="post" enctype="multipart/form-data" class="productVariants" data-lang="<?= $vlang['slug']; ?>">
				<!-- csrf token -->
				<?= csrf(); ?>
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><?= country($vlang['country_id'])->flag; ?> <?= __slang($vlang['slug'], 'add_variants'); ?></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="variantModalBoday">
							<div class="form-group">
								<label><?= __slang($vlang['slug'], 'variant_name'); ?> </label>
								<input type="text" name="variant_name" class="form-control" placeholder="<?= __slang($vlang['slug'], 'variant_name_details'); ?>" value="<?= isset($dataPrice->variant_name) && !empty($dataPrice->variant_name) ? $dataPrice->variant_name : (isset($vsession->variant_name) && !empty($vsession->variant_name) ? $vsession->variant_name : ''); ?>">
							</div>
							<div class="form-group">
								<label> <?= __slang($vlang['slug'], 'variant_options'); ?></label>
								<input type="text" name="variant_options" class="form-control" placeholder="<?= __slang($vlang['slug'], 'variant_description'); ?>" value="<?= isset($vsession->options) && !empty($vsession->options) ? $vsession->options : '' ?>">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-secondary"><?= lang('submit'); ?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php endforeach; ?>

<script>
	function get_subcat(cat_id) {
		var url = `${base_url}vendor/products/get_subcategory/${cat_id}`;
		console.log(url);
		$.get(url, {
			_csrf_token
		}, function(json) {
			console.log(json);
			$('[name="subcategory_id"]').html(json.data);
		}, 'json');
		return false;
	}
</script>


<script>
	$(document).on('change', '[name="is_variants"]', function() {
		if ($(this).is(':checked')) {
			$('.itemPriceArea').slideUp();
			$('.show_variatns_price').slideDown();
		} else {
			$('.itemPriceArea').slideDown();
			$('.show_variatns_price').slideUp();
		}
	});
</script>