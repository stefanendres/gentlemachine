<?php 

    function get_product_tags($product) {
        $product_tags = [];
        foreach (wp_get_post_terms( $product->get_id(), 'product_tag' ) as $product_tag_terms) {
            $product_tag = [
                'slug' => $product_tag_terms->slug,
                'name' => $product_tag_terms->name,
                'icon_url' => wp_get_attachment_image_src(get_field('method_icon', $product_tag_terms)['id'])[0]
            ];
            $product_tags[] = $product_tag;
        }
        return $product_tags;
    };

?>