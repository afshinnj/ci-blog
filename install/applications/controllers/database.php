<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Database extends A_Controller
{
    /**
     * Constructor
     *
     * @access public
     * @param string
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Connect to the database
     *
     * @access public
     * @return void
     */
    public function connect_db () {
		
        $hostname = trim(urldecode($this->input->post('DB_SERVER')));
        $username = trim(urldecode($this->input->post('DB_SERVER_USERNAME')));
        $password = trim(urldecode($this->input->post('DB_SERVER_PASSWORD')));
        $database = trim(urldecode($this->input->post('DB_DATABASE')));
        $dbdriver = trim(urldecode($this->input->post('DB_DATABASE_CLASS')));
        $prefix = trim(urldecode($this->input->post('DB_TABLE_PREFIX')));

        if (!(empty($hostname) || empty($username) || empty($database))) {
            //error information
            $error = NULL;

            //database config object
            $config = array(
            'hostname' => $hostname,
            'username' => $username,
            'password' => $password,
            'database' => $database,
            'dbdriver' => $dbdriver,
            'dbprefix' => $prefix,
            'pconnect' => FALSE,
            'db_debug' => FALSE,
            'cache_on' => FALSE,
            'cachedir' => 'temporary/cache/',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci');

            //connect to database
            $this->load->database($config);

            //if connect to database failed
            if ($this->db->conn_id === FALSE) {
                //get error information
                if ($config['dbdriver'] == 'mysql') {
                    $error = mysql_error();
                } else if ($config['dbdriver'] == 'mysqli') {
                    $error = mysqli_connect_error();
                }
            } 
            //select database failed
            else {
                //get error information
                if ($config['dbdriver'] == 'mysql') {
                    $error = mysql_error($this->db->conn_id);
                } else if ($config['dbdriver'] == 'mysqli') {
                    $error = mysqli_connect_error($this->db->conn_id);
                }
            }

            //error process
            if (!empty($error)) {
                $this->output->set_output('{"success":false,"error":"' . $error . '"}');
            } else {
                //store database configuration to session
                $this->session->set_userdata('db_config', $config);

                //return true
                $this->output->set_output(json_encode(array('success' => TRUE)));
            }
        } else {
            //load database translations resources
            $this->lang->load('db');

            //return false
            $this->output->set_output(json_encode(array('success' => FALSE, 'error' => lang('db_unable_to_connect'))));
        }
    }

    /**
     * Import data into database
     *
     * @access public
     * @return void
     */
    public function import_sql() {
        //get database configuration from session

        $config = $this->session->userdata('db_config');

        //connect to database
        $this->load->database($config);
        
        //database is connected
        if ($this->db) {
            $sql_data = $this->load->file(realpath(dirname(__FILE__) . '/../../../') . '/install/blog.sql', TRUE);
            $sql_data = str_replace('`a_', '`' . $config['dbprefix'], $sql_data);

            //split sql data with ;
            $statements = preg_split("/;[\r\n]/", $sql_data) ;

            //execute the sql statement
            foreach ($statements as $statement) {
                $this->db->query($statement);
            }
            
            //install english language
            $this->lang->install('en_US', 1);
            
            //install farsi language
            $this->lang->install('fa_IR', 2);

            $this->output->set_output(json_encode(array('success' => TRUE)));
        } else {
            //load database translations resources
            $this->lang->load('db');

            $this->output->set_output(json_encode(array('success' => FALSE, 'error' => lang('db_unable_to_connect'))));
        }
    }
	
	
}

/* End of file database.php */
/* Location: ./install/applications/controllers/database.php */