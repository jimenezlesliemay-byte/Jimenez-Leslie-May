<?php
class Add_email_to_users_table {
    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        $this->_lava->dbforge->add_column('users', [
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => TRUE,
                'after'      => 'lastname',
            ],
        ]);
    }

    public function down()
    {
        $this->_lava->dbforge->drop_column('users', 'email');
    }
}