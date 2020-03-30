<?php
	class Template {
		var $template_data = array();
		var $view_bag = '';
		function set($content_area, $value)
		{
			$this->template_data[$content_area] = $value;
		}
	
		function load($view = '' , $view_data = array(),$useLayout = TRUE)
		{               
			$this->CI =& get_instance();
			if($useLayout == TRUE){
				$this->set('menu' , $this->CI->load->view('__menu',$this->template_data, TRUE));
				$this->set('footer' , $this->CI->load->view('__footer',$this->template_data, TRUE));
				$this->set('contents' , $this->CI->load->view($view, $view_data, TRUE));
				$this->CI->load->view('__layout', $this->template_data);	
			}
			else{
				$this->CI->load->view($view, $view_data);
			}
		}
	}
?>