<?php
echo zuhaus_mikado_get_button_html(
    array(
        'custom_class' => 'mkdf-property-filter-button',
        'html_type'    => 'button',
        'size'         => 'medium',
        'type'         => 'solid',
        'text'         => esc_html__( 'Filter Results', 'mkdf-real-estate' )
    )
);
?>
<span class="mkdf-property-query-section">
    <?php
    echo zuhaus_mikado_get_button_html(
        array(
            'custom_class'  => 'mkdf-property-save-search-button',
            'html_type'     => 'button',
            'size'          => 'medium',
            'type'          => 'outline',
            'text'          => esc_html__( 'Save Search', 'mkdf-real-estate' ),
            'color'         => '#000000',
            'hover_color'   => '#000000'
        )
    );
    ?>
    <span class="mkdf-query-result">

    </span>
</span>
<span class="mkdf-reset-filter-section">
    <?php
    echo zuhaus_mikado_get_button_html(
        array(
            'custom_class'  => 'mkdf-property-filter-reset-button',
            'html_type'     => 'button',
            'size'          => 'medium',
            'icon_pack'     => 'font_elegant',
            'fe_icon'       => 'arrow_carrot-right',
            'type'          => 'simple',
            'text'          => esc_html__( 'Reset', 'mkdf-real-estate' )
        )
    );
    ?>
</span>