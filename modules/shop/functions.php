<?php 

    function get_product_tags($product_id) {
        $product_tags = [];
        foreach (wp_get_post_terms( $product_id, 'product_tag' ) as $product_tag_terms) {
            $product_tag = [
                'slug' => $product_tag_terms->slug,
                'name' => $product_tag_terms->name,
                'icon_url' => wp_get_attachment_image_src(get_field('method_icon', $product_tag_terms)['id'])[0]
            ];
            $product_tags[] = $product_tag;
        }
        return $product_tags;
    };

    // hide subscriptions in shop
    function gm_hide_products_category_shop( $q ) {
        if (!is_product_category()) {
            $tax_query = (array) $q->get( 'tax_query' );
            $tax_query[] = array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => array( 'subscription' ), // Category slug here
                'operator' => 'NOT IN'
            );
            $q->set( 'tax_query', $tax_query );
        }
    }
    add_action( 'woocommerce_product_query', 'gm_hide_products_category_shop' );

?>