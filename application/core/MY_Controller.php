<?php
/**
*
*
* @copyright  2014
* @license    None
* @version    1.0
* @link       None
* @since      Class available since Release 1.0
*
**/		
		
/***********************************************************************************/
/*                                                                                 */
/* File Name     : MY_Controller.php                              */
/* Purpose       : 													           */
/*                 												                   */
/*                                                                                 */
/***********************************************************************************/

class MY_Controller extends CI_Controller
{
	public $data = array();

	function __construct()
	{
		parent::__construct();

        // set site name  
        $this->data['errors'] = array();
        // set today date
        $this->data['today'] = date('Y-m-d');
        // set current time
        $this->data['now_time'] = date('H:i:s');
        // set current time with date
        $this->data['today_with_time'] = date('Y-m-d H:i:s');
        // get tommorow
        $datetime = new DateTime('tomorrow');
        $this->data['tomorrow'] = $datetime->format('Y-m-d');
        // get option tabel values
        $this->get_option_table_values(); 
	}
 

    /**
     * Purpose of the function          Get Option table valus
     * @author                          Madhuranga Senadheera
     */
    public function get_option_table_values()
    {
        $this->load->model('option_model');
        // get all variables 
        $return = $this->option_model->get($fields = '*', $id = NULL, $single = FALSE, $perpage=0, $start=0, $array='array');
        // asign the value to globel variable
        foreach ($return as $key => $variable)
        {
            $this->data[$variable->variable_name]=$variable->option_value; 
        }
    }
    /*---------------End of get_option_table_values()---------------*/

    /**
     * @author                          Madhuranga Senadheera
     * Purpose of the function          POST data get as array
     * 
     */
    public function post_get_as_array($name_array = array())
    {
        $post_data_array = array();
        foreach ($name_array as $key => $value)
        {
        	 $post_data_array[$value] = $this->input->post($value);
        }
 
        return $post_data_array;
    }
    /*---------------- ---------End of post_get_as_array()---------------------------*/

 
    /**
     * @author                          Madhuranga Senadheera
     * Purpose of the function          validation back date
     * @return_type                     boolean
     */
    public function is_back_date($rawdate=NULL,$to_before=NULL)
    { 

        $rawdate_time = strtotime(date($rawdate));
        // to today
        if ($to_before==NULL)
        {
            $latest_time =  strtotime(date('Y-m-d H:t'));            
        }
        // to given date before
        else
        {
            $latest_time = strtotime(date($to_before));
        }   
        $return  = $latest_time-$rawdate_time;
 
        if ($return>0)
        {
            return TRUE;
        }
         
        return FALSE;  
        
    }
    /*---------------- ---------End of is_back_date()---------------------------*/


    /**
     * @author                          Madhuranga Senadheera
     * Purpose of the function          is_futerudate
     * @return_type                     bool
     * Depend on is_back_date()
     */
    public function is_future_date($date)
    {
        return !($this->is_back_date());
    }
    /*---------------- ---------End of is_future_date()---------------------------*/
    


    /**
     * @author                          Madhuranga Senadheera
     * Purpose of the function          Validate NIC
     * @return_type                     bool
     */
    public function is_valid_nic($number)
    {
        $full_text = $number;
        $number_only = substr($number, 0,9); 
        $last_letter = substr($number, 9,10); 
        // lenth 10 and is numuric 

        if ((strlen($full_text)==10)&&(is_numeric($number_only)))
        { 

            switch (strtolower($last_letter))
            { 
                case 'v': 
                    // exit('vv');
                        return TRUE;
                    break;

                case 'x':
                        return TRUE;
                    break; 
            }
        }
        else
        {
            return FALSE;
            
        }

    }
    /*---------------- ---------End of is_valid_nic()---------------------------*/
    
    /**
     * @author                          Madhuranga Senadheera
     * Purpose of the function          generate pdf
     * @return_type                     return_type
     */
    public function mpdf_creater($data)
    { 
        $pdfFilePath = FCPATH."downloads/pdf/";
        if (!isset($data['file_name'])) {
            $data['file_name'] = 'temp';
        }
        $file_name = $data['file_name'].rand(1000,100000).'.pdf';
        $full_path = $pdfFilePath.$file_name;
 
        $this->load->library('pdf');
        $pdf = $this->pdf->load(); 
 
        $html = $this->load->view('admin/_pdf_layout', $data, true);
        $pdf->WriteHTML($html); // write the HTML into the PDF
        $pdf->Output($full_path, 'F');
        return $file_name;
    }
    /*---------------- ---------End of mpdf_creater()---------------------------*/


    
}
/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */

 ?>
