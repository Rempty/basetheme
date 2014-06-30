<?php
/**** BOF Custom Theme Config ***/
function setup_theme_admin_menus() {
    add_menu_page('Theme settings', 'Theme Settings', 'manage_options',
        'tut_theme_settings', 'theme_settings_page');

    add_submenu_page('tut_theme_settings',
        'Front Page Elements', 'Google Analitycs', 'manage_options',
        'front-page-elements', 'theme_front_page_settings');
        
    add_submenu_page('tut_theme_settings',
        'Sidebar Elements', 'Sidebar Settings', 'manage_options',
        'sidebar-elements', 'theme_front_page_sidebar');
}

// We also need to add the handler function for the top level menu
add_action("admin_menu", "setup_theme_admin_menus");

/****************************
  Theme Settings
****************************/  
function theme_settings_page() {
    //// BOF grabar
    if (isset($_POST["update_settings"])) {
        $edicion_activa = esc_attr($_POST["edicion_activa"]);
        update_option("edicion_activa", $edicion_activa);
    } else {        
        $edicion_activa = get_option("edicion_activa");        
    }
    //echo $edicion_activa;
    //// EOF grabar
    ?>
    <div class="wrap">
        <?php screen_icon('themes'); ?> <h2>Theme Settings</h2> 
        <br/>       
        <form name="frm_ultimos" method="post" action="">
            <table>
                <tr>
                <td>Edición Activa: </td> 
                <td>
                    <select name="edicion_activa">
                        <?php
                            $terms = get_terms( 'edicion' );
                            foreach ($terms as $term) {
                                $name = $term->name;
                                $id = $term->term_id;
                                if($edicion_activa == $id) {
                                    echo '<option selected="selected" value="'.$id.'">'.$name.'</option>';
                                } else {
                                    echo '<option value="'.$id.'">'.$name.'</option>';
                                }   
                            }                            
                        ?>
                    </select>
                </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p align="center">
                            <input type="submit" value="Guardar" name="update_settings" />
                        </p>
                    </td>
                </tr>
            </table>
        </form>
    </div>        
<?php } 


/****************************
  Google Analitycs
****************************/  
function theme_front_page_settings() {
   //// BOF grabar
    if (isset($_POST["update_settings"])) {
        $analitycs_code = esc_attr($_POST["analitycs_code"]);        
        update_option("theme_name_analitycs_code", $analitycs_code);        
    } else {
        $analitycs_code = get_option("theme_name_analitycs_code");
    }
    //// EOF grabar
?>
    <div class="wrap">
        <?php screen_icon('themes'); ?> <h2>Google Analitycs</h2>

        <form method="POST" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="analitycs_code">
                            Google Code:
                        </label>
                    </th>
                    <td>
                        <input type="text" name="analitycs_code" value="<?php echo $analitycs_code;?>" size="25" />
                    </td>
                </tr>                
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Save" />
                    </td>
                </tr>
            </table>
            <input type="hidden" name="update_settings" value="Y" />
        </form>
    </div>
<?php }

/****************************
  Sidebar
****************************/  
function theme_front_page_sidebar() {
   //// BOF grabar
    if (isset($_POST["update_settings"])) {
        $sidebarc = esc_attr($_POST["sidebarc"]);        
        update_option("theme_name_sidebar", $sidebarc);        
    } else {
        $sidebarc = get_option("theme_name_sidebar");
    }
    //// EOF grabar
?>
    <div class="wrap">
        <?php screen_icon('themes'); ?> <h2>Custom Sidebar</h2>

        <form method="POST" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="sidebarc">
                            Sidebar:
                        </label>
                    </th>
                    <td>
                        <textarea cols="50" rows="4" name="sidebarc"><?php echo $sidebarc;?></textarea>
                    </td>
                </tr>                
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Save" />
                    </td>
                </tr>
            </table>
            <input type="hidden" name="update_settings" value="Y" />
        </form>
    </div>
<?php } ?>