
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		class Cctv_model extends CI_Model
		{
		    function __construct()
		    {
		      // Call the Model constructor
		      parent::__construct();
		    }



		
		  	
		
				function Cctv_details($id)
				{
					$select='SELECT * FROM cctv WHERE id='.$id.'';
				  	$query= $this->db->query($select);
				    if ($query->num_rows() >0){ 
				        foreach ($query->result() as $data) {
				            
				            $result[] = $data;

				        }
				    	return $result;
				    } 
				}
				
			
				
					function list_Cctv_model_Data($rowno,$rowperpage,$search)
					{
						$this->db->order_by('id','desc');

						$this->db->select('*');
					    $this->db->from('cctv');

					    if($search != ''){
					      
									$this->db->like('cctv_name', $search);

							   
									$this->db->or_like('latitude', $search);

							   
									$this->db->or_like('longitude', $search);

							   
									$this->db->or_like('location', $search);

							   
					    }


					    $this->db->limit($rowperpage, $rowno); 
					    $query = $this->db->get();
					 
					    return $query->result_array();
					}


					public function list_Cctv_model_Count($search = '') {

					    $this->db->select('count(*) as allcount');
					    $this->db->from('cctv');
					 
					    if($search != ''){
					      
									$this->db->like('cctv_name', $search);

							   
									$this->db->or_like('latitude', $search);

							   
									$this->db->or_like('longitude', $search);

							   
									$this->db->or_like('location', $search);

							   
					    }


					    $query = $this->db->get();
					    $result = $query->result_array();
					 
					    return $result[0]['allcount'];
					}


					function fetch_data($limit, $start,$location)
					{

						$this->db->select("*");
						$this->db->from("cctv");
						if(!empty($location)){
							$this->db->like('cctv_name',$location);
						}
						$this->db->order_by("id", "DESC");
						$this->db->limit($limit, $start);
						$query = $this->db->get();
						return $query;
					}
					
				}