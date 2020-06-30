<?php
/*
Plugin Name: Plugin_form
Description: extension de wordpress avec 2 sous menus 
Version: 1.0
Author: elmehdi abouloualid
Author URI: https://automattic.com/wordpressBrief3/
License: GPLv2 or later
Text Domain: Plugin_form
*/

 



 

add_action("admin_menu","addMenu");

 


function addMenu() {
    add_menu_page( 'Plugin_form', 'Plugin_form', 'read', 'Plugin_form_Dashboard', 'Plugin_form_index' );
    add_submenu_page( 'Plugin_form_Dashboard', 'Plugin_form', 'Settings', 'read', 'Plugin_form_Dashboard', 'Plugin_form_index');
    add_submenu_page( 'Plugin_form_Dashboard', 'Plugin_form', 'infos', 'read', 'Plugin_form_NouvellePage', 'Plugin_form_NouvellePage');
}

 

 

function Plugin_form_index(){
  require_once( dirname( dirname( dirname( dirname( __FILE__ )))) . '/wp-load.php' );
  global $wpdb;
  if(isset($_POST['submit'])){
      $option=$_POST['option'];
      $name = $_POST['inputtxt'];
      $email = $_POST['inputarea'];
$table_name = $wpdb->prefix . "plugin_table";

 

$wpdb->insert( $table_name, array(
                      'inputtxt' => $name,
                      'inputarea' => $email,
                      'option'=>$option
                      )); 
  echo ' 
    <div id="message" class="updated below-h2">
      <p>data registred check your info page</p>
    </div>
  ';
  }
?>     
<h1 style="font-size:23px">Register some infos</h1> 
 <form action="" method="post">
  <table style="background-color: #fff; width: 100%;">
      <tr>
        <td><label style="font-size:20px" for="inputtxt">Utilisateur :</label></td>
        <td><input style="width:400px" type="text" name="inputtxt" id="inputtxt"  required/><br></td>
      </tr>
      <tr>
        <td><label style="font-size:20px" for="inputarea">Description :</label></td>
        <td><textarea style="width:400px" type="text" name="inputarea" id="inputarea"  required></textarea></td>
      </tr>
      <tr>
        <td><label style="font-size:20px" for="option">Options :</label></td>
        <td>
          <select style="width:400px" name="option" id="option" required>
            <option value="">--Select--</option>
            <option value="A">Option A</option>
            <option value="B">Option B</option>
            <option value="C">Option C</option>
          </select>
        </td>
      </tr>
      <tr>
      <br><br><td colspan="2" ><br><input type="submit" class="button button-primary button-hero load-customize hide-if-no-customize" name="submit"/></td>
      </tr>
    </table>
</form>
<?php

 

}

 


function Plugin_form_NouvellePage(){
    
    
    echo '<h1 style="font-size:23px ">All Data</h1>';
    
    
    global $wpdb;
    $table_name = $wpdb->prefix . "plugin_table";
    $results = $wpdb->get_results( "SELECT * FROM $table_name"); 
    ?>
   
    <?php
if(!empty($results))  
{  
    
    
    
    
    ?>  
    
    <table style="width:70%" class="wp-list-table widefat fixed striped pages text-center" >
        <thead  >
            <tr >
                <th>Utilisateur</th>
                <th>Description</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody  id="the-list">
    <?php
          
    foreach($results as $row){   
        
        ?>
        <tr>
            <td><?php echo $row->inputtxt ;?></td>
            <td><?php echo $row->inputarea ;?></td>
            <td><?php echo $row->option ;?></td>
        </tr>
     
        <?php
    }
    ?>
    <tbody>
  </table>
<?php
}else{
    echo 'there is no data for now';
}
?>
    
<?php
}
//runs when plugin is activated
register_activation_hook( __FILE__, 'create_table' );

 

function create_table(){
    global $wpdb;

 

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

 

    $table_name = $wpdb->prefix . "plugin_table";  

 

    $sql = "CREATE TABLE $table_name (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      inputtxt varchar(255) NOT NULL,
      inputarea varchar(255) NOT NULL,
      option varchar(5) NOT NULL,
      
      PRIMARY KEY  (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

 

    dbDelta( $sql );
}

 

// Runs when plugin is desactivated
register_deactivation_hook( __FILE__, 'remove_table' );

 

function remove_table() {
    global $wpdb;
     $table_name = $wpdb->prefix . 'plugin_table';
     $sql = "DROP TABLE IF EXISTS $table_name";
     $wpdb->query($sql);
     delete_option("my_plugin_db_version");
} 

 

?>