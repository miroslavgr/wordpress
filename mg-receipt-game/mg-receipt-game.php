<?php 
/*
 *Plugin Name: Receipt Game
 */
    
       
function mg_rg_init_menu()
{
    
    //add top level menu for managing main registered table
    add_menu_page(
        'MG Receipt Game',//text used for <title> html tag
        'MG Receipt Game',//text isef for the menu name in Dashboard
        'manage_options',//minimum user capability requered to see menu, usually 'manage_options'
        'mg_main_menu',//uniqe slug name for the menu
        'mg_rg_main_menu_html'//function to display page content
        );
    
    //sub menu for possible winning prizes
    add_submenu_page(
        'mg_main_menu',
        'Prizes',
        'Prizes',
        'manage_options',//manage_options to be viewable only by administrators
        'mg_prizes',
        'mg_rg_prizes_html'
        );
    //sub menu for choosing winner and manage winners
    add_submenu_page(
        'mg_main_menu',
        'Winners',
        'Winners',
        'manage_options',//manage_options to be viewable only by administrators
        'mg_winners',
        'mg_rg_winners_html'
        );
}

add_action('admin_menu','mg_rg_init_menu');

function mg_rg_main_menu_html()
{
    if(!is_admin())
    {
        exit;
    }
    global $wpdb;
    $registeredArr = false;
    
    $table_name = $wpdb->prefix . "mg_rg_register"; 
    
    /*Start adding new receipt */
    if(array_key_exists('submit_new_register',$_POST))
    {
        if(isset($_POST["receipt_number"])&&!empty($_POST["receipt_number"])
            &&isset($_POST["receipt_total"])&&!empty($_POST["receipt_total"])
            &&isset($_POST["names"])&&!empty($_POST["names"])
            &&isset($_POST["email"])&&!empty($_POST["email"])
            &&isset($_POST["phone"])&&!empty($_POST["phone"]))
        {
            $receipt_number = $_POST["receipt_number"];
            $receipt_total = $_POST["receipt_total"];
            $names = $_POST["names"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            
            $boolin = $wpdb->insert(
                $table_name,
                array(
                    'receipt' => $receipt_number,
                    'price' => $receipt_total,
                    'name' => $names,
                    'email' => $email,
                    'mobile' => $phone
                )
                );
            if($boolin != false)
            {
                 ?>
                <div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible"><strong>Касовата бележка е добавена успешно.</strong></div>
                <?php
            }
            else{     
                 ?>
                <div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible"><strong>Касовата бележка не е добавена.</strong></div>
                <?php       
            }
        }
        else if(isset($_POST["receipt_number"])||isset($_POST["receipt_total"])||isset($_POST["names"])
            ||isset($_POST["email"])||isset($_POST["phone"]))
        {
            ?>
            <div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible"><strong>Въведете всички полета!</strong></div>
            <?php   
        }
    }
    /*End adding new receipt */
    
    /*Start delete by receipt */
    if(array_key_exists('submit_receipt_delete',$_POST)&&isset($_POST["receipt_delete"])&&!empty($_POST["receipt_delete"]))
    {
        $receipt_del = $_POST["receipt_delete"];
        $bool_rep_del = $wpdb->delete( $table_name, array( 'receipt' => $receipt_del ) );
        if($bool_rep_del)
        {
            ?>
            <div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible"><strong>Касовата билежка е изтрита успешно!</strong></div>
            <?php
        }
        else
        {
            ?>
            <div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible"><strong>Касовата билежка не е изтрита!</strong></div>
            <?php
        }
    }
    /*End delete by receipt*/
    
    /*Start search by phone*/
    if(array_key_exists('submit_phone_search',$_POST)&&isset($_POST["phone_search"])&&!empty($_POST["phone_search"]))
    {
       $phone_search = $_POST["phone_search"];
            $registeredArr = $wpdb->get_results(
                "
                	SELECT *
                	FROM $table_name
                    WHERE mobile=$phone_search
            	");
        
       
    }/*End search by phone */
    else 
    {
        if(array_key_exists('submit_biggest_price',$_POST))
        {
            $registeredArr = $wpdb->get_results(
                "
        	SELECT *
        	FROM $table_name
            ORDER BY price DESC");
        
         }
         elseif(array_key_exists('submit_lowest_price',$_POST))
         {
             $registeredArr = $wpdb->get_results(
                 "
        	SELECT *
        	FROM $table_name
            ORDER BY price ASC");

         }
        else
        {
            $registeredArr = $wpdb->get_results(
            "
            	SELECT *
            	FROM $table_name
                ORDER BY id DESC
        	");
        }
    }
    
   
    ?>
    
    <div class="wrap">
   	<h2>Регистрирани касови бележки</h2><br>
   	<form method="post" action="">	
	<label for="phone_search">Търси по телефон: 359 </label>
   	<input type="number" value="" id="phone_search" name="phone_search">
   	<input type="submit" name="submit_phone_search" class="button button-primary" value="Намери резултати">
   	</form> <br>	
   	<form method="post" action="">	
	<label for="phone_search">Изтрий по номер на касова бележка: </label>
   	<input type="number" value="" id="receipt_delete" name="receipt_delete">
   	<input type="submit" name="submit_receipt_delete" class="button button-primary" value="Изтрий"><br><br>
   	<input type="submit" name="submit_biggest_price" class="button button-primary" value="Сортирай по най-висока цена">
   	<input type="submit" name="submit_lowest_price" class="button button-primary" value="Сортирай по най-ниска цена">
   	</form> <br>	
   	<form method="post" action="">	
   	<h4>Добвяне на нова касова бележка - Въведи всички полета</h4>
   	<label for="receipt_number" class="form__label">Номер от касова бележка: </label>
   	<input type="number" value="" id="receipt_number" min="0" name="receipt_number"> 	
   	<label for="receipt_total">Сума: </label>
   	<input type="text" value="" id="receipt_total" min="0" step="0.01" name="receipt_total">
   	<label for="names">Три имена: </label>
   	<input type="text" value="" id="names" name="names"> 	
   	<label for="phone">Телефон: 359 </label>
   	<input type="number" value="" id="phone" name="phone"> 	
   	<label for="email">Имейл: </label>
   	<input type="email" value="" id="email" name="email">   	
   	<input type="submit" name="submit_new_register" class="button button-primary" value="Добави">
   	</form><br>
   	<table class="widefat">
   	<thead> <tr> <th>Id</th> <th>Receipt</th><th>Price</th> <th>Name</th> <th>Email</th> <th>Mobile</th></tr> </thead>
   	<tfoot> <tr> <th>Id</th> <th>Receipt</th><th>Price</th> <th>Name</th> <th>Email</th> <th>Mobile</th></tr> </tfoot>
   	<tbody>
	<?php 
	if($registeredArr)
	{
	    foreach ( $registeredArr as $receipt )
	    {
	        echo "<tr>";
	        echo "<td>$receipt->id </td>";
	        echo "<td>$receipt->receipt </td>";
	        echo "<td>$receipt->price </td>";
	        echo "<td>$receipt->name </td>";
	        echo "<td>$receipt->email </td>";
	        echo "<td>$receipt->mobile </td>";
	        echo "</tr>";
	    }
	}
	
	?>
   	
   	</tbody>
   	
   	</table>
   	
   	</div>
    <?php
}

function mg_rg_prizes_html()
{
    echo "prizes page";
}

function mg_rg_winners_html()
{
    echo "winners page";
}

function mg_rg_activate()
{
   global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    
    //registered
    $table_name = $wpdb->prefix . "mg_rg_register"; 
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id int NOT NULL AUTO_INCREMENT , 
    receipt int NOT NULL ,
    price float NOT NULL , 
    name varchar(255) NOT NULL , 
    email varchar(255) NOT NULL , 
    mobile int NOT NULL ,
     PRIMARY KEY (id), UNIQUE (receipt)
    )$charset_collate";
    
    //prizes
   /* $table_name2 = $wpdb->prefix . "mg_rg_prizes";
    $charset_collate2 = $wpdb->get_charset_collate();
    
    $sql2 = "CREATE TABLE IF NOT EXISTS $table_name (
    id int NOT NULL AUTO_INCREMENT ,
    receipt int NOT NULL ,
    price float NOT NULL ,
    name varchar(255) NOT NULL ,
    email varchar(255) NOT NULL ,
    mobile int NOT NULL ,
     PRIMARY KEY (id), UNIQUE (receipt)
    )$charset_collate";*/
    
    //winners
    $table_name3 = $wpdb->prefix . "mg_rg_winners";
    $charset_collate3 = $wpdb->get_charset_collate();
    
    //to do add foreign key prize_id to prizes
    $sql3 = "CREATE TABLE IF NOT EXISTS $table_name3 (
    id int NOT NULL AUTO_INCREMENT ,
    name varchar(255) NOT NULL ,
    email varchar(255) NOT NULL ,
    mobile int NOT NULL ,
    prize_id int NOT NULL,
    PRIMARY KEY (id)
    )$charset_collate";
    
   //$bool = $wpdb->query($sql);
   
   dbDelta( $sql ); //registered
  // dbDelta( $sql2 ); //prizes
   dbDelta( $sql3 ); //winners
}
register_activation_hook(__FILE__,'mg_rg_activate'); //1st param is the main plugin file


/* Shortcodes section */

function mg_rg_shortocdes()
{
    add_shortcode('display_input_form', 'mg_rg_display_input_html');
}

add_action('init', 'mg_rg_shortocdes');

function mg_rg_display_input_html()
{
    
    global $wpdb;
    $table_name = $wpdb->prefix . "mg_rg_register";
    $addedRep = 0;
    /*Start adding new receipt */
  
        if(isset($_POST["receipt_number"])&&!empty($_POST["receipt_number"])
            &&isset($_POST["receipt_total"])&&!empty($_POST["receipt_total"])
            &&isset($_POST["names"])&&!empty($_POST["names"])
            &&isset($_POST["email"])&&!empty($_POST["email"])
            &&isset($_POST["phone"])&&!empty($_POST["phone"]))
        {
            $receipt_number = $_POST["receipt_number"];
            $receipt_total = $_POST["receipt_total"];
            $names = $_POST["names"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            
            $boolin = $wpdb->insert(
                $table_name,
                array(
                    'receipt' => $receipt_number,
                    'price' => $receipt_total,
                    'name' => $names,
                    'email' => $email,
                    'mobile' => $phone
                )
                );
            if($boolin != false)
            {
                $addedRep = 1;
            }
            else{     
                $addedRep = 2;
            }
        }
    
    
    
    $buffer ='
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous"></script>

		<!-- Validation plugin -->

		<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script>
	<script> !function(a){"function"==typeof define&&define.amd?define(["jquery","../jquery.validate.min"],a):"object"==typeof module&&module.exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){return a.extend(a.validator.messages,{required:"Полето е задължително.",remote:"Моля, въведете правилната стойност.",email:"Моля, въведете валиден email.",url:"Моля, въведете валидно URL.",date:"Моля, въведете валидна дата.",dateISO:"Моля, въведете валидна дата (ISO).",number:"Моля, въведете валиден номер.",digits:"Моля, въведете само цифри.",creditcard:"Моля, въведете валиден номер на кредитна карта.",equalTo:"Моля, въведете същата стойност отново.",extension:"Моля, въведете стойност с валидно разширение.",maxlength:a.validator.format("Моля, въведете не повече от {0} символа."),minlength:a.validator.format("Моля, въведете поне {0} символа."),rangelength:a.validator.format("Моля, въведете стойност с дължина между {0} и {1} символа."),range:a.validator.format("Моля, въведете стойност между {0} и {1}."),max:a.validator.format("Моля, въведете стойност по-малка или равна на {0}."),min:a.validator.format("Моля, въведете стойност по-голяма или равна на {0}.")}),a}); </script>
    ';
    if($addedRep == 1)
    {
        $buffer.= "<h2>Касовата бележка беше регистрирана успешно!</h2>";
    }
    elseif($addedRep == 2)
    {
        $buffer.= "<h2>Касовата бележка вече е регистрирана!</h2>";
    }
	 
   $buffer.=' <form id="input_receipt" method="post" >
    <ul style="list-style-type: none;">
    <li>
    <label for="receipt_number" >Въведи номер от касова бележка: *</label>
    <br>
    <input type="number" value="" min="0" id="receipt_number" name="receipt_number">
    </li>
    <li>
    <label for="receipt_total" >Въведи сумата от задължително закупен продукт, обозначена на касовата бележка *</label>
     <br>
    <input type="text" value="" min="0" step="0.01" id="receipt_total" name="receipt_total">
    </li>
    
    <li>
    <label for="names">Три имена: *</label> <br>
    <input type="text" value="" id="names" name="names">
    </li>
    <li>
    <label for="phone">Мобилен номер: *</label> <br>
    <input type="number" value="" id="phone" name="phone">
    </li>
    <li>
    <label for="email" class="form__label">Имейл: *</label> <br>
    <input type="email" value="" id="email" name="email">
    </li>
    
    <li>
    <label class="checkbox">
    <input type="checkbox" name="agree_1">
    <span class="checkbox__text">Потвърди, че ще запазиш касовата бележка.</span>
    </label>
    </li>
    
    <li>
    <label class="checkbox">
    <input type="checkbox" name="agree_2" class="checkbox__input" data-error="Полето е задължително">
    <span class="checkbox__text">Ако си съгласен/-а с <a href="https://www.rois.bg/igra-hrrupss#tab-terms" target="_blank">Официалните правила на играта</a> и желаеш да участваш, моля, отбележи в квадратчето.</span>
    </label>
    </li>
    <li class="form__row">
    <label class="checkbox parsley-error">
    <input type="checkbox" name="agree_3">
    <span class="checkbox__text">Имам навършени 18 години.</span>
    </label>
    </li>
    
    <li class="form__row -align-center">
    <button type="submit" >регистрирай касова бележка</button>
    </li>
    </ul>
    </form>
';
    
    
    $buffer.='<script>
		 
			  //FORM VALIDATION

    $("#input_receipt").validate({
        rules: {
					receipt_number:{
                required: true,
                minlength: 3
						},
					receipt_total:{
                required: true,
						},	
	               names:{
                required: true,
                minlength: 10
						},
					phone:{
                required: true,
                minlength: 9,
                maxlength: 9
						},
                    email:{
                required: true,
						},
					agree_1:{
                required: true,
						},
                    agree_2:{
                required: true,
						},
                    agree_3:{
                required: true,
						}

        }

    });
			</script>';
    return $buffer;
}


?>
