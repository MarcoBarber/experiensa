<?php
/*
Title: Voyage
Post Type: voyage
Meta box: true
Tab: General
Flow: Voyage Workflow
*/

$price = array(
    'type'  => 'number',
    'field' => 'voyage_price',
    'label' => __('Price','sage'),
    'attributes'    => array( 'step' => 'any' ),
    'columns'   => 4
);

$currency = array(
    'type'      => 'select',
    'field'     => 'voyage_currency',
    'label'     => __('Currency','sage'),
    'choices'   => array(
        'CHF'   =>  'CHF',
        'USD'   =>  'USD',
        'EUR'   =>  'EUR',
    ),
    'columns'   => 4
);

$expiry_date = array(
    'type'      => 'datepicker',
    'field'     => 'voyage_expiry_date',
    'label'     => __('Expiry date','sage'),
    'columns'   => 4
);

$slogan = array(
    'type'      => 'text',
    'field'     => 'voyage_slogan',
    'columns'   => 12,
    'label'     => __('Voyage slogan','sage')
);

piklist('field', array(
    'type'      => 'group',
    'label'     => __('General info','sage'),
    'fields'    => array(
        $price,
        $currency,
        $expiry_date,
        $slogan
    )
));

piklist('field', array(
    'type' => 'group',
    'scope' => 'post_meta',
    'label' => __('Number of Days'),
    'fields' => array(
        array(
            'type'          => 'text',
            'field'         => 'voyage_days',
            'columns'       => 2,
            'attributes'    => array( 'placeholder' => __('Days','sage')),
            'validate'      => array( array( 'type' => 'number' ))
        ),
        array(
            'type'          => 'text',
            'field'         => 'voyage_nights',
            'columns'       => 2,
            'attributes' => array( 'placeholder' => __('Nights')),
            'validate' => array( array( 'type' => 'number' ) )
        ),
    ),
));

piklist('field', array(
    'type'          => 'checkbox',
    'field'         => 'voyage_conditions',
    'label'         => __('Conditions','sage'),
    'choices'       => array(
        'refundable'    => __('Refundable','sage'),
        'flexible'      => __('Flexible','sage')
    ),
));

piklist('field', array(
    'type'      => 'group',
    'label'     => __('Resell to other agencies?','sage'),
    'fields'    => array(
        array(
            'type'      => 'checkbox',
            'field'     => 'voyage_is_tour_operator',
            'label'     => __('Resell','sage'),
            'columns'   => 6,
            'choices'   => array( 'TRUE'  => 'Yes' )
        ),
        array(
            'type'          => 'number',
            'field'         => 'voyage_tour_operator_margin',
            'columns'       => 6,
            'label'         => __('Margin (%)','sage'),
            'attributes'    => array( 'step' => 'any' ),
            'conditions'    => array(
                array(
                    'field' => 'voyage_is_tour_operator',
                    'value' => 'TRUE'
                ),
            ),
        ),
    ),
));

piklist('field', array(
    'type'  => 'editor',
    'field' => 'voyage_information_conditions',
    'label' => __('Additional information & Conditions','sage')
));

piklist('field', array(
    'type'  => 'file',
    'field' => 'voyage_gallery',
    'label' => __('Photo Gallery','sage')
));