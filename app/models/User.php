<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model{
    
   public static $table = "users";

   public function __construct()
   {
      parent::__construct();
   }

   public function get_all()
   {
      $this->db->select('*'); 
      $query = $this->db->get(self::$table)->result_array();
      return $query;
   }

   public function get_use_id($id)
   {
      $query = $this->db->query('SELECT * FROM '.self::$table.' WHERE id='.$id )->row_array();
      return $query;
   }

   public function get_use_email($email)
   {
      $query = $this->db->query("SELECT * FROM ".self::$table." WHERE email='".$email."'")->row();
      return $query;
   }


   public function save($insert)
   {
      if(is_array($insert)){
        $user = $this->get_use_email($insert['email']);        
      }else{
        $user = $this->get_use_email($insert->email);                
      }
      if(!$user){
        $this->db->insert(self::$table, $insert);
        if(!is_object($insert)){
          $id = $this->db->insert_id();         
          return $id;
        }else{
          $this->id = $this->db->insert_id();                  
          return $this;
        }
      }else{
        return null;
      }
   }

  public function updated($update, $id)
  {
    $this->db->update(self::$table, $update, array("id"=> $id));
    return $this->db->affected_rows();
  }

  public function create($data=[], $update=null)
  {
      $_fields = $this->_fields_table();
      $is_array = is_array($data);
      foreach($_fields as $row){
         if($row != "id"){
            if($is_array){
               $i=0;
               foreach($data as $key => $value){
                  if($row == $key){
                     $this->$row = $value;
                     $i++;
                     break;
                  }
               }
               if($i==0){
                  $this->$row = 0;
               }
            }else{
              $this->$row = 0;
            }
         }
         if($row == "created_at"){
            if($update == null){
              $this->$row = date("Y-m-d H:i:s");              
            }
         }
         if($row == "updated_at"){
            if($update == TRUE){
              $this->$row = date("Y-m-d H:i:s");              
            }
         }
      }
    return $this;
  }
    
  public function destroy($id)
  {
    return $this->db->simple_query("DELETE FROM ".self::$table." WHERE id=".$id);
  }

   public function validate()
   {
      $this->load->library('form_validation');
      $_fields = $this->_fields_table();
      $this->form_validation->set_rules('nombres', "", "required");
      $this->form_validation->set_rules('apellidos', "", "required");
      $this->form_validation->set_rules('email', "", "required|valid_email");
      $this->form_validation->set_rules('password', "", "required|min_length[6]");
      $_error = array();
      if($this->form_validation->run() == FALSE){
        foreach($_fields as $field){
          $_error[] = form_error($this->_fields_protected($field), '<span class="field-error">', '</span>'); 
        }
        return ["mensajes" => json_encode($_error)];             
      }else{
        return null;
      }
   }

   function _fields_table()
   {
      return $this->db->list_fields(self::$table);
   }

   function _fields_protected($field)
   {
      $fields_names = [
          'email'=> "dirección de correo",
          'password'=> "contraseña"
      ];
      return (isset($fields_names[$field]))? $fields_names[$field]: $field; 
   }

   function user_session_validate($email, $password)
   {
      $this->load->library('encrypt');
      $user = $this->get_use_email($email);
      if($user){
         $encrypted = $this->encrypt->decode($user->password, $email);
         if($password == $encrypted){
            return $user;
         }else{
            return null;
         }
      }else{
         return null;         
      }
   }

   function encript_password($password, $email)
   {
      $this->load->library('encrypt');
      $password = $this->encrypt->encode($password, $email);
      return $password;
   }

}