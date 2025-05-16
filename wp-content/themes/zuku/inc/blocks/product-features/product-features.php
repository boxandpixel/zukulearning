<?php
/**
 * Get variation names
 */

 $product = wc_get_product(get_the_ID());
 $variation_labels = [];
 
 if ($product && $product->is_type('variable')) {
     $available_variations = $product->get_available_variations();
 
     foreach ($available_variations as $variation) {
         $attr_value = $variation['attributes']['attribute_course-type'] ?? null;
         if ($attr_value && !in_array($attr_value, $variation_labels, true)) {
             $variation_labels[] = ucwords(str_replace('-', ' ', $attr_value)); // format nicely
         }
     }
 }
 
 // Fallback if none found
 $variation_labels = $variation_labels ?: ['Premium', 'Standard'];
 $label_premium = $variation_labels[0] ?? 'Premium';
 $label_standard = $variation_labels[1] ?? 'Standard';

/**
 * Start Block
 */
$product_features = $args['product_features'] ?? get_field("product_features");
$heading = $product_features['heading'] ?? '';
$description = $product_features['description'] ?? '';
$feature_rows = $product_features['feature_rows'] ?? [];

// Inline check icon SVG
$check_svg = '<svg class="check-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 8L7 11L12 5" stroke="#1A7F37" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$alt_svg = '<svg class="alt-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 4L12 12M12 4L4 12" stroke="#D92D20" stroke-width="2" stroke-linecap="round"/></svg>';
?>

<section class="product-features">
    <div class="container">

        <div class="product-features__header">
            <?php if ($heading): ?>
                <h2><?= esc_html($heading); ?></h2>
            <?php endif; ?>

            <?php if ($description): ?>
                <div class="feature-comparison__description">
                    <?= wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>


        <div class="product-features__table">
            <?php if (!empty($feature_rows)): ?>
                <!-- Desktop Table -->
                <table class="product-features__table product-features__table--desktop">
                <colgroup>
                    <col style="width: auto;">
                    <col style="width: 188px;">
                    <col style="width: 188px;">
                </colgroup>                    
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th><?= esc_html($label_premium); ?></th>
                            <th><?= esc_html($label_standard); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($feature_rows as $row):
                            $feature_label = $row['feature_label'] ?? '';
                            $display_type = $row['feature_display_type'] ?? 'image';

                            // Image type: use boolean icons
                            $premium_icon = !empty($row['premium_included_icon']) ? '<div class="product-features-included product-features-included__included">Included</div>' : '';
                            $standard_icon = !empty($row['standard_included_icon']) ? '<div class="product-features-included product-features-included__included">Included</div>' : '';

                            // Text type: use custom text fields
                            $premium_text = $row['premium_included_text'] ?? '';
                            $standard_text = $row['standard_included_text'] ?? '';
                        ?>
                            <tr>
                                <td class="table-features"><?= esc_html($feature_label); ?></td>
                                <td>
                                    <?= ($display_type === 'custom-text' && $premium_text) ? esc_html($premium_text) : $premium_icon; ?>
                                </td>
                                <td>
                                    <?= ($display_type === 'custom-text' && $standard_text) ? esc_html($standard_text) : $standard_icon; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="product-features__table product-features__table--mobile">

                    <!-- Premium Features -->
                    <div class="product-features__table-mobile product-features__table-mobile--premium">
                        <h3 class="product-features__heading"><?= esc_html($label_premium); ?></h3>
                        <?php foreach ($feature_rows as $row):
                            $feature_label = $row['feature_label'] ?? '';
                            $display_type = $row['feature_display_type'] ?? 'image';
                            $has_icon = !empty($row['premium_included_icon']);
                            $premium_text = $row['premium_included_text'] ?? '';
                            $mobile_premium_text = $row['mobile_premium_included_text'] ?? '';

                            if ($display_type === 'custom-text') {
                                $premium_icon = empty($premium_text) ? '<div class="product-features-included product-features-included__notIncluded">not Included</div>' : '<div class="product-features-included product-features-included__included">Included</div>';
                            } else {
                                $premium_icon = $has_icon ? '<div class="product-features-included product-features-included__included">Included</div>' : '<div class="product-features-included product-features-included__notIncluded">not Included</div>';
                            }
                        ?>
                            <div class="product-features__mobile-row">
                                <div class="product-features__featured-item">
                                    <div class="product-features__icon"><?= $premium_icon; ?></div>
                                    <div class="product-features__text">
                                        <?php if ($display_type !== 'custom-text') : ?>
                                            <?= esc_html($feature_label); ?>
                                        <?php endif; ?>
                                        <?php if (!empty($mobile_premium_text)) : ?>
                                            <?= wp_kses_post($mobile_premium_text); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Standard Features -->
                    <div class="product-features__table-mobile product-features__table-mobile--standard">
                        <h3 class="product-features__heading"><?= esc_html($label_standard); ?></h3>
                        <?php foreach ($feature_rows as $row):
                            $feature_label = $row['feature_label'] ?? '';
                            $display_type = $row['feature_display_type'] ?? 'image';
                            $has_icon = !empty($row['standard_included_icon']);
                            $standard_text = $row['standard_included_text'] ?? '';
                            $mobile_standard_text = $row['mobile_standard_included_text'] ?? '';

                            if ($display_type === 'custom-text') {
                                $standard_icon = empty($standard_text)
                                    ? '<div class="product-features-included product-features-included__notIncluded">not Included</div>'
                                    : '<div class="product-features-included product-features-included__included">Included</div>';
                            } else {
                                $standard_icon = $has_icon
                                    ? '<div class="product-features-included product-features-included__included">Included</div>'
                                    : '<div class="product-features-included product-features-included__notIncluded">not Included</div>';
                            }
                    
                            // Add conditional class when not available
                            $standard_text_class = (
                                ($display_type === 'custom-text' && empty($standard_text)) ||
                                ($display_type !== 'custom-text' && !$has_icon)
                            ) ? 'product-features__text product-features__text--notIncluded' : 'product-features__text';                            

                            if ($display_type === 'custom-text') {
                                $standard_icon = empty($standard_text) ? '<div class="product-features-included product-features-included__notIncluded">not Included</div>' : '<div class="product-features-included product-features-included__included">Included</div>';
                            } else {
                                $standard_icon = $has_icon ? '<div class="product-features-included product-features-included__included">Included</div>' : '<div class="product-features-included product-features-included__notIncluded">not Included</div>';
                            }
                        ?>
                            <div class="product-features__mobile-row">
                                <div class="product-features__featured-item">
                                    <div class="product-features__icon"><?= $standard_icon; ?></div>
                                    <div class="<?= esc_attr($standard_text_class); ?>">
                                        <?php if ($display_type !== 'custom-text') : ?>
                                            <?= esc_html($feature_label); ?>
                                        <?php endif; ?>
                                        <?php if (!empty($mobile_standard_text)) : ?>
                                            <?= wp_kses_post($mobile_standard_text); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>

            <?php endif; ?>
        </div>

    </div>
</section>
