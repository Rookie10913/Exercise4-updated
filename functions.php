<?php
defined('ABSPATH') or die ('Permission denied');

function zpt_calc_menu_admin(){
    add_menu_page('Calculator Demo', 'Calculator Demo', 'administrator', 'calculator_demo', 'calculator_demo_settings', 'dashicons-performance');
}

function calculator_demo_settings(){
    if( isset ( $_POST['calc_settings_update'] ) ) {
        
        if ( ! isset( $_POST['calc_nonce'] ) 
            || ! wp_verify_nonce( $_POST['calc_nonce'] ) 
        ) {
            wp_die ( "Invalid Nonce. Reload the page and try again!" );
        }
        
        
        if( isset( $_POST['calc_constant'] ) ){
            
            
            $calc_constant = sanitize_text_field( $_POST['calc_constant'] );
            
            update_option( 'calc_constant', $calc_constant );
            
        }
       
        if( isset( $_POST['calc_constant_show'] ) ){
            
            $calc_constant_show = sanitize_text_field( $_POST['calc_constant_show'] );
            
            update_option( 'calc_constant_show', 'yes' );
            
        }
        else{
            update_option( 'calc_constant_show', 'no' );
        }
        
    }

    $checked = '';
    $val = get_option('calc_constant_show');
    if($val == 'yes'){
        $checked = 'checked';
    }

?>    
    <style type="text/css">
        .text-success{
            color: lightgreen;
        }
    </style>   
    <div class="wrap calc">
        <h1>Calculator Constant Settings</h1>
        <hr>
        <form class="" method="post">
            <?php wp_nonce_field(-1, "calc_nonce");?>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th>Set Constant</th>
                        <td>
                            <input type="text" name="calc_constant" value="<?=get_option('calc_constant');?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th>Display Constant on Frontend</th>
                        <td>
                            <input type="checkbox" name="calc_constant_show" value="<?=get_option('calc_constant_show');?>" <?=$checked?> class="regular-text">
                            
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <p>
                <button type="submit" class="button button-primary" name="calc_settings_update">Submit</button>
            </p>
        </form>
    </div>
<?php    
}

function calculator_display(){
    $constant = get_option('calc_constant_show');
    ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <div class="container mt-5 calc-container border">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h4>Enter Bitcoin amount</h4>
                    <div class="form-group">
                        <input type="number" name="mutliple" id="mutiple" class="form-control">
                        <?php
                        if(!empty($constant) && $constant == 'yes'){
                            echo '<h5>  Cinstant is:  '.get_option('calc_constant').'</h5>';
                        }
                        ?>
                    </div>
                    
                        
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div class="form-group">
                        <h4 class="USD mt-5"></h4>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script>
            let constant_var = <?=get_option('calc_constant')?>;
            jQuery(document).ready(function(){
                $(document).on('keyup', 'input[name="mutliple"]', function(){
                    if(!$('input[name="viceversa"]').is(':checked')){
                        $('.calc-container').find('.USD').html('USD = <span class="text-success">'+$(this).val()*constant_var+'</span>');
                    }
                    else{
                        $('.calc-container').find('.USD').html('USD = <span class="text-success">'+$(this).val()/constant_var+'</span>');
                    }    
                });
            });
        </script>
    <?php
}
add_shortcode('DISPLAY_CALCU', 'calculator_display');