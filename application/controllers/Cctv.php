<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cctv extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this
            ->load
            ->database();
        $this
            ->load
            ->library('session');
        $this
            ->load
            ->model('Cctv_model', 'Cctv');
        $this
            ->load
            ->helper('Lookup_helper');
    }

    function Cctv_view()
    {
        if (($this
            ->session
            ->userdata('role') == 'developer') || ($this
            ->session
            ->userdata('role') == 'Admin'))
        {
            $this
                ->load
                ->view('project/header/header.php');
            $this
                ->load
                ->view('project/body/Cctv/Cctv_view.php');
            $this
                ->load
                ->view('project/footer/footer.php');
        }
    }

    function Cctv_details()
    {

        if (($this
            ->session
            ->userdata('role') == 'developer') || ($this
            ->session
            ->userdata('role') == 'Admin'))
        {
            $id = $this
                ->input
                ->post('id');
            $query = $this
                ->Cctv
                ->Cctv_details($id);

            if (empty($query))
            {
                echo 'Tiada Data Ditemui';
            }
            else
            {
                foreach ($query as $data)
                {

                }
                echo json_encode($data);
            }
        }
    }

    function Cctv_add()
    {
        if (($this
            ->session
            ->userdata('role') == 'developer') || ($this
            ->session
            ->userdata('role') == 'Admin'))
        {
            $this
                ->load
                ->view('project/header/header.php');
            $this
                ->load
                ->view('project/body/Cctv/Cctv_add.php');
            $this
                ->load
                ->view('project/footer/footer.php');
        }
    }

    function add_Cctv_submit()
    {
        if (($this
            ->session
            ->userdata('role') == 'developer') || ($this
            ->session
            ->userdata('role') == 'Admin'))
        {

            $cctv_name = $this
                ->input
                ->post('cctv_name');

            $latitude = $this
                ->input
                ->post('latitude');

            $longitude = $this
                ->input
                ->post('longitude');

            $location = $this
                ->input
                ->post('location');

            $project_id = $this
                ->session
                ->userdata('project_id');

            $uid = $this
                ->session
                ->userdata('id');

            $data = array(
                'cctv_name' => $cctv_name,

                'latitude' => $latitude,

                'longitude' => $longitude,

                'location' => $location,

                'project_id' => $project_id,

                'uid' => $uid,
            );

            $this
                ->db
                ->insert('cctv', $data);

            redirect('Cctv/Cctv_list');
        }
    }

    function Cctv_update()
    {
        if (($this
            ->session
            ->userdata('role') == 'developer') || ($this
            ->session
            ->userdata('role') == 'Admin'))
        {
            $this
                ->load
                ->view('project/header/header.php');
            $this
                ->load
                ->view('project/body/Cctv/Cctv_update.php');
            $this
                ->load
                ->view('project/footer/footer.php');
        }
    }

    function update_Cctv_submit()
    {
        if (($this
            ->session
            ->userdata('role') == 'developer') || ($this
            ->session
            ->userdata('role') == 'Admin'))
        {

            $cctv_name = $this
                ->input
                ->post('cctv_name');

            $latitude = $this
                ->input
                ->post('latitude');

            $longitude = $this
                ->input
                ->post('longitude');

            $location = $this
                ->input
                ->post('location');

            $data = array(
                'cctv_name' => $cctv_name,

                'latitude' => $latitude,

                'longitude' => $longitude,

                'location' => $location,
            );

            $id = $this
                ->uri
                ->segment(3);

            $this
                ->db
                ->where('id', $id);

            $this
                ->db
                ->update('cctv', $data);

            redirect('Cctv/Cctv_list');
        }
    }

    function Cctv_list($rowno = 0)
    {
        if (($this
            ->session
            ->userdata('role') == 'developer') || ($this
            ->session
            ->userdata('role') == 'Admin'))
        {
            $this
                ->load
                ->library('pagination');

            $search_text = '';
            if ($this
                ->input
                ->post('submit') != NULL)
            {
                $search_text = $this
                    ->input
                    ->post('search');
                $this
                    ->session
                    ->set_userdata(array(
                    'search' => $search_text
                ));
            }
            else
            {
                if ($this
                    ->session
                    ->userdata('search') != NULL)
                {
                    $search_text = $this
                        ->session
                        ->userdata('search');
                }
            }

            $rowperpage = 10;
            if ($rowno != 0)
            {
                $rowno = ($rowno - 1) * $rowperpage;
            }

            $this
                ->load
                ->model('Cctv_Model', 'Cctv');

            $allcount = $this
                ->Cctv
                ->list_Cctv_model_Count($search_text);
            $users_record = $this
                ->Cctv
                ->list_Cctv_model_Data($rowno, $rowperpage, $search_text);

            $segment1 = $this
                ->uri
                ->segment(1);
            $segment2 = $this
                ->uri
                ->segment(2);

            $config['base_url'] = base_url() . $segment1 . '/' . $segment2;
            $config['use_page_numbers'] = true;
            $config['total_rows'] = $allcount;
            $config['per_page'] = $rowperpage;

            // integrate bootstrap pagination
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '«';
            $config['prev_tag_open'] = '<li class="paginate_button page-item prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '»';
            $config['next_tag_open'] = '<li paginate_button page-item >';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li paginate_button page-item >';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li paginate_button page-item >';
            $config['num_tag_close'] = '</li>';

            $this
                ->pagination
                ->initialize($config);

            $data['pagination'] = $this
                ->pagination
                ->create_links();
            $data['result'] = $users_record;
            $data['row'] = $rowno;
            $data['search'] = $search_text;

            $this
                ->load
                ->view('project/header/header.php');
            $this
                ->load
                ->view('project/body/Cctv/Cctv_list.php', $data);
            $this
                ->load
                ->view('project/footer/footer.php');
        }
    }

    function delete_item()
    {
        if (($this
            ->session
            ->userdata('role') == 'developer') || ($this
            ->session
            ->userdata('role') == 'Admin'))
        {
            $id = $this
                ->input
                ->post('id');
            $this
                ->db
                ->where('id', $id);
            $this
                ->db
                ->delete('cctv');
        }
    }

    function fetch()
    {
        $location = $this->input->post('location');
        $output = '';
        $this->load->model('Cctv_model');
        $data = $this->Cctv_model->fetch_data($this->input->post('limit'), $this->input->post('start'),$location);
        if($data->num_rows() > 0)
        {
            foreach($data->result() as $row)
            {
                $output .= '
                <div class="col-md-6" style="padding-right: 0px; padding-left: 30px; padding-top: 30px;">
                    <label style="color: #fff">'.$row->cctv_name.'</label>
                    '.$row->location.'
                </div>
                ';
            }
        }
        echo $output;
    }

    function fetch_map()
    {
        $location = $this->input->post('location');
        if(!empty($location)){
            $query2=$this->db->query("SELECT * FROM cctv WHERE cctv_name LIKE '%".$location."%' "); 
        } else {
            $query2=$this->db->query("SELECT * FROM cctv"); 
        }
        
        $query3= $query2->result();
        echo json_encode($query3);
    }
}