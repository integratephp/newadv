<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

/**
* Description of usermodel
*
* @author https://roytuts.com
*/
class usermodel {

    private $user_account = 'user_account';
    private $user_info = 'user_info';

    /**
    * Update user_account and user_info tables
    * @param type $user_account_id
    * @param type $user_first_name
    * @param type $user_last_name
    * @param type $user_address
    * @return boolean
    */
    function update_user_info($user_account_id, $user_first_name, $user_last_name, $user_address) {
        //which columns need to be updated
        $user_info_data = array(
            'user_first_name' => $this->db->escape_like_str($user_first_name),
            'user_first_name' => $this->db->escape_like_str($user_last_name),
            'user_address' => $this->db->escape_like_str($user_address)
        );
        //which columns need to be updated
        $user_acc_data = array(
            'last_login' => date('Y-m-d')
        );
        //start the transaction
        $this->db->trans_begin();
        //update user_account table
        $this->db->where('user_account_id', $user_account_id);
        $this->db->update($this->user_account, $user_acc_data);
        //update user_info table
        $this->db->where('account_id', $user_account_id);
        $this->db->update($this->user_info, $user_info_data);
        //make transaction complete
        $this->db->trans_complete();
        //check if transaction status TRUE or FALSE
        if ($this->db->trans_status() === FALSE) {
            //if something went wrong, rollback everything
            $this->db->trans_rollback();
        return FALSE;
        } else {
            //if everything went right, commit the data to the database
            $this->db->trans_commit();
            return TRUE;
        }
    }

    /**
    * Delete from user_account and user_info
    * @param type $user_account_id
    * @param type $user_first_name
    * @param type $user_last_name
    * @param type $user_address
    * @return boolean
    */
    function delete_user_info($user_account_id, $user_first_name, $user_last_name, $user_address) {
        //start the transaction
        $this->db->trans_begin();
        //delete user_account table
        $this->db->where('user_account_id', $user_account_id);
        $this->db->delete($this->user_account);
        //delete user_info table
        $this->db->where('account_id', $user_account_id);
        $this->db->delete($this->user_info);
        //make transaction complete
        $this->db->trans_complete();
        //check if transaction status TRUE or FALSE
        if ($this->db->trans_status() === FALSE) {
            //if something went wrong, rollback everything
            $this->db->trans_rollback();
        return FALSE;
        } else {
            //if everything went right, delete the data from the database
            $this->db->trans_commit();
            return TRUE;
        }
    }

}

/* End of file usermodel.php */
/* Location: ./application/models/usermodel.php */