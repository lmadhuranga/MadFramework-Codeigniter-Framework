<?php
/**
*
*
* @copyright  2014
* @license    None
* @version    1.0
* @link       None 
*
**/     
        
/***********************************************************************************/
/*                                                                                 */
/* File Name     : status_manager_model.php                                               */
/* Purpose       :                                                                 */
/*                                                                                 */
/*                                                                                 */
/***********************************************************************************/
class  status_manager_model extends MY_Model
{
    protected $_table_name      ='tbl_status_manager';
    protected $_primary_key     ='id';
    protected $_order_by        ='id';
    // protected $_primary_filter  ='';
    protected $_timestamps      =TRUE;    
    // rules
    public $rules = array(
                    array(
                                	'field'=>'status',
                                	'label'=>'Status',
                                	'rules'=>'required|trim|xss_clean|max_length[10]'
                                ),
								array(
                                	'field'=>'text',
                                	'label'=>'Text',
                                	'rules'=>'required|trim|xss_clean|max_length[20]'
                                ),
								array(
                                	'field'=>'description',
                                	'label'=>'Description',
                                	'rules'=>'required|trim|xss_clean|max_length[50]'
                                )
        );

    /*********************Construct()****************************/
    function __construct()
    {
        parent::__construct();
    }

    function count(){
        return $this->db->count_all($this->_table_name);
    }

    
}// ------------------End status_manager_model --------------Class{}
//Owner : Madhuranga Senadheera



