<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function p($a)
{
    echo '<pre>';
    print_r($a);
    echo '</pre>';

}
function v($a)
{
    echo '<pre>';
    var_dump($a);
    echo '</pre>';

}


function clean_header($array){
    $CI = get_instance();
    $CI->load->helper('inflector');
    foreach($array as $a){
        $arr[] = humanize($a);
    }
    return $arr;
}

function reduce_word_length($word,$length=9)
{
    return substr_replace($word,'',0,($length));
}

function emailto($email,$text=null)
{
    if ($text==null) {
        
        return "<a href='mailto:".$email."' alt='".$email."'>".$email."<a/>";
    }
    else
    {
        return "<a href='mailto:".$email."' alt='".$text."'>".$text."<a/>";
    }
}

function linkme($link,$text=null)
{
    if ($text==null) {
        
        return "<a href='".$link."' alt='".$link."'>".$link."<a/>";
    }
    else
    {
        return "<a href='".$link."'  alt='".$text."'>".$text."<a/>";
    }
}


function erro_suclink($link,$text=null)
{
    if ($text==null) {
        
        return "<a href='".$link."' alt='".$link."'>".$link."<a/>";
    }
    else
    {
        return "<a href='".$link."'  alt='".$text."'>".$text."<a/>";
    }
}

// set value replace by this
function image_set_value($path,$default='default.jpg')
{
    $path = trim($path);
    if (empty($path))                  // comment here  
    {
        return  $default;
    }
    else                    // comment here
    {
        return $path;
    } 
}



/**
 * @author                          Madhuranga Senadheera
 * Purpose of the function          Description
 * @return_type                     Money formting
 */
function money_formator($value)
{
    return 'Rs '.$value.' /=';
}
/*---------------- ---------End of money_formator()---------------------------*/


 
 /**
  * @author                          Madhuranga Senadheera
  * Purpose of the function          get time form date
  * @return_type                     return_type
  */
function get_time_24($date_with_time)
{ 
    $phpdate = strtotime( $date_with_time );
    return date('H:i', $phpdate );
}
 /*---------------- ---------End of get_time()---------------------------*/
 
 
 /**
  * @author                          Madhuranga Senadheera
  * Purpose of the function          get time form date with am pm
  * @return_type                     return_type
  */
function get_time_12($date_with_time)
{ 
    $phpdate = strtotime( $date_with_time );
    return date('h:i a', $phpdate );
}
 /*---------------- ---------End of get_time()---------------------------*/
 





/**
 * @author                          Madhuranga Senadheera
 * Purpose of the function          get month name when given month id
 * @return_type                     return_type
 */
function get_month_name($id)
{
    $array_month_name = array( 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    return $array_month_name[($id-1)];
}
/*---------------- ---------End of get_month_name()---------------------------*/


/**
 * @author                          Madhuranga Senadheera
 * Purpose of the function          Send email 
 * @return_type                     return_type
 */
/*public function send_email($to,$subject,$content,$debug_enable=NULL)
{
    $config['protocol'] = 'sendmail';
    $config['mailpath'] = '/usr/sbin/sendmail';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = TRUE;

    $CI->email->initialize($config);

    $CI->load->library('email');

    $CI->email->from('senadheera@gmail.com', 'Senadheera Taxi');
    $CI->email->to($to); 

    $CI->email->subject($subject);
    $CI->email->message($content);  

    return (bool)$CI->email->send();

    if ($debug_enable!=NULL) {
        echo $CI->email->print_debugger();
    }
    
}*/
/*---------------- ---------End of send_email()---------------------------*/




 

/**
 * @author                          Madhuranga Senadheera
 * Purpose of the function          Set status per label
 * @return_type                     return_type
 */
function status_manager($status)
{
 
    $CI = get_instance();
    $CI->load->model('status_manager_model');
    $query = $CI->status_manager_model->get_by(array('status'=>$status), "*", $id = NULL, $single = TRUE);
    return "<span class='label label-".$query->color."'>".$query->text."</span>";
    var_dump($query); exit('codeigniter_helper_file ln:'.__LINE__);

}
/*---------------- ---------End of status_manager_()---------------------------*/



/**
 * @author                          Madhuranga Senadheera
 * Purpose of the function          Description
 * @variable                         : type
 * @return                             return_type 
 */
function link_staff($id,$logged_user_type,$link=TRUE)
{
    if (is_null($id)) {
        return false;
    }
    else
    {
        $CI = get_instance();
        $CI->load->model('staff_model');
        $return = $CI->staff_model->get('*',$id,TRUE);
        if (sizeof($return)==0) {
            return "Not found";
        }
        // return "<a Title='".$return->firstname." ".$return->lastname."' href='".site_url($logged_user_type."/staff/view/".$return->id)."'>".$return->firstname."</a>";
        // create a link 
        if ($link) {
            return "<a Title='".$return->firstname." ".$return->lastname."' href='".site_url($logged_user_type."/staff/view/".$return->id)."'>".$return->firstname."</a>";
        }
        return "<label >".$return->firstname." ".$return->lastname."</label>";
        
    }
}
/*---------------End of link_course($id)---------------*/




/**
 * @author                          Madhuranga Senadheera
 * Purpose of the function          Description
 * @variable                         : type
 * @return                             return_type 
 */
function btn_view($id,$logged_user_type,$title,$controller_name)
{
    return "<a Title='View ".$title."' href='".site_url($logged_user_type."/".$controller_name."/view/".$id)."'>View</a>";
}
/*---------------End of btn_view($id)---------------*/


/**
 * @author                          Madhuranga Senadheera
 * Purpose of the function          Description
 * @variable                         : type
 * @return                             return_type 
 */
function btn_edit($id,$logged_user_type,$title,$controller_name)
{
    return "<a Title='Edit ".$title."' href='".site_url($logged_user_type."/".$controller_name."/edit/".$id)."'>Edit</a>";
}
/*---------------End of btn_view($id)---------------*/


/**
 * @author                          Madhuranga Senadheera
 * Purpose of the function          Description
 * @variable                         : type
 * @return                             return_type 
 */
function btn_delete($id,$logged_user_type,$title,$controller_name)
{
    return "<a Title='Delete ".$title."' href='".site_url($logged_user_type."/".$controller_name."/delete/".$id)."'>Delete</a>";
}
/*---------------End of btn_view($id)---------------*/





/**
 * @author                          Madhuranga Senadheera
 * Purpose of the function          Description
 * @variable                         : type
 * @return                             return_type 
 */
function enable_dropdown($msg,$selected_value=NULL,$option="")
{
    $items = array(''=>'Please Select '.$msg, '1'=>'Enable','0'=>'Disable');
    // check selected value
    if (!is_null($selected_value)) {
        return form_dropdown('enable', $items,$selected_value,$option);
    }
    return form_dropdown('enable', $items);
}
/*---------------End of enable_dropdown($selected_value=NULL,)---------------*/



/**
 * @author                          Madhuranga Senadheera
 * Purpose of the function          Description
 * @variable                         : type
 * @return                             return_type 
 */
function format_price($value=NULL,$currency_type)
{ 
    if (empty($value)) {
        $value= 0; 
    }elseif (is_null($value)) {
        $value= 0;
    }
    else{

        $value =number_format (  $value ,  0 ,  "." ,  "," );
    }

    return  '<p style="text-align:right;">' .$currency_type.":".$value.'.00 </p>';
}
/*---------------End of format_lkr($value)---------------*/
