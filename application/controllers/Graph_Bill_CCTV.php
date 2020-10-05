

                    <?php defined("BASEPATH") OR exit("No direct script access allowed");

                    class Graph_Bill_CCTV extends CI_Controller  {

                        public function __construct()
                        {

                          parent::__construct();
                          $this->load->database();
                          $this->load->library("session");
                          $this->load->helper("Lookup_helper");
                        }


                        function index()
                        {
                            $datepicker = $this->input->post("datepicker");
                            $monthpicker = $this->input->post("monthpicker");
                            $yearpicker = $this->input->post("yearpicker");


                            if(empty($monthpicker)){

                                if(!empty($yearpicker)){
                                    
                                    // YEAR FILTER
                                    $query =  $this->db->query("SELECT datetime as y_date, CONCAT(MONTHNAME(datetime),' / ',YEAR(datetime)) as day_name, COUNT(cctv_name) as count  FROM cctv WHERE  YEAR(datetime) = '" . $yearpicker . "' GROUP BY MONTH(datetime) ORDER BY MONTH(datetime) ASC");
                                    
                                } else {
                                    
                                    if(!empty($datepicker)){

                                        $datepicker = date("Y-m-d", strtotime($datepicker) );

                                        $query =  $this->db->query("SELECT datetime as y_date, DAYNAME(datetime) as day_name, COUNT(table_1) as count  FROM Table_1 WHERE 
                                            DATE(datetime) = '$datepicker'
                                            GROUP BY DAYNAME(datetime) ORDER BY (y_date) ASC");

                                    } else {

                                        // NO FILTER
                                        $query =  $this->db->query("SELECT datetime as y_date, DAYNAME(datetime) as day_name, COUNT(cctv_name) as count  FROM cctv WHERE date(datetime) > (DATE(NOW()) - INTERVAL 7 DAY) AND MONTH(datetime) = '" . date('m') . "' AND YEAR(datetime) = '" . date('Y') . "' GROUP BY DAYNAME(datetime) ORDER BY (y_date) ASC");
                                    
                                    }
                                }

                                 
                              } else {
                                
                                    // MONTH SELECTED
                                    $query =  $this->db->query("SELECT datetime as y_date, CONCAT(DAY(datetime),' / ',MONTH(datetime)) as day_name, COUNT(cctv_name) as count  FROM cctv WHERE MONTH(datetime) = '" . $monthpicker . "' AND YEAR(datetime) = '" . $yearpicker . "' GROUP BY DAY(datetime) ORDER BY DAY(datetime) ASC"); 
                              }

                            


                            $record = $query->result();
                            $data = [];

                            foreach($record as $row) {
                                $data['label'][] = $row->day_name;
                                $data['data'][] = (int) $row->count;
                            }
                            $data['chart_data'] = json_encode($data);

                            if(empty($monthpicker)){
                                if(!empty($yearpicker)){
                                    $data['title']='Filter By Year';
                                } else if(!empty($datepicker)){
                                    $data['title']='Filter By Date ';
                                } else {
                                    $data['title']='Filter By Last 7 Days';
                                }
                            } else {
                                $data['title']='Filter By Month';
                            }

                            $this->load->view("project/header/header");
                            $this->load->view("project/body/Graph_Bill_CCTV/Bill_CCTV.php",$data);
                            $this->load->view("project/footer/footer");
                        }

                    }
                