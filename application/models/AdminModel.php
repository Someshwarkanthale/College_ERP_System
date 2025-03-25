<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();  // Load the database
    }

    public function check_login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('login');
        return $query->row();
    }

    public function get_user_by_username($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('login');
        return $query->row();
    }

    public function save_reset_token($username, $token)
    {
        $this->db->where('username', $username);
        $this->db->update('login', ['reset_token' => $token]);
    }

    public function verify_reset_token($token)
    {
        $this->db->where('reset_token', $token);
        $query = $this->db->get('login');
        return $query->row();
    }

    public function clear_reset_token($username)
    {
        $this->db->where('username', $username);
        $this->db->update('login', ['reset_token' => NULL]);
    }

    public function update_password($username, $new_password)
    {
        $this->db->where('username', $username);
        $this->db->update('login', ['password' => $new_password]);
    }


    // Function to fetch all courses
    public function get_courses()
    {
        $query = $this->db->get('courses');  // Fetch courses from 'courses' table
        return $query->result();  // Return the results as an array of objects
    }

    public function get_total_courses()
    {
        return $this->db->count_all('courses');
    }

    // Insert a new course into the courses table
    public function insert_course($course_name, $fee)
    {
        $data = array(
            'course_name' => $course_name,
            'fee' => $fee  // Set the provided fee
        );
        $this->db->insert('courses', $data);
    }

    // Dynamically create a table for the course with `category` and `fee` columns
    public function create_course_table($course_name)
    {
        $table_name = strtolower(str_replace(' ', '_', $course_name));  // Make table name lowercase and replace spaces with underscores

        // SQL query to create a table for the course
        $query = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `category` VARCHAR(255) NOT NULL,
            `fee` DECIMAL(10, 2) NOT NULL
        )";

        $this->db->query($query);  // Execute the query
    }
    public function course_exists($course_name)
    {
        $this->db->where('course_name', $course_name);
        $query = $this->db->get('courses'); // Replace 'courses' with your actual table name
        return $query->num_rows() > 0;
    }

    // Fetch course by ID
    public function get_course_by_id($course_id)
    {
        return $this->db->get_where('courses', ['id' => $course_id])->row();
    }

    public function update_course($course_id, $data)
    {
        $this->db->where('id', $course_id);
        $this->db->update('courses', $data);
    }
    public function rename_table($old_table_name, $new_table_name)
    {
        $query = "RENAME TABLE `$old_table_name` TO `$new_table_name`";
        $this->db->query($query);
    }

    // Delete a course by ID
    public function delete_course($course_id)
    {
        $this->db->where('id', $course_id);
        $this->db->delete('courses');
    }

    // Delete a related dynamically created table
    public function delete_related_table($table_name)
    {
        $this->db->query("DROP TABLE IF EXISTS `$table_name`");
    }

    // Fetch all additional fees
    public function get_additional_fees()
    {
        $query = $this->db->get('additional_fees'); // Fetch all records from the additional_fees table
        return $query->result(); // Return results as an array of objects
    }

    // Get a single additional fee by ID
    public function get_additional_fee($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('additional_fees');
        return $query->row(); // Return a single row
    }
    public function get_additional_fee_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('additional_fees');
        return $query->row();  // Return a single fee object
    }

    // Add a new additional fee
    public function add_additional_fee($data)
    {
        return $this->db->insert('additional_fees', $data); // Insert new data into the table
    }

    // Update an existing additional fee
    public function update_additional_fee($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('additional_fees', $data); // Update data based on the ID
    }

    // Delete an additional fee by ID
    public function delete_additional_fee($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('additional_fees'); // Delete record based on the ID
    }


    // Insert data into the dynamically created course table
    public function insert_course_data($course_name, $category, $fee)
    {
        $table_name = strtolower(str_replace(' ', '_', $course_name));  // Make table name lowercase and replace spaces with underscores

        // Data to be inserted
        $data = array(
            'category' => $category,
            'fee' => $fee
        );

        // Insert the data into the course's table
        return $this->db->insert($table_name, $data);
    }

    // Get categories and fees for a specific course
    public function get_categories_and_fees($course_name)
    {
        $table_name = strtolower(str_replace(' ', '_', $course_name));  // Format the table name
        $query = $this->db->select('category, fee')
            ->from($table_name)
            ->get();
        return $query->result();  // Return categories and fees
    }




    public function get_course_data($table_name)
    {
        if ($this->db->table_exists($table_name)) { // Check if table exists
            $query = $this->db->get($table_name);  // Fetch all data
            return $query->result(); // Return results
        }
        return []; // Return empty array if table does not exist
    }
    // Fetch a record by ID
    public function get_record_by_id($table_name, $id)
    {
        return $this->db->get_where($table_name, ['id' => $id])->row();
    }

    // Update a record in the table
    public function update_record($table_name, $id, $category, $fee)
    {
        $data = [
            'category' => $category,
            'fee' => $fee
        ];
        $this->db->where('id', $id);
        $this->db->update($table_name, $data);
    }

    // Delete a record from the table
    public function delete_record($table_name, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete($table_name);
    }

    // Insert a new student into the database
    public function insert_student($name, $course_name, $category, $total_fee, $paid_fee, $remaining_fee)
    {
        $data = array(
            'student_name' => $name,
            'course_name' => $course_name,
            'category' => $category,
            'total_fee' => $total_fee,
            'paid_fee' => $paid_fee,
            'remaining_fee' => $remaining_fee,
        );
        $this->db->insert('students', $data);
    }

    // Fetch all students
    public function get_all_students()
    {
        return $this->db->get('students')->result();
    }

    public function getMatchingStudents($search)
    {
        $this->db->like('student_name', $search);
        $this->db->select('id, student_name AS name'); // Select necessary fields
        $query = $this->db->get('students'); // Replace 'students' with your table name
        return $query->result_array();
    }

    // Update fee payment
    public function update_fee($id, $paid_amount)
    {
        $student = $this->db->where('id', $id)->get('students')->row();

        $new_paid_fee = $student->paid_fee + $paid_amount;
        $remaining_fee = $student->total_fee - $new_paid_fee;

        $this->db->where('id', $id)->update('students', [
            'paid_fee' => $new_paid_fee,
            'remaining_fee' => $remaining_fee,
        ]);
    }
    public function update_student($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('students', $data);
    }

    // Delete a student record
    public function delete_student($id)
    {
        $this->db->where('id', $id)->delete('students');
    }

    // Get student by ID
    public function get_student_by_id($id)
    {
        return $this->db->where('id', $id)->get('students')->row();
    }
    // Get total number of students
    public function get_total_students_count()
    {
        return $this->db->count_all('students');
    }

    public function get_course_wise_count()
    {
        // Select course names and the count of students enrolled in each course
        $this->db->select('courses.course_name, COUNT(students.id) AS count');
        $this->db->from('courses');
        $this->db->join('students', 'students.course_name = courses.course_name', 'left');
        $this->db->group_by('courses.id');
        $query = $this->db->get();
        return $query->result();
    }

    // Get category-wise student count
    public function get_category_wise_count()
    {
        $this->db->select('category, COUNT(*) as count');
        $this->db->group_by('category');
        return $this->db->get('students')->result();
    }

    // Get fee transactions for a student
    public function get_transactions_by_student_id($id)
    {
        return $this->db->where('student_id', $id)->get('transactions')->result();
    }

    // Add a new fee transaction and update the student's fee
    public function add_transaction($id, $paid_fee)
    {
        // Insert the transaction
        $this->db->insert('transactions', [
            'student_id' => $id,
            'paid_fee' => $paid_fee,
            'transaction_date' => date('Y-m-d H:i:s'),
        ]);

        // Update the student's fee details
        $student = $this->get_student_by_id($id);
        $new_paid_fee = $student->paid_fee + $paid_fee;
        $remaining_fee = $student->total_fee - $new_paid_fee;

        $this->db->where('id', $id)->update('students', [
            'paid_fee' => $new_paid_fee,
            'remaining_fee' => $remaining_fee,
        ]);
    }
}
