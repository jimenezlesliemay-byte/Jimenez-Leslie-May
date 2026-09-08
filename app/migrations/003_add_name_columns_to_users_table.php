<?php

class Add_name_columns_to_users_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        $this->_lava->dbforge->add_column('users', [
            'firstname' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => TRUE,
                'after'      => 'id',
            ],
            'lastname' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => TRUE,
                'after'      => 'firstname',
            ],
        ]);
    }

    public function down()
    {

        $this->_lava->dbforge->drop_column('users', 'firstname');
        $this->_lava->dbforge->drop_column('users', 'lastname');
    }
}