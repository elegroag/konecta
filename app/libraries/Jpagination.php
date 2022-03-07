<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter
 * An open source application development framework for PHP 4.3.2 or newer
 * @filesource
 */
class Jpagination 
{
	public $base_url        = ''; // The page we are linking to
	public $total_rows      = ''; // Total number of items (database results)
	public $per_page        = 10; // Max number of items you want shown per page
	public $num_links       =  2; // Number of "digit" links to show before/after the currently viewed page
	public $cur_page        =  0; // The current page being viewed
	public $first_link      = '<i class="fa fa-fast-backward"></i> Primero';
	public $next_link       = '<i class="fa fa-step-forward"></i> Siguiente';
	public $prev_link       = '<i class="fa fa-step-backward"></i> Anterior';
	public $last_link       = '<i class="fa fa-fast-forward"></i> Ultimo';
	public $uri_segment     = 3;
	public $full_tag_open   = '<ul class="pagination pagination-sm no-margin pull-right">';
	public $full_tag_close  = '</ul>';
	public $cur_tag_open    = '<li><a type="button" class="btn btn-primary active">';
	public $cur_tag_close   = '</a></li>';	
	public $first_tag_open  = '<li>';
	public $first_tag_close = '</li>';
	public $last_tag_open   = '<li>';
	public $last_tag_close  = '</li>';
	public $next_tag_open   = '<li>';
	public $next_tag_close  = '</li>';
	public $prev_tag_open   = '<li>';
	public $prev_tag_close  = '</li>';
	public $num_tag_open    = '<li>';
	public $num_tag_close   = '</li>';	

    // Added By Tohin
    public $js_rebind        = '';
    public $div              = '';
    public $postVar          = '';
    public $additional_param = '';
    // Added by Sean
    public $anchor_class     = '';
    public $show_count       = false;

	/**
	 * Constructor
	 * @access	public
	 * @param	array	initialization parameters
	 */
	public function CI_Pagination($params = array())
	{
		if (count($params) > 0)
		{
			$this->initialize($params);		
		}
	}
	
	/**
	 * Initialize Preferences
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	public function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}		
		}
		// Apply class tag using anchor_class variable, if set.
		if ($this->anchor_class != '')
		{
			$this->anchor_class = 'class="' . $this->anchor_class . '" ';
		}
	}
	
	/**
	 * Generate the pagination links
	 * @access	public
	 * @return	string
	 */	
	public function create_links()
	{
		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
		   return '';
		}
		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1)
		{
            $info = 'Registros ' . $this->total_rows;
			return "<p style='font-size: 13px'>".$info."</p>";
		}
		// Determine the current page number.		
		$CI =& get_instance();	
		if ($CI->uri->segment($this->uri_segment) != 0)
		{
			$this->cur_page = $CI->uri->segment($this->uri_segment);
			
			// Prep the current page - no funny business!
			$this->cur_page = (int) $this->cur_page;
		}
		$this->num_links = (int)$this->num_links;
		if ($this->num_links < 1)
		{
			show_error('Su número de enlaces debe ser un número positivo.');
		}	
		if ( ! is_numeric($this->cur_page))
		{
			$this->cur_page = 0;
		}
		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->cur_page > $this->total_rows)
		{
			$this->cur_page = ($num_pages - 1) * $this->per_page;
		}
		$uri_page_number = $this->cur_page;
		$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
		$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

		// Add a trailing slash to the base URL if needed
		$this->base_url = rtrim($this->base_url, '/') .'/';

  		// And here we go...
		$output = '';

        // SHOWING LINKS
        if ($this->show_count)
        {
            $curr_offset = $CI->uri->segment($this->uri_segment);
            $info = 'Resultado ' . ( $curr_offset + 1 ) . ' a ' ;

            if(($curr_offset + $this->per_page ) < ($this->total_rows -1))
            {
                $info.= $curr_offset + $this->per_page;
            }else{
                $info.= $this->total_rows;
            }
            $info.= ' de ' . $this->total_rows;
            $output.= '<li><a type="button" class="btn btn-default"><small> ' .$info.'</small></a></li>';
        }

        // Render the "First" link
        if  ($this->cur_page > $this->num_links)
        {
            $output.= $this->first_tag_open. 
                $this->getAJAXlink( '' , $this->first_link).
                $this->first_tag_close; 
        }

        // Render the "previous" link
        if  ($this->cur_page != 1)
        {
            $i = $uri_page_number - $this->per_page;
            if ($i == 0) $i = '';
            $output.= $this->prev_tag_open. 
                $this->getAJAXlink( $i, $this->prev_link ).
                $this->prev_tag_close;
        }

        // Write the digit links
        for ($loop = $start -1; $loop <= $end; $loop++)
        {
            $i = ($loop * $this->per_page) - $this->per_page;
                    
            if ($i >= 0)
            {
                if ($this->cur_page == $loop)
                {
                    $output.= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
                }
                else
                {
                    $n = ($i == 0) ? '' : $i;
                    $output.= $this->num_tag_open. 
                        $this->getAJAXlink( $n, $loop ).
                        $this->num_tag_close;
                }
            }
        }

        // Render the "next" link
        if ($this->cur_page < $num_pages)
        {
            $output.= $this->next_tag_open. 
            $this->getAJAXlink( $this->cur_page * $this->per_page , $this->next_link). 
            $this->next_tag_close;
        }

        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages)
        {
            $i = (($num_pages * $this->per_page) - $this->per_page);
            $output.= $this->last_tag_open . $this->getAJAXlink( $i, $this->last_link ) . $this->last_tag_close;
        }

        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);

        // Add the wrapper HTML if exists
        $output = $this->full_tag_open.$output.$this->full_tag_close;
        
        return $output;		
	}

	public function getAJAXlink($count, $text)
	{
    	if($this->div == false){
    		if($count==""){ 
    			$count = 0; 
    		}
      	return "<a type='button' class='btn btn-default change_pagina' data-offset='".$count."' onclick=\"getDatosAjax($count)\" >$text</a>";
    	}
    	if($this->div == ''){
      	return "<a type='button' class='btn btn-default change_pagina' data-offset='".$count."' href='".$this->anchor_class."".$this->base_url.$count."'>$text</a>";
    	}
	}
	
}